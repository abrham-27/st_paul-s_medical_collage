import { type JSX } from 'react';
import './News.css';

interface NewsArticle {
    id: number;
    title: string;
    description: string;
    image: string;
    category: string;
    date: string;
    author: string;
    link: string;
}

const mockNews: NewsArticle[] = [
    {
        id: 1,
        title: "SPHMMC Achieves Global Excellence Ranking in Medical Research",
        description: "In a groundbreaking assessment, St. Paul's Hospital Millennium Medical College has been recognized as one of the top research institutions in East Africa for its contributions to global health and infectious disease studies.",
        image: "https://images.unsplash.com/photo-1576091160550-217359f42f8c?auto=format&fit=crop&q=80&w=2070",
        category: "Research",
        date: "March 08, 2026",
        author: "Public Relations Office",
        link: "/news/research-ranking"
    },
    {
        id: 2,
        title: "New State-of-the-Art Oncology Department Inauguration",
        description: "The college is proud to announce the opening of its latest oncology wing, equipped with next-generation radiotherapy machines and patient-centric specialized care units.",
        image: "https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&q=80&w=2070",
        category: "Facilities",
        date: "March 05, 2026",
        author: "Facilities Management",
        link: "/news/oncology-opening"
    },
    {
        id: 3,
        title: "Community Outreach: SPHMMC Medical Teams Reach Remote Districts",
        description: "A team of over 50 specialists and medical students traveled to Northern Ethiopia to provide free cataract surgeries and cardiovascular screenings to over 2,000 residents.",
        image: "https://images.unsplash.com/photo-1584467735815-f778f274e296?auto=format&fit=crop&q=80&w=2070",
        category: "Community",
        date: "March 01, 2026",
        author: "Outreach Program Hub",
        link: "/news/community-outreach"
    },
    {
        id: 4,
        title: "Digital Transformation: Launching the SPHMMC E-Learning Portal",
        description: "To enhance the learning experience of our medical students, a comprehensive e-portal has been launched, featuring live-streamed surgeries, 3D anatomy modules, and digital textbooks.",
        image: "https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=2070",
        category: "Academia",
        date: "Feb 28, 2026",
        author: "Academic Affairs",
        link: "/news/elearning-launch"
    },
    {
        id: 5,
        title: "International Collaboration with Harvard Medical School",
        description: "SPHMMC signs a multi-year partnership agreement with Harvard Medical School to focus on faculty exchange programs and advanced clinical fellowship training.",
        image: "https://images.unsplash.com/photo-1523050337456-5d8f20b5ed94?auto=format&fit=crop&q=80&w=2070",
        category: "International",
        date: "Feb 22, 2026",
        author: "Office of International Relations",
        link: "/news/harvard-partnership"
    },
    {
        id: 6,
        title: "2026 Residency Placement Results Announced",
        description: "We are excited to share the placement results for our graduating residents, with 100% successful matches across primary and sub-specialty clinical areas.",
        image: "https://images.unsplash.com/photo-1527613426441-4da17471b66d?auto=format&fit=crop&q=80&w=2070",
        category: "Students",
        date: "Feb 15, 2026",
        author: "Dean of Medicine",
        link: "/news/residency-placement"
    }
];

export default function News({ onBack }: { onBack: () => void }): JSX.Element {
    return (
        <div className="news-page">
            <div className="container">
                <button className="back-btn" onClick={onBack}>
                    <span>←</span> &nbsp; Back to Campus Home
                </button>
                
                <header className="news-header">
                    <span className="category-tag">LATEST FROM SPHMMC</span>
                    <h1>College News & Media</h1>
                    <p>Stay informed about groundbreaking research, campus events, and clinical breakthroughs from Ethiopia's leading medical institution.</p>
                </header>

                <div className="news-nav-links">
                    <a href="#all" className="news-nav-link">Full Archive ↗</a>
                    <a href="#research" className="news-nav-link">Research Updates ↗</a>
                    <a href="#academic" className="news-nav-link">Academic Briefs ↗</a>
                    <a href="#clinical" className="news-nav-link">Clinical Success ↗</a>
                    <a href="#events" className="news-nav-link">Campus Events ↗</a>
                </div>

                <div className="news-grid">
                    {mockNews.map(article => (
                        <article key={article.id} className="news-card">
                            <div 
                                className="news-card-img" 
                                style={{ backgroundImage: `url(${article.image})` }}
                            >
                                <span className="news-badge">{article.category}</span>
                            </div>
                            <div className="news-card-body">
                                <div className="news-meta">
                                    <span>{article.date}</span>
                                    <span className="dot"></span>
                                    <span>{article.author}</span>
                                </div>
                                <h3>{article.title}</h3>
                                <p>{article.description}</p>
                            </div>
                            <div className="news-card-footer">
                                <a href={article.link} className="read-more-link">
                                    DISCOVER FULL STORY <span>→</span>
                                </a>
                            </div>
                        </article>
                    ))}
                </div>
            </div>
        </div>
    );
}
