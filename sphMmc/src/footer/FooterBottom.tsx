import React from 'react';
import './footer.css';

const FooterBottom: React.FC = () => {
  return (
    <div className="footer-bottom">
      <p>© {new Date().getFullYear()} St. Paul’s Hospital Millennium Medical College. All rights reserved.</p>
    </div>
  );
};

export default FooterBottom;
