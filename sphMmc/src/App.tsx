import { useState, useEffect, type JSX } from 'react'
import { Routes, Route, useNavigate, useLocation } from 'react-router-dom'
import './App.css'
import logo from './assets/images/sphmmc__logo-1 (1).png'
import background from './assets/images/background.jpg'
import { apiService, type LatestPost, type HomeHeroSlide } from './services/api'
import HeroSection from './components/HeroSection'
import HomeNewsSection from './components/HomeNewsSection'
import HomeQuickLinks from './components/HomeQuickLinks'
import HomeGallerySection from './components/HomeGallerySection'

// Static background component for pages
const StaticBackground = ({ children, backgroundImage }: { children: JSX.Element; backgroundImage: string }) => {
  return (
    <>
      {/* Static background image below header */}
      <div 
        className="static-page-background" 
        style={{ 
          position: 'fixed',
          top: '72px',
          left: 0,
          width: '100vw',
          height: '60vh',
          backgroundImage: `url(${backgroundImage})`,
          backgroundSize: 'cover',
          backgroundPosition: 'center',
          backgroundRepeat: 'no-repeat',
          zIndex: 1
        }}
      />
      
      {/* Content that slides over background */}
      <div style={{ position: 'relative', zIndex: 10, marginTop: 'calc(72px + 60vh)' }}>
        {children}
      </div>
    </>
  );
};
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

