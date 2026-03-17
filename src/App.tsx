import { useState, useEffect, type JSX } from 'react'
import { Routes, Route, useNavigate, useLocation } from 'react-router-dom'
import './App.css'
import logo from './assets/images/sphmmc__logo-1 (1).png'
import paul1 from './assets/images/paul1.jpg'
import paul2 from './assets/images/paul2.jpg'
import paul3 from './assets/images/paul3.jpg'
import paul4 from './assets/images/paul4.jpg'
import paul5 from './assets/images/paul5.jpg'
import paul6 from './assets/images/paul6.jpg'
import paul7 from './assets/images/paul7.jpg'
import paul9 from './assets/images/paul9.jpg'
import paul10 from './assets/images/paul10.png'
import HealthTips from './health/HealthTips'
import News from './latests/News'
import Events from './latests/Events'
import Announcements from './latests/Announcements'
import Overview from './school-of-medicine/Overview'
import DepartmentsLanding from './school-of-medicine/Departments'
import BasicSciences from './school-of-medicine/departments/BasicSciences'
import Preclinical from './school-of-medicine/departments/Preclinical'
import Clinical from './school-of-medicine/departments/Clinical'
import Specialized from './school-of-medicine/departments/Specialized'
import SchoolOfNursingAbout from './school-of-nursing/about'
import SchoolOfNursingMission from './school-of-nursing/mission'
import SchoolOfNursingVision from './school-of-nursing/vision'
import SchoolOfNursingDepartments from './school-of-nursing/departments'
import EmergencyCriticalCare from './school-of-nursing/departments/EmergencyCriticalCare'
import NeonatalPediatrics from './school-of-nursing/departments/NeonatalPediatrics'
import MedicalSurgical from './school-of-nursing/departments/MedicalSurgical'
import OperativeTheatre from './school-of-nursing/departments/OperativeTheatre'
import { ResearchBackground, ResearchVissionMission, ResearchGoals, FunctionsOfIRB, RolesResponsibilities } from './research'
import { Partners } from './partners'
import SpecializedCenters from './centers/SpecializedCenters'
import AboutUs from './about/AboutUs'
import Leaders from './about/Leaders'
import MissionVisionValues from './about/MissionVisionValues'
import PublicHealthAbout from './school-of-public-health/PublicHealthAbout'
import PublicHealthMissionVision from './school-of-public-health/PublicHealthMissionVision'
import PublicHealthDepartments from './school-of-public-health/departments/PublicHealthDepartments'

const mockDoctors = [
  {
    id: 1,
    name: "Dr. Abebe Bekele",
    specialty: "Cardiothoracic Surgery",
    desc: "Pioneer of open-heart surgery in Ethiopia with over 20 years of surgical excellence at SPHMMC.",
    image: "https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop&crop=face",
    link: "#"
  },
  {
    id: 2,
    name: "Dr. Tigist Mengesha",
    specialty: "Pediatric Neurology",
    desc: "Leading expert in childhood neurological disorders, dedicated to advancing pediatric care in East Africa.",
    image: "https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face",
    link: "#"
  },
  {
    id: 3,
    name: "Dr. Samuel Tadesse",
    specialty: "Oncology",
    desc: "Specializing in cancer research and treatment protocols tailored for the Ethiopian patient population.",
    image: "https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=400&h=400&fit=crop&crop=face",
    link: "#"
  },
  {
    id: 4,
    name: "Dr. Hiwot Alemayehu",
    specialty: "Obstetrics & Gynecology",
    desc: "Champion of maternal health with groundbreaking work in reducing maternal mortality rates.",
    image: "https://images.unsplash.com/photo-1594824476967-48c8b964f137?w=400&h=400&fit=crop&crop=face",
    link: "#"
  },
  {
    id: 5,
    name: "Dr. Dawit Wolde",
    specialty: "Orthopedic Surgery",
    desc: "Expert in complex joint reconstruction and trauma surgery with international fellowship training.",
    image: "https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=400&h=400&fit=crop&crop=face",
    link: "#"
  },
  {
    id: 6,
    name: "Dr. Meron Fikadu",
    specialty: "Dermatology",
    desc: "Renowned specialist in tropical dermatology and skin conditions prevalent in the Horn of Africa.",
    image: "https://images.unsplash.com/photo-1651008376811-b90baee60c1f?w=400&h=400&fit=crop&crop=face",
    link: "#"
  }
];

