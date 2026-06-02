import './HomeQuickLinks.css';

interface Props {
  navigate: (path: string) => void;
}

const LINKS = [
  {
    id: 'health-tips',
    label: 'Health Tips',
    description: 'Wellness & prevention',
    path: '/health/tips',
    external: false,
    icon: (
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" aria-hidden>
        <path d="M12 21s-7-4.35-7-10a4 4 0 0 1 7-2.5A4 4 0 0 1 19 11c0 5.65-7 10-7 10z" />
        <path d="M12 8v6M9 11h6" />
      </svg>
    ),
  },
  {
    id: 'alumni',
    label: 'Alumni',
    description: 'Our graduates',
    path: '/alumni',
    external: false,
    icon: (
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" aria-hidden>
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
        <circle cx="9" cy="7" r="4" />
        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
      </svg>
    ),
  },
  {
    id: 'library',
    label: 'Library',
    description: 'Digital resources',
    path: 'https://sphmmc.edu.et/library/',
    external: true,
    icon: (
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" aria-hidden>
        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
      </svg>
    ),
  },
  {
    id: 'specialized-centers',
    label: 'Specialised Centres',
    description: 'Clinical excellence',
    path: '/centers/specialized',
    external: false,
    icon: (
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" aria-hidden>
        <rect x="3" y="3" width="7" height="7" rx="1" />
        <rect x="14" y="3" width="7" height="7" rx="1" />
        <rect x="3" y="14" width="7" height="7" rx="1" />
        <rect x="14" y="14" width="7" height="7" rx="1" />
      </svg>
    ),
  },
] as const;

export default function HomeQuickLinks({ navigate }: Props) {
  return (
    <section className="home-quick-links" aria-label="Quick links">
      <div className="home-quick-links__inner">
        {LINKS.map((link) =>
          link.external ? (
            <a
              key={link.id}
              href={link.path}
              target="_blank"
              rel="noopener noreferrer"
              className="home-quick-links__btn"
            >
              <span className="home-quick-links__icon">{link.icon}</span>
              <span className="home-quick-links__text">
                <span className="home-quick-links__label">{link.label}</span>
                <span className="home-quick-links__desc">{link.description}</span>
              </span>
              <span className="home-quick-links__arrow" aria-hidden>↗</span>
            </a>
          ) : (
            <button
              key={link.id}
              type="button"
              className="home-quick-links__btn"
              onClick={() => navigate(link.path)}
            >
              <span className="home-quick-links__icon">{link.icon}</span>
              <span className="home-quick-links__text">
                <span className="home-quick-links__label">{link.label}</span>
                <span className="home-quick-links__desc">{link.description}</span>
              </span>
              <span className="home-quick-links__arrow" aria-hidden>→</span>
            </button>
          ),
        )}
      </div>
    </section>
  );
}