const FALLBACK_HERO_SLIDES: HomeHeroSlide[] = [
  {
    id: 1,
    title: 'Shaping Ethiopia\'s Medical Future',
    subtitle: 'Excellence in Medical Education',
    description: 'SPHMMC trains the next generation of compassionate healthcare professionals through world-class academic programs.',
    image: paul1,
    button_text: 'Research ↗',
    button_link: '/research/overview',
    display_order: 0,
    status: true,
    created_at: '2026-01-01T00:00:00Z',
    updated_at: '2026-01-01T00:00:00Z',
  },
  {
    id: 2,
    title: 'Advanced Clinical Services',
    subtitle: 'Clinical Excellence',
    description: 'Delivering cutting-edge patient care with state-of-the-art facilities and a team of dedicated specialists.',
    image: paul2,
    button_text: 'Alumni ↗',
    button_link: '/alumni',
    display_order: 1,
    status: true,
    created_at: '2026-01-01T00:00:00Z',
    updated_at: '2026-01-01T00:00:00Z',
  },
  {
    id: 3,
    title: 'Pioneering Medical Research',
    subtitle: 'Research & Innovation',
    description: 'Our research institute drives breakthroughs in tropical medicine, oncology, and public health for East Africa.',
    image: paul3,
    button_text: 'Documents ↗',
    button_link: '/latests/documents',
    display_order: 2,
    status: true,
    created_at: '2026-01-01T00:00:00Z',
    updated_at: '2026-01-01T00:00:00Z',
  },
  {
    id: 4,
    title: 'Serving Our Community',
    subtitle: 'Community Impact',
    description: 'From free health screenings to outreach programs, SPHMMC is committed to improving public health across Ethiopia.',
    image: paul4,
    button_text: 'Health Tips ↗',
    button_link: '/health/tips',
    display_order: 3,
    status: true,
    created_at: '2026-01-01T00:00:00Z',
    updated_at: '2026-01-01T00:00:00Z',
  },
  {
    id: 5,
    title: 'St. Paul\'s Hospital Millennium Medical College',
    subtitle: 'Academic Excellence',
    description: 'A leading academic medical center dedicated to education, research, and clinical service since our founding.',
    image: paul5,
    button_text: 'Centers ↗',
    button_link: '/centers/specialized',
    display_order: 4,
    status: true,
    created_at: '2026-01-01T00:00:00Z',
    updated_at: '2026-01-01T00:00:00Z',
  },
];
import News from './latests/News'
import Events from './latests/Events'
import Announcements from './latests/Announcements'
import Overview from './school-of-medicine/Overview'
import MedicinePartnership from './school-of-medicine/Partnership'
import MedicinePartnershipDetail from './school-of-medicine/PartnershipDetail'
import DepartmentsLanding from './school-of-medicine/Departments'
import BasicSciences from './school-of-medicine/departments/BasicSciences'
import Preclinical from './school-of-medicine/departments/Preclinical'
import Clinical from './school-of-medicine/departments/Clinical'
import Specialized from './school-of-medicine/departments/Specialized'
import SubDepartmentDetail from './school-of-medicine/departments/SubDepartmentDetail'
import MedicineStaffs from './school-of-medicine/Staffs'
import StaffProfile from './school-of-medicine/StaffProfile'
import NursingStaffs from './school-of-nursing/Staffs'
import NursingStaffProfile from './school-of-nursing/StaffProfile'
import PublicHealthStaffs from './school-of-public-health/Staffs'
import PublicHealthStaffProfile from './school-of-public-health/StaffProfile'
import SchoolOfNursingAbout from './school-of-nursing/about'
import SchoolOfNursingMission from './school-of-nursing/mission'
import SchoolOfNursingVision from './school-of-nursing/vision'
import SchoolOfNursingDepartments from './school-of-nursing/departments'
import NursingOverview from './school-of-nursing/Overview'
import NursingPartnership from './school-of-nursing/Partnership'
import NursingPartnershipPage from './school-of-nursing/PartnershipPage'
import NursingPartnershipDetailPage from './school-of-nursing/PartnershipDetail'
import EmergencyCriticalCare from './school-of-nursing/departments/EmergencyCriticalCare'
import NeonatalPediatrics from './school-of-nursing/departments/NeonatalPediatrics'
import MedicalSurgical from './school-of-nursing/departments/MedicalSurgical'
import OperativeTheatre from './school-of-nursing/departments/OperativeTheatre'
import { RolesResponsibilities } from './research'
import { Partners } from './partners'
import Footer from './footer/Footer';
import SpecializedCenters from './centers/SpecializedCenters'
import AboutUs from './about/AboutUs'
import Leaders from './about/Leaders'
import MissionVisionValues from './about/MissionVisionValues'
import Documents from './latests/Documents'
import Alumni from './alumni/Alumni'
import PublicHealthAbout from './school-of-public-health/PublicHealthAbout'
import PublicHealthMissionVision from './school-of-public-health/PublicHealthMissionVision'
import PublicHealthDepartments from './school-of-public-health/departments/PublicHealthDepartments'
import PublicHealthOverview from './school-of-public-health/PublicHealthOverview'
import PublicHealthPartnership from './school-of-public-health/PublicHealthPartnership'
import PublicHealthPartnershipPage from './school-of-public-health/PartnershipPage'
import PublicHealthPartnershipDetailPage from './school-of-public-health/PartnershipDetail'
import DepartmentStaffsPage from './components/DepartmentStaffsPage'
import Statistics from './statistics/Statistics'
import { useParams } from 'react-router-dom'
import AcademicProjects from './academics/AcademicProjects';
import AcademicResearchDetail from './academics/AcademicResearchDetail';
import ResearchOverview from './research/Overview';
import { ResearchProjectsV2 } from './research'
import ResearchPublications from './school-research-publications/ResearchPublications';
import ResearchPublicationDetail from './school-research-publications/ResearchPublicationDetail';
import RegistrarOffice from './offices/Registrar'
import ICTOffice from './offices/ICT'
import LibraryOffice from './offices/Library'
import GenericOffice from './offices/GenericOffice'

// Wrapper to extract slug param for StaffProfile
function StaffProfileRoute({ onBack }: { onBack: () => void }) {
  const { slug = '' } = useParams<{ slug: string }>();
  return <StaffProfile slug={slug} onBack={onBack} />;
}

function NursingStaffProfileRoute({ onBack }: { onBack: () => void }) {
  const { slug = '' } = useParams<{ slug: string }>();
  return <NursingStaffProfile slug={slug} onBack={onBack} />;
}

function PublicHealthStaffProfileRoute({ onBack }: { onBack: () => void }) {
  const { slug = '' } = useParams<{ slug: string }>();
  return <PublicHealthStaffProfile slug={slug} onBack={onBack} />;
}

function AcademicResearchDetailRoute({ onBack }: { onBack: () => void }) {
  return <AcademicResearchDetail onBack={onBack} />;
}

