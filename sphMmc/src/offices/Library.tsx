import './Office.css';

interface Props { onBack: () => void }

export default function LibraryOffice({ onBack }: Props) {
  return (
    <div className="office-page">
      <div className="office-hero">
        <div className="office-container">
          <button className="office-back-btn" onClick={onBack}>← Back</button>
          <span className="office-badge">SPHMMC · Offices</span>
          <h1 className="office-hero-title">Library</h1>
          <p className="office-hero-sub">Your gateway to knowledge — books, journals, digital resources, and research support.</p>
        </div>
      </div>

      <div className="office-container office-body">

        <div className="office-section">
          <h2>About the Library</h2>
          <p>The SPHMMC Library is a comprehensive academic resource center supporting the educational, research, and clinical needs of students, faculty, and healthcare professionals. Our collection spans medical sciences, nursing, public health, and related disciplines.</p>
          <p>We provide access to both physical and digital resources, ensuring that our community has the information they need to excel in their academic and professional pursuits.</p>
        </div>

        <div className="office-section">
          <h2>Library Resources</h2>
          <div className="office-cards">
            <div className="office-card">
              <span className="office-card-icon">📖</span>
              <h3>Books & Textbooks</h3>
              <p>Extensive collection of medical, nursing, and public health textbooks and reference materials.</p>
            </div>
            <div className="office-card">
              <span className="office-card-icon">📰</span>
              <h3>Journals & Periodicals</h3>
              <p>Subscriptions to leading medical and scientific journals, both print and digital.</p>
            </div>
            <div className="office-card">
              <span className="office-card-icon">💻</span>
              <h3>Online Databases</h3>
              <p>Access to PubMed, HINARI, Cochrane Library, and other research databases.</p>
            </div>
            <div className="office-card">
              <span className="office-card-icon">🔬</span>
              <h3>Research Materials</h3>
              <p>Theses, dissertations, and institutional research publications from SPHMMC.</p>
            </div>
            <div className="office-card">
              <span className="office-card-icon">🖥️</span>
              <h3>Digital Library</h3>
              <p>Remote access to e-books and online resources for registered members.</p>
            </div>
            <div className="office-card">
              <span className="office-card-icon">🤝</span>
              <h3>Research Support</h3>
              <p>Librarian-assisted literature searches and citation management guidance.</p>
            </div>
          </div>
        </div>

        <div className="office-section">
          <h2>Opening Hours</h2>
          <table className="office-hours">
            <thead>
              <tr>
                <th>Day</th>
                <th>Hours</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Monday – Friday</td><td>7:30 AM – 9:00 PM</td></tr>
              <tr><td>Saturday</td><td>8:00 AM – 6:00 PM</td></tr>
              <tr><td>Sunday</td><td>10:00 AM – 4:00 PM</td></tr>
              <tr><td>Public Holidays</td><td>Closed</td></tr>
            </tbody>
          </table>
          <p style={{ marginTop: '0.75rem', fontSize: '0.85rem', color: '#888' }}>
            * Extended hours during examination periods. Check announcements for updates.
          </p>
        </div>

        <div className="office-section">
          <h2>Contact Information</h2>
          <div className="office-contact">
            <div className="office-contact-item">
              <span className="office-contact-label">Location</span>
              <span className="office-contact-value">Main Campus, Library Building</span>
            </div>
            <div className="office-contact-item">
              <span className="office-contact-label">Email</span>
              <span className="office-contact-value"><a href="mailto:library@sphmmc.edu.et">library@sphmmc.edu.et</a></span>
            </div>
            <div className="office-contact-item">
              <span className="office-contact-label">Phone</span>
              <span className="office-contact-value">+251 11 275 3420</span>
            </div>
            <div className="office-contact-item">
              <span className="office-contact-label">Membership</span>
              <span className="office-contact-value">Open to all SPHMMC students and staff</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  );
}