interface HomeProps {
  navigate: (path: string) => void;
  heroImages: string[];
  currentSlide: number;
  healthTips: any[];
}

function Home({ navigate, heroImages, currentSlide, healthTips }: HomeProps) {
  return (
    <>
      {/* Full-browser Stanford-style Hero */}
      <section className="hero-aau">
        {/* Sliding background images */}
        {heroImages.map((img, idx) => (
          <div
            key={idx}
            className={`hero-slide ${idx === currentSlide ? 'active' : ''}`}
            style={{ backgroundImage: `url(${img})` }}
          />
        ))}
        {/* Dark overlay */}
        <div className="hero-overlay" />
        {/* Text overlaid on image */}
        <div className="hero-text-content">
          <h1>St Paul's Hospital<br />Millennium Medical<br />College</h1>
          <p>SPHMMC is a leader in developing transdisciplinary healthcare solutions to social, economic, and environmental challenges.</p>
          <div className="hero-btns">
            <button className="btn btn-primary">Research ↗</button>
            <button className="btn btn-outline" onClick={() => navigate('/health/tips')}>Health tips ↗</button>
          </div>
        </div>
        {/* Slide dots */}
        <div className="hero-dots">
          {heroImages.map((_, idx) => (
            <span key={idx} className={`hero-dot ${idx === currentSlide ? 'active' : ''}`} />
          ))}
        </div>
      </section>

      {/* Quick Links bar */}
      <div className="quick-links-bar">
        <div className="container">
          <div className="links-wrapper">
            <div className="link-items">
              <a href="#">LIBRARY ↗</a>
              <a href="#">ICT ↗</a>
              <a href="#">Documents↗</a>
              <a href="#">ALUMNI ↗</a>
              <a href="#" onClick={(e) => { e.preventDefault(); navigate('/centers/specialized'); }}>Specialized Surgical and Medical Centers ↗</a>
            </div>
          </div>
        </div>
      </div>

      {/* Health Tips Section (Mini Preview) */}
      <section className="health-tips-aau">
        <div className="container">
          <div className="section-title">
            <h2>Expert Health Advice</h2>
          </div>
          <div className="tips-grid">
            {healthTips.map((tip) => (
              <a
                key={tip.id}
                href={tip.url}
                target="_blank"
                rel="noreferrer"
                className="tip-card"
              >
                <div className="tip-header">
                  <span className="tip-icon">{tip.icon}</span>
                  <h4>{tip.title}</h4>
                </div>
                <p>{tip.desc}</p>
              </a>
            ))}
          </div>
          <div style={{ textAlign: 'center', marginTop: '40px' }}>
            <button className="btn btn-primary" onClick={() => navigate('/health/tips')}>View All Health Tips ↗</button>
          </div>
        </div>
      </section>

      {/* Our Doctors Section */}
      <section className="doctors-section">
        <div className="doctors-inner">
          <div className="doctors-header">
            <span className="doctors-label">Medical Excellence</span>
            <h2 className="doctors-title">Our Doctors</h2>
            <p className="doctors-subtitle">Meet the dedicated specialists shaping the future of healthcare at St. Paul's Hospital Millennium Medical College.</p>
          </div>
          <div className="doctors-grid">
            {mockDoctors.map((doc) => (
              <a key={doc.id} href={doc.link} className="doctor-card">
                <div className="doctor-image-wrapper">
                  <img src={doc.image} alt={doc.name} />
                  <div className="doctor-specialty-badge">{doc.specialty}</div>
                </div>
                <div className="doctor-info">
                  <h3>{doc.name}</h3>
                  <p>{doc.desc}</p>
                  <span className="doctor-profile-link">View Profile →</span>
                </div>
              </a>
            ))}
          </div>
        </div>
      </section>
    </>
  );
}


