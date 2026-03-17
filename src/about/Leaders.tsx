import React, { useState, useEffect } from 'react';
import { useLocation } from 'react-router-dom';
import './Leaders.css';

// Mock images (these should be replaced with the ones generated or real ones)
import provostImg from '../assets/images/leader_muluken.png';
import bdvpImg from '../assets/images/leader_jemal.png';
import amsvpImg from '../assets/images/leader_lemi.png';
import rcsvpImg from '../assets/images/leader_ewenat.png';

interface Initiative {
  title: string;
  objective: string;
  outcome: string;
}

interface Leader {
  id: string;
  name: string;
  title: string;
  prefix: string;
  bio: string;
  image: string;
  viewOfficeBtn?: boolean;
  officeDropdown?: {
    title: string;
    links: { name: string; url: string }[];
  };
  initiatives?: {
    label: string;
    items: Initiative[];
  };
}

const Leaders: React.FC<{ onBack: () => void }> = ({ onBack }) => {
  const location = useLocation();
  const [activeTab, setActiveTab] = useState<string>('provost');
  const [expandedInitiative, setExpandedInitiative] = useState<number | null>(null);
  const [showOfficeDropdown, setShowOfficeDropdown] = useState<boolean>(false);

  const leadersData: Leader[] = [
    {
      id: 'provost',
      prefix: 'Dr.',
      name: 'Muluken Tesfaye',
      title: 'Chief Executive Director / Provost',
      image: provostImg,
      bio: `Dr. Muluken Tesfaye is the new Chief Executive Director of St. Paul’s Hospital Millennium Medical College (SPHMMC). He was appointed last week by H.E. Dr. Mekdes Daba, Minister of Health. Dr. Muluken brings over a decade of experience as a clinician, academician, healthcare leader, and program manager. He has served SPHMMC as Assistant Professor, Head of the Department of Psychiatry, and member of the Academic Council and Senate (2018–2023). During this time, he also worked as Senior Advisor for Medical Services in the Office of the Vice Provost. Since September 2023, Dr. Muluken has been leading Eka Kotebe Hospital as Chief Executive Director. He is also a former President of the Ethiopian Psychiatric Association.`,
      officeDropdown: {
        title: "Explore Provost's Office",
        links: [
          { name: "Office Background & Mandate", url: "#" },
          { name: "Strategic Initiatives", url: "#" },
          { name: "Executive Team", url: "#" },
          { name: "Contact Providence", url: "#" }
        ]
      }
    },
    {
      id: 'bdvp',
      prefix: 'Mr.',
      name: 'Jemal Shifa Mussa',
      title: 'Business Development Vice Provost (BDVP)',
      image: bdvpImg,
      bio: `Mr. Jemal Shifa Mussa is a seasoned healthcare leader with extensive experience in public health and hospital management. He earned his Bachelor of Science in Public Health (BSc) degree from Dilla University, Faculty of Health Science, and further pursued graduate study with a Master of Public Health (MPH) at Addis Continental Institute of Public Health, Addis Ababa. He currently serves as the Business Development Vice Provost (BDVP) at St. Paul’s Hospital Millennium Medical College. Prior to this role, he was the Chief Executive Director at Werabe Comprehensive Specialized Hospital, where he successfully established numerous specialty services and led major healthcare initiatives. 

      Jemal Shifa Mussa has been recognized for his exceptional leadership in enhancing Ethiopian healthcare services through innovation and community engagement, having led numerous projects recognized by the Ministry of Health, demonstrating a strong commitment to national excellence. He has been awarded excellence in healthcare service quality at national levels.`,
      officeDropdown: {
        title: "Explore BDVP Office",
        links: [
          { name: "Business Strategy", url: "#" },
          { name: "Partnerships & Collaborations", url: "#" },
          { name: "Infrastructure Development", url: "#" },
          { name: "Resource Management", url: "#" }
        ]
      },
      initiatives: {
        label: "Key Initiatives in the BDVP Office",
        items: [
          {
            title: "Expansion of Specialty Services",
            objective: "To broaden the range of medical services available to the community.",
            outcome: "Successfully established numerous specialty and sub-specialty services, including neurosurgery, cardiothoracic surgery, and pediatric surgery, improving access to advanced healthcare for over 5 million people."
          },
          {
            title: "Quality Improvement Projects",
            objective: "To enhance the quality of healthcare services provided.",
            outcome: "Led over ten hospital clinical service quality improvement projects, with two recognized nationally. These initiatives focused on compassionate care, patient safety, and operational efficiency."
          },
          {
            title: "Research Center Development",
            objective: "To foster research and innovation within the institution.",
            outcome: "Established a research center that is currently under construction with an investment of over 200 million birr, promoting academic research and collaboration with various stakeholders."
          },
          {
            title: "Community Healthcare Programs",
            objective: "To enhance community health through outreach and education.",
            outcome: "Implemented various community-based health initiatives and programs that focus on preventive care and health education, improving overall public health outcomes."
          },
          {
            title: "Academic Program Development",
            objective: "To strengthen academic offerings in healthcare education.",
            outcome: "Led the preparation of medical college proclamations and curricula to enhance academic programs across three medical schools within the hospital."
          },
          {
            title: "Partnerships and Collaborations",
            objective: "To leverage resources and expertise from external partners.",
            outcome: "Collaborated with various organizations to establish skill labs, biomedical workshops, and community pharmacy centers, enhancing service delivery capabilities."
          },
          {
            title: "Hospital Service Transformation Initiatives",
            objective: "To modernize hospital operations and improve patient care.",
            outcome: "Successfully implemented the Clean and Safe Hospital Initiative and other national quality initiatives that have positioned the hospital as a leader in healthcare service quality."
          }
        ]
      }
    },
    {
      id: 'amsvp',
      prefix: 'Dr.',
      name: 'Lemi Belay',
      title: 'Academic and Medical Services Corporate Director',
      image: amsvpImg,
      bio: `Dr. Lemi Belay was appointed last week as the new Academic and Medical Services Corporate Director of SPHMMC by Her Excellency Dr. Mekdes Daba, Minister of Health.

      An Associate Professor of Obstetrics and Gynecology, Dr. Lemi specializes in Family Planning and Reproductive Health as well as Maternal and Fetal Medicine. He is a distinguished researcher, educator, and trainer, with more than 65 publications in leading international journals.

      Dr. Lemi has made significant contributions to the development of international and national reproductive health guidelines, protocols, and training materials—including valuable inputs to World Health Organization (WHO) protocols and guidelines.

      Beyond academia, he has shown strong leadership and professional service. He has served as Clinical Vice Chair of the Department of Obstetrics and Gynecology, Ethiopia’s Country Representative for WATOG, and as a Medical Officer with international organizations such as WHO Headquarters (Geneva), WHO AFRO, and UNFPA.`,
      officeDropdown: {
        title: "Explore AMSVP Office",
        links: [
          { name: "Academic Programs", url: "#" },
          { name: "Clinical Excellence Guidelines", url: "#" },
          { name: "Medical Services Coordination", url: "#" },
          { name: "Student & Faculty Resources", url: "#" }
        ]
      }
    },
    {
      id: 'rcsvp',
      prefix: 'Dr.',
      name: 'Ewenat Gebrehanna',
      title: 'Research and Community Service Vice Provost',
      image: rcsvpImg,
      bio: `Dr. Ewenat Gebrehanna has been appointed as the new Research and Community Service Corporate Director of SPHMMC. Dr. Ewenat is a distinguished public health researcher and academician with over 20 years of experience managing diverse research projects and leading collaborations across institutions in Ethiopia and internationally. 

      She currently serves as an Associate Professor at SPHMMC, where she leads major grant-funded initiatives focused on reproductive health, gender equity, and health systems strengthening. She holds a PhD in Public Health from the University of Gondar and an MPH from Addis Ababa University. 

      At SPHMMC, she has served in the School of Public Health since 2017, contributing to the reproductive health unit, coordinating the HDSS program, and successfully leading eight externally funded projects as Principal Investigator (PI). Dr. Ewenat is a strong advocate for locally driven, evidence-based policy and has been instrumental in advancing research capacity and gender mainstreaming in health systems. She also serves as an Executive Board Member of the Ethiopian Public Health Association (EPHA).`,
      officeDropdown: {
        title: "Explore RCSVP Office",
        links: [
          { name: "Research Ethics (IRB)", url: "#" },
          { name: "Community Outreach Programs", url: "#" },
          { name: "Grants & Publications", url: "#" },
          { name: "HDSS Program Details", url: "#" }
        ]
      }
    }
  ];

  // Map route path to active tab
  useEffect(() => {
    const path = location.pathname;
    if (path.includes('provost')) setActiveTab('provost');
    else if (path.includes('business-development')) setActiveTab('bdvp');
    else if (path.includes('academic-medical-service')) setActiveTab('amsvp');
    else if (path.includes('research-community-service')) setActiveTab('rcsvp');
  }, [location.pathname]);

  const activeLeader = leadersData.find(l => l.id === activeTab) || leadersData[0];

  return (
    <div className="leaders-page">
      <div className="leaders-header">
        <div className="container">
          <button className="back-link" onClick={onBack}>← Back to About</button>
          <h1>Institutional Leadership</h1>
          <p>Meet the visionary leaders steering SPHMMC towards a future of healthcare excellence.</p>
        </div>
      </div>

      <div className="leaders-nav-bar">
        <div className="container">
          <div className="nav-tabs">
            {leadersData.map(leader => (
              <button 
                key={leader.id}
                className={`tab-btn ${activeTab === leader.id ? 'active' : ''}`}
                onClick={() => {
                  setActiveTab(leader.id);
                  setExpandedInitiative(null);
                  setShowOfficeDropdown(false);
                }}
              >
                {leader.name.split(' ').slice(-1)}
                <span className="full-name">{leader.name}</span>
              </button>
            ))}
          </div>
        </div>
      </div>

      <section className="leader-profile-section container">
        <div className="profile-grid">
          <div className="profile-image-card fade-in">
            <div className="image-wrapper shadow-premium">
              <img src={activeLeader.image} alt={activeLeader.name} />
              <div className="image-overlay"></div>
            </div>
            <div className="profile-meta">
              <span className="leader-prefix">{activeLeader.prefix}</span>
              <h2 className="leader-name">{activeLeader.name}</h2>
              <p className="leader-title-sub">{activeLeader.title}</p>
            </div>
          </div>

          <div className="profile-details-card fade-in-up">
            <div className="bio-content">
              <h3>Biography</h3>
              <div className="bio-text">
                {activeLeader.bio.split('\n\n').map((para, i) => (
                  <p key={i}>{para.trim()}</p>
                ))}
              </div>
              
              {activeLeader.officeDropdown && (
                <div className="leader-office-dropdown">
                  <button 
                    className="btn btn-primary-gold view-office-btn"
                    onClick={() => setShowOfficeDropdown(!showOfficeDropdown)}
                  >
                    {activeLeader.officeDropdown.title} <span className="chevron">{showOfficeDropdown ? '▴' : '▾'}</span>
                  </button>
                  
                  {showOfficeDropdown && (
                    <div className="office-dropdown-menu fade-in">
                      {activeLeader.officeDropdown.links.map((link, idx) => (
                        <a key={idx} href={link.url} className="office-dropdown-item">
                          {link.name} <span className="arrow-right">→</span>
                        </a>
                      ))}
                    </div>
                  )}
                </div>
              )}

              {activeLeader.initiatives && (
                <div className="initiatives-container">
                  <div className="initiatives-header-link">
                    <span className="sparkle">✦</span> {activeLeader.initiatives.label}
                  </div>
                  
                  <div className="initiatives-list">
                    {activeLeader.initiatives.items.map((item, index) => (
                      <div 
                        key={index} 
                        className={`initiative-item ${expandedInitiative === index ? 'expanded' : ''}`}
                      >
                        <button 
                          className="initiative-trigger"
                          onClick={() => setExpandedInitiative(expandedInitiative === index ? null : index)}
                        >
                          <span className="item-title">{item.title}</span>
                          <span className="chevron transition-all">{expandedInitiative === index ? '▾' : '▸'}</span>
                        </button>
                        
                        {expandedInitiative === index && (
                          <div className="initiative-content fade-in">
                            <div className="content-group">
                              <label>Objective</label>
                              <p>{item.objective}</p>
                            </div>
                            <div className="content-group">
                              <label>Outcome</label>
                              <p>{item.outcome}</p>
                            </div>
                          </div>
                        )}
                      </div>
                    ))}
                  </div>
                </div>
              )}
            </div>
          </div>
        </div>
      </section>

      <div className="leadership-footer-note container">
        <p>These initiatives reflect a comprehensive approach to institutional development at SPHMMC, focusing on improving healthcare delivery, fostering academic growth, and enhancing professional excellence.</p>
      </div>
    </div>
  );
};

export default Leaders;
