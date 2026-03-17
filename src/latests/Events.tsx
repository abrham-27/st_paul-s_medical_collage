import { type JSX, useState } from 'react';
import './Events.css';

interface EventItem {
    id: number;
    title: string;
    description: string;
    image?: string;
    date: string;
    time: string;
    location: string;
    type: 'upcoming' | 'ongoing' | 'past';
    category: string;
}

const events: EventItem[] = [
    {
        id: 1,
        title: "2026 Annual Medical Graduation Ceremony",
        description: "Celebrating the achievements of our latest medical and healthcare professionals in a grand ceremony at the Main Hall.",
        image: "https://images.unsplash.com/photo-1541339907198-e08756ebafe3?auto=format&fit=crop&q=80&w=2070",
        date: "25 June 2026",
        time: "09:00 AM",
        location: "SPHMMC Grand Auditorium",
        type: "upcoming",
        category: "Ceremony"
    },
    {
        id: 2,
        title: "Ongoing: National Cardio-Thoracic Symposium",
        description: "A three-day intensive symposium gathering top specialists to discuss the latest advancements in heart surgery.",
        image: "https://images.unsplash.com/photo-1579152276507-24422e39ee68?auto=format&fit=crop&q=80&w=2070",
        date: "Current - 12 March 2026",
        time: "All Day",
        location: "Academic Building, Room 402",
        type: "ongoing",
        category: "Academic"
    },
    {
        id: 3,
        title: "Workshop: Clinical Research Methods",
        description: "Focused training for postgraduate students on modern clinical research methodologies and data analysis.",
        image: "https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=2070",
        date: "15 April 2026",
        time: "02:00 PM",
        location: "Virtual Meeting Room/Library Annex",
        type: "upcoming",
        category: "Workshop"
    },
    {
        id: 4,
        title: "Past Event: SPHMMC Research Day 2025",
        description: "A full day of research presentations and posters showcasing the innovative work by students and faculty.",
        date: "12 Dec 2025",
        time: "Finished",
        location: "Library Hall",
        type: "past",
        category: "Research"
    },
    {
        id: 5,
        title: "Past Event: 2025 Community Wellness Fair",
        description: "Free medical screening and public health awareness for local residents in Gulele Sub-City.",
        date: "05 Nov 2025",
        time: "Finished",
        location: "Campus Grounds",
        type: "past",
        category: "Community"
    },
    {
        id: 6,
        title: "Past Event: Inaugural Oncology Wing Dedication",
        description: "Offical opening ceremony and dedication of the new specialized oncology treatment wing.",
        date: "20 Sept 2025",
        time: "Finished",
        location: "New Oncology Building",
        type: "past",
        category: "Ceremony"
    }
];

export default function Events({ onBack }: { onBack: () => void }): JSX.Element {
    const [activeTab, setActiveTab] = useState<'current' | 'past'>('current');
    
    const currentEvents = events.filter(e => e.type === 'upcoming' || e.type === 'ongoing');
    const pastEvents = events.filter(e => e.type === 'past');

    return (
        <div className="events-page">
            <div className="container">
                <button className="back-btn" onClick={onBack}>← Back to Campus Home</button>
                
                <header className="events-header">
                    <h1>Campus Events</h1>
                    <p>Be part of the moments that shape the future of medical education and research at St. Paul's.</p>
                </header>

                <nav className="events-nav">
                    <button 
                        className={`events-nav-link ${activeTab === 'current' ? 'active' : ''}`}
                        onClick={() => setActiveTab('current')}
                    >
                        Upcoming & Ongoing
                    </button>
                    <button 
                        className={`events-nav-link ${activeTab === 'past' ? 'active' : ''}`}
                        onClick={() => setActiveTab('past')}
                    >
                        Past Events
                    </button>
                </nav>

                {activeTab === 'current' ? (
                    <div className="event-section animate-in">
                        <div className="upcoming-grid">
                            {currentEvents.map(event => (
                                <div key={event.id} className="event-card">
                                    <div className="event-img" style={{ backgroundImage: `url(${event.image})` }}>
                                        <div className="event-date-badge">
                                            <span className="day">{event.date.split(' ')[0]}</span>
                                            <span className="month">{event.date.split(' ')[1]}</span>
                                        </div>
                                    </div>
                                    <div className="event-info">
                                        <span className="event-type">{event.category}</span>
                                        <h3>{event.title}</h3>
                                        <div className="event-details">
                                            <span>📅 {event.date}</span>
                                            <span>⏰ {event.time}</span>
                                            <span>📍 {event.location}</span>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                ) : (
                    <div className="event-section animate-in">
                        <div className="past-events-list">
                            {pastEvents.map(event => (
                                <a href={`/events/${event.id}`} key={event.id} className="past-event-link">
                                    <div className="past-event-info">
                                        <div className="past-event-date">{event.date}</div>
                                        <div className="past-event-title">{event.title}</div>
                                    </div>
                                    <div className="link-arrow">↗</div>
                                </a>
                            ))}
                        </div>
                    </div>
                )}
            </div>
        </div>
    );
}
