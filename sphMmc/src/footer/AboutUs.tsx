import React from 'react';

interface AboutUsProps {
  title: string;
  links?: { label: string; href: string }[];
}

const AboutUs: React.FC<AboutUsProps> = ({ title, links = [] }) => {
  return (
    <div className="footer-section">
      <h3>{title}</h3>
      <ul>
        {links.map((link, idx) => (
          <li key={idx}>
            <a href={link.href}>{link.label}</a>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default AboutUs;
