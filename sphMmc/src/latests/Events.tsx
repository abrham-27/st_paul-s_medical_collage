import { type JSX, useState, useEffect } from "react";
import "./Events.css";
import { apiService, type LatestPost } from "../services/api";

interface EventItem {
    id: number; title: string; description: string; image: string;
    date: string; day: string; month: string; time: string;
    location: string; category: string; isPast: boolean;
}

const fallbackUpcoming: EventItem[] = [
    { id: 1, title: "Annual Research Symposium 2026", description: "A full-day symposium showcasing cutting-edge research from all departments.", image: "https://images.unsplash.com/photo-1541339907198-e08756ebafe3?w=600&fit=crop", date: "Apr 15, 2026", day: "15", month: "APR", time: "8:00 AM", location: "Main Auditorium", category: "Research", isPast: false },
    { id: 2, title: "CME Workshop: Advanced Cardiac Life Support", description: "Hands-on ACLS recertification workshop for clinical staff and residents.", image: "https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&fit=crop", date: "Apr 22, 2026", day: "22", month: "APR", time: "9:00 AM", location: "Simulation Lab", category: "Training", isPast: false },
    { id: 3, title: "Graduation Ceremony - Class of 2026", description: "Celebrating the achievements of our graduating class across all schools.", image: "https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&fit=crop", date: "May 10, 2026", day: "10", month: "MAY", time: "10:00 AM", location: "Campus Grounds", category: "Ceremony", isPast: false },
];

const fallbackPast: EventItem[] = [
    { id: 4, title: "AICS International Conference on Health Education", description: "", image: "", date: "Mar 5, 2026", day: "5", month: "MAR", time: "", location: "Main Hall", category: "Conference", isPast: true },
    { id: 5, title: "World Health Day Community Outreach", description: "", image: "", date: "Apr 7, 2025", day: "7", month: "APR", time: "", location: "Addis Ababa", category: "Community", isPast: true },
    { id: 6, title: "Nursing Skills Competition 2025", description: "", image: "", date: "Feb 14, 2025", day: "14", month: "FEB", time: "", location: "Nursing School", category: "Academic", isPast: true },
];

function decodeHtmlEntities(html: string) {
    const textarea = document.createElement('textarea');
    textarea.innerHTML = html;
    return textarea.value;
}

function stripHtml(html: string) {
    return decodeHtmlEntities(html.replace(/<[^>]+>/g, ' ')).replace(/\s+/g, ' ').trim();
}

function toItem(p: LatestPost, isPast: boolean): EventItem {
    const d = p.event_date ? new Date(p.event_date) : new Date(p.created_at);
    return {
        id: p.id, title: p.title, description: stripHtml(p.content || ""),
        image: p.featured_image || "https://images.unsplash.com/photo-1541339907198-e08756ebafe3?w=600&fit=crop",
        date: d.toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" }),
        day: String(d.getDate()),
        month: d.toLocaleString("en-US", { month: "short" }).toUpperCase(),
        time: d.toLocaleTimeString("en-US", { hour: "2-digit", minute: "2-digit" }),
        location: "SPHMMC Campus", category: "Event", isPast,
    };
}

export default function Events({ onBack }: { onBack: () => void }): JSX.Element {
    const [tab, setTab] = useState<"upcoming" | "past">("upcoming");
    const [events, setEvents] = useState<EventItem[]>(fallbackUpcoming);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        setLoading(true);
        const req = tab === "upcoming"
            ? apiService.getUpcomingEvents().then(r => r.success && r.data.data.length > 0 ? r.data.data.map((p: LatestPost) => toItem(p, false)) : fallbackUpcoming)
            : apiService.getPastEvents().then(r => r.success && r.data.data.length > 0 ? r.data.data.map((p: LatestPost) => toItem(p, true)) : fallbackPast);
        req.then(setEvents).catch(() => setEvents(tab === "upcoming" ? fallbackUpcoming : fallbackPast)).finally(() => setLoading(false));
    }, [tab]);

    return (
        <div className="lp-page lp-events-page">
            <div className="lp-hero-bar">
                <button className="lp-back-btn" onClick={onBack}>Back</button>
                <div className="lp-hero-text">
                    <span className="lp-label">SPHMMC Calendar</span>
                    <h1>Campus Events</h1>
                    <p>Be part of moments that shape the future of medical education.</p>
                </div>
            </div>
            <div className="lp-container">
                <nav className="ev-tabs">
                    <button className={"ev-tab" + (tab === "upcoming" ? " active" : "")} onClick={() => setTab("upcoming")}>Upcoming</button>
                    <button className={"ev-tab" + (tab === "past" ? " active" : "")} onClick={() => setTab("past")}>Past Events</button>
                </nav>
                {loading && <div className="lp-loading">Loading...</div>}
                {tab === "upcoming" ? (
                    <div className="ev-upcoming-grid">
                        {events.map((ev, idx) => (
                            <article key={ev.id} className="ev-card" style={{ animationDelay: idx * 0.08 + "s" }}>
                                <div className="ev-img" style={{ backgroundImage: "url(" + ev.image + ")" }}>
                                    <div className="ev-date-badge">
                                        <span className="ev-day">{ev.day}</span>
                                        <span className="ev-month">{ev.month}</span>
                                    </div>
                                    <span className="ev-cat-badge">{ev.category}</span>
                                </div>
                                <div className="ev-body">
                                    <h3>{ev.title}</h3>
                                    {ev.description && <p>{ev.description.slice(0, 90)}...</p>}
                                    <div className="ev-details">
                                        <span>Time: {ev.time}</span>
                                        <span>Location: {ev.location}</span>
                                    </div>
                                    <span className="ev-link">View details</span>
                                </div>
                            </article>
                        ))}
                    </div>
                ) : (
                    <div className="ev-past-list">
                        {events.map((ev, idx) => (
                            <a key={ev.id} href="#" className="ev-past-row" style={{ animationDelay: idx * 0.05 + "s" }}>
                                <div className="ev-past-date-box">
                                    <span className="ev-past-day">{ev.day}</span>
                                    <span className="ev-past-month">{ev.month}</span>
                                </div>
                                <div className="ev-past-info">
                                    <span className="ev-past-cat">{ev.category}</span>
                                    <span className="ev-past-title">{ev.title}</span>
                                    <span className="ev-past-loc">Location: {ev.location}</span>
                                </div>
                                <span className="ev-past-arrow">Go</span>
                            </a>
                        ))}
                    </div>
                )}
            </div>
        </div>
    );
}