function App(): JSX.Element {
  const [scrolled, setScrolled] = useState(false);
  const navigate = useNavigate();
  const location = useLocation();
  const [openMenu, setOpenMenu] = useState<string | null>(null);

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 50);
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  // Always scroll to top when changing between routes
  useEffect(() => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
    if (openMenu) setOpenMenu(null);
  }, [location.pathname]); // eslint-disable-line react-hooks/exhaustive-deps

  const [currentSlide, setCurrentSlide] = useState(0);
  const heroImages = [paul1, paul2, paul3, paul4, paul5];
  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentSlide((prev) => (prev + 1) % heroImages.length);
    }, 5000);
    return () => clearInterval(interval);
  }, [heroImages.length]);

  const [currentNewsSlide, setCurrentNewsSlide] = useState(0);
  const newsImages = [paul6, paul7, paul10, paul9];


  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentNewsSlide((prev) => (prev + 1) % newsImages.length);
    }, 4000); // 4 seconds interval for news slideshow
    return () => clearInterval(interval);
  }, [newsImages.length]);

  const latestNews = [
    {
      id: 1,
      tag: "Academic",
      title: "New Postgraduate Residency Programs for 2026",
      desc: "Apply now for our newly accredited specialized residency positions in Cardiology and Oncology.",
      icon: "🎓",
      date: "Feb 19, 2026"
    },
    {
      id: 2,
      tag: "Research",
      title: "Breakthrough in Malaria Research",
      desc: "The SPHMMC Research Institute publishes significant findings on local malaria variants.",
      icon: "🔬",
      date: "Feb 13, 2026"
    },
    {
      id: 3,
      tag: "Community",
      title: "Free Community Health Screening",
      desc: "Join us this Saturday for comprehensive health check-ups and nutritional guidance.",
      icon: "🏥",
      date: "Feb 10, 2026"
    }
  ];

  const healthTips = [
    {
      id: 1,
      title: "Hydration is Key",
      desc: "Drinking enough water maintains brain function and keeps your skin glowing during the dry season.",
      icon: "💧",
      url: "https://www.hydration_health.com"
    },
    {
      id: 2,
      title: "Regular Check-ups",
      desc: "Early detection is the best prevention. Schedule your annual screening with our specialists.",
      icon: "🩺",
      url: "https://www.cdc.gov/chronic-disease/about/checkup.htm"
    },
    {
      id: 3,
      title: "Mental Well-being",
      desc: "15 minutes of mindfulness daily can significantly reduce stress and improve cardiac health.",
      icon: "🧘",
      url: "https://www.who.int/teams/mental-health-and-substance-use/promotion-prevention/mental-health-promotion"
    }
  ];

  return (
    <div className="site">
      {/* AAU Inspired Header */}
      <header className={`main-header ${scrolled ? 'scrolled' : ''}`}>
        <div className="container">
          <div className="header-top">
            <div className="logo-section">
              <a href="/">
                <img
                  src={logo}
                  alt="SPHMMC Logo"
                />
              </a>
            </div>
            <nav className="nav-desktop">
              <a href="/" className="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
              </a>

              <div
                className={`nav-item-dropdown ${openMenu === 'latest' ? 'open' : ''}`}
                onMouseEnter={() => setOpenMenu('latest')}
                onMouseLeave={() => setOpenMenu(null)}
              >
                <a href="#" className="nav-link">Latest <span className="arrow">▾</span></a>
                <div className="dropdown-content">
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/latests/news'); }}>News</a>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/latests/events'); }}>Events</a>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/latests/announcements'); }}>Announcements</a>
                  <a href="/latests/documents" onClick={(e) => { e.preventDefault(); navigate('/latests/documents'); }}>Documents</a>
                </div>
              </div>

              <div
                className={`nav-item-dropdown ${openMenu === 'about' ? 'open' : ''}`}
                onMouseEnter={() => setOpenMenu('about')}
                onMouseLeave={() => setOpenMenu(null)}
              >
                <a href="#" className="nav-link">About <span className="arrow">▾</span></a>
                <div className="dropdown-content">
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/about'); }}>About Us</a>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/about/leaders/provost'); }} className="dropdown-submenu-title">Leaders <span className="arrow">▸</span></a>
                  <div className="mdropdown-content">
                    <a href="#" onClick={(e) => { e.preventDefault(); navigate('/about/leaders/provost'); }}>Provost</a>
                    <a href="#" onClick={(e) => { e.preventDefault(); navigate('/about/leaders/business-development'); }}>Business Development Vice Provost</a>
                    <a href="#" onClick={(e) => { e.preventDefault(); navigate('/about/leaders/academic-medical-service'); }}>Academic and Medical Service Vice Provost</a>
                    <a href="#" onClick={(e) => { e.preventDefault(); navigate('/about/leaders/research-community-service'); }}>Research and Community Service Vice Provost</a>
                  </div>
                  <div className="dropdown-submenu">
                    <a href="#" onClick={(e) => { e.preventDefault(); navigate('/about/mission-vision-values/mission'); }} className="dropdown-submenu-title">Mission, Vision & Values <span className="arrow">▸</span></a>
                    <div className="mdropdown-content">
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/about/mission-vision-values/mission'); }}>Mission</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/about/mission-vision-values/vision'); }}>Vision</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/about/mission-vision-values/values'); }}>Values</a>
                    </div>
                  </div>
                </div>
              </div>


              <a href="#" className="nav-link">CPID</a>

              <div
                className={`nav-item-dropdown ${openMenu === 'academics' ? 'open' : ''}`}
                onMouseEnter={() => setOpenMenu('academics')}
                onMouseLeave={() => setOpenMenu(null)}
              >
                <a href="#" className="nav-link">Academics <span className="arrow">▾</span></a>
                <div className="dropdown-content">
                  <div className="dropdown-submenu">
                    <a href="/academics/school-of-medicine" className="dropdown-submenu-title">school of medicine <span className="arrow">▸</span></a>
                    <div className="mdropdown-content">
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/medicine/overview'); }}>overview</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/medicine/departments'); }}>departments</a>
                      <a href="/academics/medicine/facilities">facilities</a>
                      <a href="/academics/medicine/partnership-collaboration">partnership and collaboration</a>
                      <a href="/academics/medicine/contacts">contacts</a>
                    </div>
                  </div>
                  <div className="dropdown-submenu">
                    <a href="/academics/school-of-nursing" className="dropdown-submenu-title">school of nursing <span className="arrow">▸</span></a>
                    <div className="mdropdown-content">
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/nursing/about'); }}>about</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/nursing/mission'); }}>mission</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/nursing/vision'); }}>vission</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/nursing/departments'); }}>departments</a>
                      <a href="/academics/nursing/goal">goal</a>
                      <a href="/academics/nursing/staff">stafs</a>
                      <a href="/academics/nursing/contacts">contacts</a>
                    </div>
                  </div>

                  <div className="dropdown-submenu">
                    <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/public-health/about'); }} className="dropdown-submenu-title">school of public health <span className="arrow">▸</span></a>
                    <div className="mdropdown-content">
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/public-health/about'); }}>about</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/public-health/mission-vision'); }}>mission & vission </a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/public-health/departments'); }}>department</a>
                      <a href="/academics/public-health/facilities-services">facility & service</a>
                      <a href="/academics/public-health/research-publication">research & publication</a>
                      <a href="/academics/public-health/staff">stafs</a>
                      <a href="/academics/public-health/contacts">contacts</a>
                    </div>
                  </div>
                  <a href="#">Student portal</a>
                  <a href="#">mentorship</a>
                </div>
              </div>

              <div
                className={`nav-item-dropdown ${openMenu === 'research' ? 'open' : ''}`}
                onMouseEnter={() => setOpenMenu('research')}
                onMouseLeave={() => setOpenMenu(null)}
              >
                <a href="#" className="nav-link">Research <span className="arrow">▾</span></a>
                <div className="dropdown-content">
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/research/background'); }}>Background</a>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/research/vission-mission'); }}>mission & vission</a>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/research/goals'); }}>Goals</a>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/research/functions-irb'); }}>Functions of IRB</a>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/research/roles-responsibilities'); }}>Roles & Responsiblities</a>
                  <a href="#">IDREAM LAB</a>
                  <a href="#">HDSS</a>
                </div>
              </div>

              <div
                className={`nav-item-dropdown ${openMenu === 'offices' ? 'open' : ''}`}
                onMouseEnter={() => setOpenMenu('offices')}
                onMouseLeave={() => setOpenMenu(null)}
              >
                <a href="#" className="nav-link">Offices <span className="arrow">▾</span></a>
                <div className="dropdown-content">
                  <a href="#">Provost office</a>
                  <a href="#">BDVP</a>
                  <a href="#">MSVP office</a>
                  <a href="#">Finance</a>
                  <div className="dropdown-submenu">
                    <a href="/offices/arvp" className="dropdown-submenu-title"> ARVP <span className="arrow">▸</span></a>
                    <div className="mdropdown-content">
                      <a href="/offices/arvp/mission-vision"> ARVP mission & vission </a>
                      <a href="/offices/arvp/achievements">Office Achivments</a>
                      <a href="/offices/arvp/structure">ARVP Structure</a>
                      <a href="/offices/arvp/curriculum-development">Curriculume development</a>
                      <a href="/offices/arvp/community-wellness">Community Wellness</a>
                      <a href="/offices/arvp/responsibilities">ARVP Responsiblities</a>
                    </div>
                  </div>
                </div>
              </div>

              <a href="#" className="nav-link">Services</a>
              <a href="#" className="nav-link">portal</a>
              <a href="#" onClick={(e) => { e.preventDefault(); navigate('/partners'); }} className="nav-link">Partners</a>

              <div className="search-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                  <circle cx="6" cy="8" r="10"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
              </div>
            </nav>
          </div>
        </div>
      </header>

      {/* Main Content Area */}
      <main className="main-content">
        <Routes>
          <Route path="/" element={<Home navigate={navigate} heroImages={heroImages} currentSlide={currentSlide} healthTips={healthTips} />} />
          <Route path="/about" element={<AboutUs onBack={() => navigate('/')} />} />
          <Route path="/about/leaders/*" element={<Leaders onBack={() => navigate('/about')} />} />
          <Route path="/about/mission-vision-values/*" element={<MissionVisionValues onBack={() => navigate('/about')} />} />
          <Route path="/health/tips" element={<HealthTips onBack={() => navigate('/')} />} />
          <Route path="/centers/specialized" element={<SpecializedCenters onBack={() => navigate('/')} />} />
          <Route path="/latests/news" element={<News onBack={() => navigate('/')} />} />
          <Route path="/latests/events" element={<Events onBack={() => navigate('/')} />} />
          <Route path="/latests/announcements" element={<Announcements onBack={() => navigate('/')} />} />
          <Route path="/academics/medicine/overview" element={<Overview onBack={() => navigate('/')} />} />
          <Route path="/academics/medicine/departments" element={<DepartmentsLanding onBack={() => navigate('/')} onSelect={(id) => navigate(`/academics/medicine/departments/${id}`)} />} />
          <Route path="/academics/medicine/departments/basic" element={<BasicSciences onBack={() => navigate('/academics/medicine/departments')} />} />
          <Route path="/academics/medicine/departments/preclinical" element={<Preclinical onBack={() => navigate('/academics/medicine/departments')} />} />
          <Route path="/academics/medicine/departments/clinical" element={<Clinical onBack={() => navigate('/academics/medicine/departments')} />} />
          <Route path="/academics/medicine/departments/specialized" element={<Specialized onBack={() => navigate('/academics/medicine/departments')} />} />
          <Route path="/academics/nursing/about" element={<SchoolOfNursingAbout onBack={() => navigate('/')} />} />
          <Route path="/academics/nursing/mission" element={<SchoolOfNursingMission onBack={() => navigate('/')} />} />
          <Route path="/academics/nursing/vision" element={<SchoolOfNursingVision onBack={() => navigate('/')} />} />
          <Route path="/academics/nursing/departments" element={<SchoolOfNursingDepartments onBack={() => navigate('/')} onSelect={(id) => navigate(`/academics/nursing/departments/${id}`)} />} />
          <Route path="/academics/public-health/about" element={<PublicHealthAbout onBack={() => navigate('/')} />} />
          <Route path="/academics/public-health/mission-vision" element={<PublicHealthMissionVision onBack={() => navigate('/')} />} />
          <Route path="/academics/public-health/departments" element={<PublicHealthDepartments onBack={() => navigate('/')} />} />
          <Route path="/academics/nursing/departments/emergency" element={<EmergencyCriticalCare onBack={() => navigate('/academics/nursing/departments')} />} />
          <Route path="/academics/nursing/departments/neonatal" element={<NeonatalPediatrics onBack={() => navigate('/academics/nursing/departments')} />} />
          <Route path="/academics/nursing/departments/medical" element={<MedicalSurgical onBack={() => navigate('/academics/nursing/departments')} />} />
          <Route path="/academics/nursing/departments/operative" element={<OperativeTheatre onBack={() => navigate('/academics/nursing/departments')} />} />
          <Route path="/research/background" element={<ResearchBackground />} />
          <Route path="/research/vission-mission" element={<ResearchVissionMission />} />
          <Route path="/research/goals" element={<ResearchGoals />} />
          <Route path="/research/functions-irb" element={<FunctionsOfIRB />} />
          <Route path="/research/roles-responsibilities" element={<RolesResponsibilities />} />
          <Route path="/partners" element={<Partners />} />
          {/* Fallback for unknown routes */}
          <Route path="*" element={<Home navigate={navigate} heroImages={heroImages} currentSlide={currentSlide} healthTips={healthTips} />} />
        </Routes>
      </main>

      <div className="floating-actions">
        <div className="action-btn chat-btn">💬</div>
        <div className="action-btn alert-btn">📢</div>
      </div>

      {/* Stats + Latest should appear only on home */}
      {location.pathname === '/' && (
        <>
          {/* What's New / Latest Updates */}
          <section id="latests" className="news-section">
            <div className="container">
              <div className="news-header-top">
                <div className="news-title-group">
                  <div className="news-label">Latest Updates</div>
                  <h2 className="news-main-title" onClick={() => navigate('/latests/news')}>
                    What's New <span className="arrow-link">→</span>
                  </h2>
                </div>
                <button className="view-all-btn" onClick={() => navigate('/latests/news')}>View All News</button>
              </div>

              <div className="news-layout">
                <div className="news-featured" onClick={() => navigate('/latests/news')}>
                  <div className="featured-image-wrapper">
                    <img src={newsImages[currentNewsSlide]} alt="Conference" />
                    <div className="featured-tag">Featured News</div>
                  </div>
                  <div className="featured-content">
                    <h3>SPHMMC Hosts AICS Conference to Advance Excellence in Health Professions Education</h3>
                    <p>Internationalization of Higher Education was the main theme of this year's conference.</p>
                    <span className="read-more">Read Full Story ↗</span>
                  </div>
                </div>
                <div className="news-sidebar">
                  {latestNews.map(item => (
                    <article key={item.id} className="news-item-row" onClick={() => navigate('/latests/news')}>
                      <div className="news-img-placeholder">{item.icon}</div>
                      <div className="news-content">
                        <span className="item-tag">{item.tag}</span>
                        <h4>{item.title}</h4>
                        <span className="news-date">{item.date}</span>
                      </div>
                    </article>
                  ))}
                </div>
              </div>
            </div>
          </section>
        </>
      )}

      {/* Footer */}
      <footer className="main-footer">
        <div className="container">
          <div className="footer-grid">
            <div className="footer-col">
              <h4>About SPHMMC</h4>
              <p>St. Paul's Hospital Millennium Medical College is committed to providing high-quality healthcare and medical education in Ethiopia.</p>
            </div>
            <div className="footer-col">
              <h4>Quick Links</h4>
              <ul className="footer-links">
                <li><a href="#">Academic Calendar</a></li>
                <li><a href="#">Admission Portal</a></li>
                <li><a href="#">Online Journal</a></li>
                <li><a href="#">Careers</a></li>
              </ul>
            </div>
            <div className="footer-col">
              <h4>Contact Us</h4>
              <p>Gulele Sub-City, Addis Ababa, Ethiopia PO Box 1271, Short Code 976</p>
              <p>Phone: +251 112 75 01 25</p>
            </div>
          </div>
          <div className="footer-bottom">
            <p>&copy; {new Date().getFullYear()} St. Paul's Hospital Millennium Medical College. All Rights Reserved.</p>
          </div>
        </div>
      </footer>
    </div>
  )
}

export default App
