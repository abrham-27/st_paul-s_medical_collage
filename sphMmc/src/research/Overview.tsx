import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import './Overview.css';

interface ResearchPage {
    title?: string;
    content?: string;
    image?: string;
}

interface ResearchGoal {
    id: number;
    title: string;
    description?: string;
    display_order: number;
    status: string;
}

const Overview: React.FC = () => {
    const navigate = useNavigate();
    const [activeTab, setActiveTab] = useState<'background' | 'mission' | 'vision' | 'goals'>('background');
    const [background, setBackground] = useState<ResearchPage | null>(null);
    const [mission, setMission] = useState<ResearchPage | null>(null);
    const [vision, setVision] = useState<ResearchPage | null>(null);
    const [goals, setGoals] = useState<ResearchGoal[]>([]);
    const [loading, setLoading] = useState(true);

    // Fetch data based on active tab
    useEffect(() => {
        const fetchData = async () => {
            setLoading(true);
            try {
                let endpoint = '';
                switch (activeTab) {
                    case 'background':
                        endpoint = '/api/research/background';
                        break;
                    case 'mission':
                        endpoint = '/api/research/mission';
                        break;
                    case 'vision':
                        endpoint = '/api/research/vision';
                        break;
                    case 'goals':
                        endpoint = '/api/research/goals';
                        break;
                }

                const response = await fetch(endpoint);
                const result = await response.json();
                
                if (result.success) {
                    switch (activeTab) {
                        case 'background':
                            setBackground(result.data);
                            break;
                        case 'mission':
                            setMission(result.data);
                            break;
                        case 'vision':
                            setVision(result.data);
                            break;
                        case 'goals':
                            setGoals(result.data);
                            break;
                    }
                }
            } catch (error) {
                console.error('Error fetching research data:', error);
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, [activeTab]);

    const handleBack = () => {
        navigate('/');
    };

    return (
        <div className="research-overview">
            {/* Header Section */}
            <div className="research-header">
                <div className="container">
                    <button onClick={handleBack} className="back-button">
                        <i className="fas fa-arrow-left"></i>
                        Back
                    </button>
                    <div className="header-content">
                        <h1 className="page-title">Research Overview</h1>
                        <p className="page-subtitle">Explore our research initiatives, mission, vision, and goals</p>
                    </div>
                </div>
            </div>

            {/* Tabs Navigation */}
            <div className="tabs-container">
                <div className="tabs-wrapper">
                    <div className="tabs">
                        <button
                            className={`tab ${activeTab === 'background' ? 'active' : ''}`}
                            onClick={() => setActiveTab('background')}
                        >
                            <i className="fas fa-book"></i>
                            Background
                        </button>
                        <button
                            className={`tab ${activeTab === 'mission' ? 'active' : ''}`}
                            onClick={() => setActiveTab('mission')}
                        >
                            <i className="fas fa-bullseye"></i>
                            Mission & Vision
                        </button>
                        <button
                            className={`tab ${activeTab === 'vision' ? 'active' : ''}`}
                            onClick={() => setActiveTab('vision')}
                        >
                            <i className="fas fa-eye"></i>
                            Vision
                        </button>
                        <button
                            className={`tab ${activeTab === 'goals' ? 'active' : ''}`}
                            onClick={() => setActiveTab('goals')}
                        >
                            <i className="fas fa-trophy"></i>
                            Goals
                        </button>
                    </div>
                </div>
            </div>

            {/* Content Area */}
            <div className="content-container">
                <div className="container">
                    {loading ? (
                        <div className="loading-spinner">
                            <div className="spinner"></div>
                            <p>Loading content...</p>
                        </div>
                    ) : (
                        <>
                            {/* Background Tab */}
                            {activeTab === 'background' && background && (
                                <div className="tab-content">
                                    <h2 className="content-title">{background.title}</h2>
                                    {background.image && (
                                        <div className="featured-image">
                                            <img src={`/storage/${background.image}`} alt={background.title} />
                                        </div>
                                    )}
                                    <div className="content-body" dangerouslySetInnerHTML={{ __html: background.content || '' }} />
                                </div>
                            )}

                            {/* Mission & Vision Tab */}
                            {activeTab === 'mission' && mission && (
                                <div className="tab-content">
                                    <div className="mission-vision-container">
                                        <div className="section">
                                            <h2 className="content-title">
                                                <i className="fas fa-bullseye"></i>
                                                {mission.title}
                                            </h2>
                                            <div className="content-body" dangerouslySetInnerHTML={{ __html: mission.content || '' }} />
                                        </div>
                                    </div>
                                    {vision && (
                                        <div className="section">
                                            <h2 className="content-title">
                                                <i className="fas fa-eye"></i>
                                                {vision.title}
                                            </h2>
                                            <div className="content-body" dangerouslySetInnerHTML={{ __html: vision.content || '' }} />
                                        </div>
                                    )}
                                </div>
                            )}

                            {/* Vision Tab */}
                            {activeTab === 'vision' && vision && (
                                <div className="tab-content">
                                    <h2 className="content-title">{vision.title}</h2>
                                    <div className="content-body" dangerouslySetInnerHTML={{ __html: vision.content || '' }} />
                                </div>
                            )}

                            {/* Goals Tab */}
                            {activeTab === 'goals' && (
                                <div className="tab-content">
                                    <div className="goals-grid">
                                        {goals.map((goal) => (
                                            <div key={goal.id} className="goal-card">
                                                <div className="goal-icon">
                                                    <i className="fas fa-trophy"></i>
                                                </div>
                                                <div className="goal-content">
                                                    <h3 className="goal-title">{goal.title}</h3>
                                                    {goal.description && (
                                                        <p className="goal-description">{goal.description}</p>
                                                    )}
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                </div>
                            )}
                        </>
                    )}
                </div>
            </div>
        </div>
    );
};

export default Overview;