function SchoolResearchPublicationsRoute({ onBack, school, title }: { onBack: () => void; school: 'medicine' | 'nursing' | 'public-health'; title: string }) {
  return <ResearchPublications school={school} title={title} onBack={onBack} />;
}

function SchoolResearchPublicationDetailRoute({ onBack, school, title }: { onBack: () => void; school: 'medicine' | 'nursing' | 'public-health'; title: string }) {
  return <ResearchPublicationDetail school={school} title={title} onBack={onBack} />;
}

interface HomeProps {
  navigate: (path: string) => void;
  slides: HomeHeroSlide[];
  currentSlide: number;
  onPrev: () => void;
  onNext: () => void;
  currentNewsSlide: number;
  newsImages: string[];
  latestNews: any[];
  scrolled: boolean;
  announcements: LatestPost[];
}

function decodeHtmlEntities(html: string) {
  const textarea = document.createElement('textarea');
  textarea.innerHTML = html;
  return textarea.value;
}

function stripHtml(html: string) {
  return decodeHtmlEntities(html.replace(/<[^>]+>/g, ' ')).replace(/\s+/g, ' ').trim();
}

function Home({ navigate, slides, currentSlide, onPrev, onNext, currentNewsSlide, newsImages, latestNews: _latestNews, scrolled, announcements }: HomeProps) {
  return (
    <>
      {/* Two-column HeroSection */}
      <HeroSection
        slides={slides}
        currentSlide={currentSlide}
        onPrev={onPrev}
        onNext={onNext}
        navigate={navigate}
      />

      <HomeQuickLinks navigate={navigate} />

      {/* Explore SPHMMC bar — fixed at bottom of viewport, hidden once user scrolls */}
      <div
        className={`explore-bar${scrolled ? ' explore-bar--hidden' : ''}`}
        onClick={() => {
          const el = document.querySelector('.home-quick-links') as HTMLElement;
          if (el) el.scrollIntoView({ behavior: 'smooth' });
        }}
      >
        <span>Explore SPHMMC</span>
        <span className="explore-chevron">&#8964;</span>
      </div>

      {/* News Section */}
      <HomeNewsSection navigate={navigate} />

      {/* Announcements Section */}
      <section id="latests" className="news-section">
            <div className="container">
              <div className="news-header-top">
                <div className="news-title-group">
                  <div className="news-label">Latest Updates</div>
                  <h2 className="news-main-title" onClick={() => navigate('/latests/announcements')}>
                    Announcements <span className="arrow-link">→</span>
                  </h2>
                </div>
              </div>

              <div className="news-layout">
                {/* Left col: featured image + one card below */}
                <div className="news-left-col">
                  <div className="news-featured" onClick={() => navigate('/latests/announcements')}>
                    <div className="featured-image-wrapper">
                      <img
                        src={announcements[0]?.featured_image ?? newsImages[currentNewsSlide]}
                        alt={announcements[0]?.title ?? 'Featured announcement'}
                      />
                      <div className="featured-tag">Featured</div>
                    </div>
                    <div className="featured-content">
                      <h3>{announcements[0]?.title ?? 'SPHMMC Hosts AICS Conference to Advance Excellence in Health Professions Education'}</h3>
                      <p>{announcements[0]?.content ? `${stripHtml(announcements[0].content).slice(0, 120)}…` : 'Internationalization of Higher Education was the main theme of this year\'s conference.'}</p>
                      <span className="read-more">Read Full Story ↗</span>
                    </div>
                  </div>
                  {/* One card below the featured image */}
                  {announcements[0] && (
                    <article
                      className="announcement-card announcement-card--featured-below"
                      onClick={() => navigate('/latests/announcements')}
                    >
                      <div className="ann-card-inner">
                        <span className="ann-badge">Announcement</span>
                        <h4 className="ann-title">{announcements[0].title}</h4>
                        {announcements[0].content && (
                          <p className="ann-excerpt">{stripHtml(announcements[0].content).slice(0, 110)}…</p>
                        )}
                        <div className="ann-footer">
                          <span className="ann-date">
                            {new Date(announcements[0].created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}
                          </span>
                          <span className="ann-link">Read more →</span>
                        </div>
                      </div>
                      <div className="ann-card-glow" />
                    </article>
                  )}
                </div>

                {/* Right col: remaining cards + view all button */}
                <div className="announcement-cards">
                  {announcements.slice(1).map((item, idx) => (
                    <article
                      key={item.id}
                      className="announcement-card"
                      style={{ animationDelay: `${idx * 0.1}s` }}
                      onClick={() => navigate('/latests/announcements')}
                    >
                      <div className="ann-card-inner">
                        <span className="ann-badge">Announcement</span>
                        <h4 className="ann-title">{item.title}</h4>
                        {item.content && (
                          <p className="ann-excerpt">{stripHtml(item.content).slice(0, 90)}…</p>
                        )}
                        <div className="ann-footer">
                          <span className="ann-date">
                            {new Date(item.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}
                          </span>
                          <span className="ann-link">Read more →</span>
                        </div>
                      </div>
                      <div className="ann-card-glow" />
                    </article>
                  ))}
                  <button
                    className="view-all-ann-btn"
                    onClick={() => navigate('/latests/announcements')}
                  >
                    View All Announcements ↗
                  </button>
                </div>
              </div>
            </div>
          </section>

      {/* Gallery Section */}
      <HomeGallerySection navigate={navigate} />
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
  const [heroSlides, setHeroSlides] = useState<HomeHeroSlide[]>(FALLBACK_HERO_SLIDES);
  const slides = heroSlides.length > 0 ? heroSlides : FALLBACK_HERO_SLIDES;

  const handlePrev = () =>
    setCurrentSlide((prev) => (prev - 1 + slides.length) % slides.length);
  const handleNext = () =>
    setCurrentSlide((prev) => (prev + 1) % slides.length);

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentSlide((prev) => (prev + 1) % slides.length);
    }, 5000);
    return () => clearInterval(interval);
  }, [slides.length]);

  useEffect(() => {
    if (currentSlide >= slides.length) {
      setCurrentSlide(0);
    }
  }, [slides.length, currentSlide]);

  useEffect(() => {
    apiService.getHomeHeroSlides()
      .then((res) => {
        if (res.success && res.data.length > 0) {
          setHeroSlides(res.data.map((slide) => ({
            ...slide,
            image: slide.image ?? slide.image_url ?? null,
          })));
          setCurrentSlide(0);
        } else {
          setHeroSlides(FALLBACK_HERO_SLIDES);
        }
      })
      .catch(() => {
        setHeroSlides(FALLBACK_HERO_SLIDES);
      });
  }, []);

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

  // Announcements from backend (latest_posts table, type=announcement)
  const [announcements, setAnnouncements] = useState<LatestPost[]>([]);
  useEffect(() => {
    apiService.getLatestAnnouncements()
      .then(res => {
        if (res.success && res.data.length > 0) {
          setAnnouncements(res.data.slice(0, 4));
        } else {
          // Fallback test data matching the latest_posts schema
          setAnnouncements([
            { id: 1, title: 'New Academic Calendar 2026/27 Released', slug: 'academic-calendar-2026', content: 'The academic calendar for the upcoming year has been officially approved and published for all students and staff.', type: 'announcement', featured_image: null, file_path: null, event_date: null, author: 'Registrar Office', status: 'published', created_at: '2026-03-28T00:00:00Z', updated_at: '2026-03-28T00:00:00Z' },
            { id: 2, title: 'Postgraduate Residency Application Now Open', slug: 'pg-residency-2026', content: 'Applications for the 2026 postgraduate residency programs in Cardiology, Surgery, and Pediatrics are now open.', type: 'announcement', featured_image: null, file_path: null, event_date: null, author: 'Academic Office', status: 'published', created_at: '2026-03-20T00:00:00Z', updated_at: '2026-03-20T00:00:00Z' },
            { id: 3, title: 'Staff Development Workshop — April 15', slug: 'staff-workshop-april', content: 'All academic staff are invited to attend the professional development workshop on evidence-based teaching methods.', type: 'announcement', featured_image: null, file_path: null, event_date: '2026-04-15', author: 'HR Department', status: 'published', created_at: '2026-03-15T00:00:00Z', updated_at: '2026-03-15T00:00:00Z' },
            { id: 4, title: 'Library Extended Hours During Exam Period', slug: 'library-extended-hours', content: 'The main library will operate extended hours from 6am to midnight during the final examination period.', type: 'announcement', featured_image: null, file_path: null, event_date: null, author: 'Library Services', status: 'published', created_at: '2026-03-10T00:00:00Z', updated_at: '2026-03-10T00:00:00Z' },
          ]);
        }
      })
      .catch(() => {
        setAnnouncements([
          { id: 1, title: 'New Academic Calendar 2026/27 Released', slug: 'academic-calendar-2026', content: 'The academic calendar for the upcoming year has been officially approved and published for all students and staff.', type: 'announcement', featured_image: null, file_path: null, event_date: null, author: 'Registrar Office', status: 'published', created_at: '2026-03-28T00:00:00Z', updated_at: '2026-03-28T00:00:00Z' },
          { id: 2, title: 'Postgraduate Residency Application Now Open', slug: 'pg-residency-2026', content: 'Applications for the 2026 postgraduate residency programs in Cardiology, Surgery, and Pediatrics are now open.', type: 'announcement', featured_image: null, file_path: null, event_date: null, author: 'Academic Office', status: 'published', created_at: '2026-03-20T00:00:00Z', updated_at: '2026-03-20T00:00:00Z' },
          { id: 3, title: 'Staff Development Workshop — April 15', slug: 'staff-workshop-april', content: 'All academic staff are invited to attend the professional development workshop on evidence-based teaching methods.', type: 'announcement', featured_image: null, file_path: null, event_date: '2026-04-15', author: 'HR Department', status: 'published', created_at: '2026-03-15T00:00:00Z', updated_at: '2026-03-15T00:00:00Z' },
          { id: 4, title: 'Library Extended Hours During Exam Period', slug: 'library-extended-hours', content: 'The main library will operate extended hours from 6am to midnight during the final examination period.', type: 'announcement', featured_image: null, file_path: null, event_date: null, author: 'Library Services', status: 'published', created_at: '2026-03-10T00:00:00Z', updated_at: '2026-03-10T00:00:00Z' },
        ]);
      });
  }, []);


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
                    <a href="/academics/school-of-medicine" className="dropdown-submenu-title">School of Medicine <span className="arrow">▸</span></a>
                    <div className="mdropdown-content">
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/medicine/overview'); }}>Overview</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/medicine/departments'); }}>Departments</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/medicine/staffs'); }}>Staffs</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/medicine/partnership-collaboration'); }}>Partnership and Collaboration</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/medicine/research-publications'); }}>Research & Publications</a>
                      <a href="/academics/medicine/contacts">Contacts</a>
                    </div>
                  </div>
                  <div className="dropdown-submenu">
                    <a href="/academics/school-of-nursing" className="dropdown-submenu-title">School of Nursing <span className="arrow">▸</span></a>
                    <div className="mdropdown-content">
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/nursing/overview'); }}>Overview</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/nursing/departments'); }}>Departments</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/nursing/partnership-collaboration'); }}>Partnership and Collaboration</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/nursing/research-publications'); }}>Research & Publications</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/nursing/staffs'); }}>Staffs</a>

                      <a href="/academics/nursing/contacts">contacts</a>
                    </div>
                  </div>

                  <div className="dropdown-submenu">
                    <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/public-health/about'); }} className="dropdown-submenu-title">School of Public Health <span className="arrow">▸</span></a>
                    <div className="mdropdown-content">
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/public-health/overview'); }}>Overview</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/public-health/departments'); }}>Departments</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/public-health/partnership-collaboration'); }}>Partnership and Collaboration</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/public-health/research-publications'); }}>Research & Publications</a>
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/public-health/staffs'); }}>Staffs</a>
                      <a href="/academics/public-health/contacts">Contacts</a>
                    </div>
                  </div>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/academics/academic-research'); }}>Academic Research</a>
                  
                </div>
              </div>

              <div
                className={`nav-item-dropdown ${openMenu === 'research' ? 'open' : ''}`}
                onMouseEnter={() => setOpenMenu('research')}
                onMouseLeave={() => setOpenMenu(null)}
              >
                <a href="#" className="nav-link">Research <span className="arrow">▾</span></a>
                <div className="dropdown-content">
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/research/overview'); }}>Overview</a>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/research/projects'); }}>Research Projects</a>
                  <a href="#"onClick={(e) =>{e.preventDefault(); navigate('/research/roles-responsibilities')}}>Roles&Responsibilities</a>
                </div>
              </div>

              <div
                className={`nav-item-dropdown ${openMenu === 'offices' ? 'open' : ''}`}
                onMouseEnter={() => setOpenMenu('offices')}
                onMouseLeave={() => setOpenMenu(null)}
              >
                <a href="#" className="nav-link">Offices <span className="arrow">▾</span></a>
                <div className="dropdown-content">
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/office/provost'); }}>Provost office</a>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/office/bdvp'); }}>BDVP</a>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/office/msvp'); }}>MSVP office</a>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/office/finance'); }}>Finance</a>
                  <div className="dropdown-submenu">
                    <a href="#" onClick={(e) => { e.preventDefault(); navigate('/office/arvp'); }} className="dropdown-submenu-title"> ARVP <span className="arrow">▸</span></a>
                    <div className="mdropdown-content">
                      <a href="#" onClick={(e) => { e.preventDefault(); navigate('/office/arvp'); }}>ARVP Overview</a>
                      <a href="/offices/arvp/mission-vision">ARVP mission & vision</a>
                      <a href="/offices/arvp/achievements">Office Achievements</a>
                      <a href="/offices/arvp/structure">ARVP Structure</a>
                      <a href="/offices/arvp/curriculum-development">Curriculum development</a>
                      <a href="/offices/arvp/community-wellness">Community Wellness</a>
                      <a href="/offices/arvp/responsibilities">ARVP Responsibilities</a>
                    </div>
                  </div>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/office/registrar'); }}>Registrar</a>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/office/ict'); }}>ICT</a>
                  <a href="#" onClick={(e) => { e.preventDefault(); navigate('/office/library'); }}>Library</a>
                </div>
              </div>

              <a href="https://mjh.sphmmc.edu.et/" className="nav-link">Journal</a>
              <a href="https://portal.sphmmc.edu.et/" className="nav-link">Portal</a>
              <a href="#" onClick={(e) => { e.preventDefault(); navigate('/partners'); }} className="nav-link">Partners</a>

              <div className="header-search">
                <input type="text" placeholder="Search here..." />
                <button>
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                  </svg>
                </button>
              </div>
            </nav>
          </div>
        </div>
      </header>

      {/* Main Content Area */}
      <main className={`main-content${location.pathname === '/' ? '' : ' main-content--page'}`}>
        <Routes>
          <Route path="/" element={<Home navigate={navigate} slides={slides} currentSlide={currentSlide} onPrev={handlePrev} onNext={handleNext} currentNewsSlide={currentNewsSlide} newsImages={newsImages} latestNews={latestNews} scrolled={scrolled} announcements={announcements} />} />
          <Route path="/about" element={<AboutUs onBack={() => navigate('/')} />} />
          <Route path="/about/leaders/*" element={<Leaders onBack={() => navigate('/about')} />} />
          <Route path="/about/mission-vision-values/*" element={<MissionVisionValues onBack={() => navigate('/about')} />} />
          <Route path="/health/tips" element={<HealthTips onBack={() => navigate('/')} />} />
          <Route path="/centers/specialized" element={<SpecializedCenters onBack={() => navigate('/')} />} />
          <Route path="/latests/news" element={<News onBack={() => navigate('/')} />} />
          <Route path="/latests/events" element={<Events onBack={() => navigate('/')} />} />
          <Route path="/latests/announcements" element={<Announcements onBack={() => navigate('/')} />} />
          <Route path="/latests/documents" element={<Documents />} />
          <Route path="/academics/medicine/overview" element={<Overview onBack={() => navigate('/')} />} />
          <Route path="/academics/medicine/partnership-collaboration" element={<MedicinePartnership onBack={() => navigate('/')} />} />
          <Route path="/academics/medicine/partnership-collaboration/:slug" element={<MedicinePartnershipDetail onBack={() => navigate('/academics/medicine/partnership-collaboration')} />} />
          <Route path="/academics/medicine/departments" element={<DepartmentsLanding onBack={() => navigate('/')} onSelect={(id) => navigate(`/academics/medicine/departments/${id}`)} />} />
          <Route path="/academics/medicine/departments/basic" element={<BasicSciences onBack={() => navigate('/academics/medicine/departments')} />} />
          <Route path="/academics/medicine/departments/preclinical" element={<Preclinical onBack={() => navigate('/academics/medicine/departments')} />} />
          <Route path="/academics/medicine/departments/clinical" element={<Clinical onBack={() => navigate('/academics/medicine/departments')} />} />
          <Route path="/academics/medicine/departments/specialized" element={<Specialized onBack={() => navigate('/academics/medicine/departments')} />} />
          <Route path="/academics/medicine/departments/:deptSlug/sub/:subDeptId" element={<SubDepartmentDetail onBack={(deptSlug) => navigate(`/academics/medicine/departments/${deptSlug}`)} />} />
          <Route path="/academics/medicine/staffs" element={<MedicineStaffs onBack={() => navigate('/')} onViewProfile={(slug) => navigate(`/academics/medicine/staffs/${slug}`)} />} />
          <Route path="/academics/medicine/staffs/:slug" element={<StaffProfileRoute onBack={() => navigate('/academics/medicine/staffs')} />} />
          <Route path="/academics/nursing/staffs" element={<NursingStaffs onBack={() => navigate('/')} onViewProfile={(slug) => navigate(`/academics/nursing/staffs/${slug}`)} />} />
          <Route path="/academics/nursing/staffs/:slug" element={<NursingStaffProfileRoute onBack={() => navigate('/academics/nursing/staffs')} />} />
          <Route path="/academics/public-health/staffs" element={<PublicHealthStaffs onBack={() => navigate('/')} onViewProfile={(slug) => navigate(`/academics/public-health/staffs/${slug}`)} />} />
          <Route path="/academics/public-health/staffs/:slug" element={<PublicHealthStaffProfileRoute onBack={() => navigate('/academics/public-health/staffs')} />} />
          <Route path="/academics/nursing/about" element={<SchoolOfNursingAbout onBack={() => navigate('/')} />} />
          <Route path="/academics/nursing/mission" element={<SchoolOfNursingMission onBack={() => navigate('/')} />} />
          <Route path="/academics/nursing/vision" element={<SchoolOfNursingVision onBack={() => navigate('/')} />} />
          <Route path="/academics/nursing/overview" element={<NursingOverview onBack={() => navigate('/')} />} />
          <Route path="/academics/nursing/partnership-collaboration" element={<NursingPartnershipPage onBack={() => navigate('/')} />} />
          <Route path="/academics/nursing/partnership-collaboration/:slug" element={<NursingPartnershipDetailPage onBack={() => navigate('/academics/nursing/partnership-collaboration')} />} />
          <Route path="/academics/nursing/departments" element={<SchoolOfNursingDepartments onBack={() => navigate('/')} onSelect={(id) => navigate(`/academics/nursing/departments/${id}`)} />} />
          <Route path="/academics/public-health/about" element={<PublicHealthAbout onBack={() => navigate('/')} />} />
          <Route path="/academics/public-health/mission-vision" element={<PublicHealthMissionVision onBack={() => navigate('/')} />} />
          <Route path="/academics/public-health/overview" element={<PublicHealthOverview onBack={() => navigate('/')} />} />
          <Route path="/academics/public-health/departments" element={<PublicHealthDepartments onBack={() => navigate('/')} />} />
          <Route path="/academics/:school/department-staffs/:departmentKey" element={<DepartmentStaffsPage />} />
          <Route path="/academics/public-health/partnership-collaboration" element={<PublicHealthPartnershipPage onBack={() => navigate('/')} />} />
          <Route path="/academics/public-health/partnership-collaboration/:slug" element={<PublicHealthPartnershipDetailPage onBack={() => navigate('/academics/public-health/partnership-collaboration')} />} />
          <Route path="/academics/public-health/research-publications" element={<SchoolResearchPublicationsRoute onBack={() => navigate('/academics/public-health/overview')} school="public-health" title="School of Public Health" />} />
          <Route path="/academics/public-health/research-publications/:slug" element={<SchoolResearchPublicationDetailRoute onBack={() => navigate('/academics/public-health/research-publications')} school="public-health" title="School of Public Health" />} />
          <Route path="/academics/nursing/research-publications" element={<SchoolResearchPublicationsRoute onBack={() => navigate('/academics/nursing/overview')} school="nursing" title="School of Nursing" />} />
          <Route path="/academics/nursing/research-publications/:slug" element={<SchoolResearchPublicationDetailRoute onBack={() => navigate('/academics/nursing/research-publications')} school="nursing" title="School of Nursing" />} />
          <Route path="/academics/medicine/research-publications" element={<SchoolResearchPublicationsRoute onBack={() => navigate('/academics/medicine/overview')} school="medicine" title="School of Medicine" />} />
          <Route path="/academics/medicine/research-publications/:slug" element={<SchoolResearchPublicationDetailRoute onBack={() => navigate('/academics/medicine/research-publications')} school="medicine" title="School of Medicine" />} />
          <Route path="/academics/nursing/departments/emergency" element={<EmergencyCriticalCare onBack={() => navigate('/academics/nursing/departments')} />} />
          <Route path="/academics/nursing/departments/neonatal" element={<NeonatalPediatrics onBack={() => navigate('/academics/nursing/departments')} />} />
          <Route path="/academics/nursing/departments/medical" element={<MedicalSurgical onBack={() => navigate('/academics/nursing/departments')} />} />
          <Route path="/academics/nursing/departments/operative" element={<OperativeTheatre onBack={() => navigate('/academics/nursing/departments')} />} />
          <Route path="/research/overview" element={<ResearchOverview />} />
          <Route path="/research/projects" element={<ResearchProjectsV2 />} />
          <Route path="/research/roles-responsibilities" element={<RolesResponsibilities />} />
          <Route path="/academics/academic-research" element={<AcademicProjects onBack={() => navigate('/')} onViewProject={(slug) => navigate(`/academics/academic-research/${slug}`)} />} />
          <Route path="/academics/academic-research/:slug" element={<AcademicResearchDetailRoute onBack={() => navigate('/academics/academic-research')} />} />
          <Route path="/partners" element={<Partners />} />
           <Route path="/alumni" element={<Alumni onBack={() => navigate("/")} />} />
          <Route path="/office/registrar" element={<RegistrarOffice onBack={() => navigate('/')} />} />
          <Route path="/office/ict" element={<ICTOffice onBack={() => navigate('/')} />} />
          <Route path="/office/library" element={<LibraryOffice onBack={() => navigate('/')} />} />
          <Route path="/office/provost" element={<GenericOffice onBack={() => navigate('/')} officeType="provost" />} />
          <Route path="/office/bdvp" element={<GenericOffice onBack={() => navigate('/')} officeType="bdvp" />} />
          <Route path="/office/msvp" element={<GenericOffice onBack={() => navigate('/')} officeType="msvp" />} />
          <Route path="/office/finance" element={<GenericOffice onBack={() => navigate('/')} officeType="finance" />} />
          <Route path="/office/arvp" element={<GenericOffice onBack={() => navigate('/')} officeType="arvp" />} />
          {/* Fallback for unknown routes */}
          <Route path="*" element={<Home navigate={navigate} slides={slides} currentSlide={currentSlide} onPrev={handlePrev} onNext={handleNext} currentNewsSlide={currentNewsSlide} newsImages={newsImages} latestNews={latestNews} scrolled={scrolled} announcements={announcements} />} />
        </Routes>
      </main>

      <div className="floating-actions">
        <div className="action-btn chat-btn">💬</div>
        <div className="action-btn alert-btn">📢</div>
      </div>

      {/* Stats + Latest should appear only on home */}
      {location.pathname === '/' && (
        <>
          {/* Statistics Section */}
                    <section className="statistics-section">
            <div className="container">
              <div className="section-title">
                <h2>SPHMMC by the Numbers</h2>
                <p>Our commitment to excellence in healthcare education and service delivery</p>
              </div>
<Statistics />
            </div>
          </section>
        </>) }
      



{/* Footer */}
<Footer />
  </div>
  )
}

export default App
