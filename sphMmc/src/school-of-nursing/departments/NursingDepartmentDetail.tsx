import { useEffect, useState, type JSX } from 'react'
import { useNavigate } from 'react-router-dom'
import { apiService, type NursingDepartmentDetail as DeptData } from '../../services/api'
import './EmergencyCriticalCare.css'
import './NeonatalPediatrics.css'
import './MedicalSurgical.css'
import './OperativeTheatre.css'

const ROOT_CLASS: Record<string, string> = {
  emergency: 'emergency-critical-care',
  neonatal: 'neonatal-pediatrics',
  medical: 'medical-surgical',
  operative: 'operative-theatre',
}

interface Props {
  slug: string
  onBack: () => void
}

function NursingDepartmentDetail({ slug, onBack }: Props): JSX.Element {
  const [data, setData] = useState<DeptData | null>(null)
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)
  const navigate = useNavigate()

  useEffect(() => {
    let cancelled = false
    setLoading(true)
    setError(null)
    apiService.getNursingDepartment(slug)
      .then((dept) => {
        if (!cancelled) setData(dept)
      })
      .catch(() => {
        if (!cancelled) setError('Failed to load department.')
      })
      .finally(() => {
        if (!cancelled) setLoading(false)
      })
    return () => { cancelled = true }
  }, [slug])

  const rootClass = ROOT_CLASS[slug] ?? 'emergency-critical-care'

  if (loading) {
    return (
      <div className={rootClass}>
        <div className="department-content">
          <div className="container" style={{ padding: '3rem 0', textAlign: 'center' }}>Loading…</div>
        </div>
      </div>
    )
  }

  if (error || !data) {
    return (
      <div className={rootClass}>
        <div className="department-content">
          <div className="container" style={{ padding: '3rem 0', textAlign: 'center' }}>
            <p>{error ?? 'Department not found.'}</p>
            <button onClick={onBack} className="back-btn" style={{ marginTop: '1rem' }}>← Back</button>
          </div>
        </div>
      </div>
    )
  }

  return (
    <div className={rootClass}>
      <section className="department-hero">
        <div className="hero-overlay">
          <div className="container">
            <button onClick={onBack} className="back-btn">← Back</button>
            <h1>{data.page_title ?? data.title}</h1>
            <p>{data.hero_tagline ?? data.subtitle}</p>
            <button
              type="button"
              className="back-btn"
              onClick={() => navigate(`/academics/nursing/department-staffs/${slug}`)}
              style={{ marginTop: '1rem', fontSize: '1rem', padding: '0.85rem 1.4rem' }}
            >
              View Staffs
            </button>
          </div>
        </div>
      </section>

      <section className="department-content">
        <div className="container">
          <div className="overview-section">
            <h2>Department Overview</h2>
            <div className="overview-content">
              <div className="mission-statement">
                <div className="mission-icon">{data.icon}</div>
                <div className="mission-text">
                  <h3>Our Mission</h3>
                  <p>{data.mission_text}</p>
                </div>
              </div>
              {data.intro && (
                <div className="department-intro">
                  <p>{data.intro}</p>
                </div>
              )}
            </div>
          </div>

          {data.areas.length > 0 && (
            <div className="areas-section">
              <h2>Specialization Areas</h2>
              <div className="areas-grid">
                {data.areas.map((area) => (
                  <div className="area-card" key={area.title}>
                    <div className="area-icon">{area.icon}</div>
                    <h3>{area.title}</h3>
                    <p>{area.description}</p>
                    <ul className="area-features">
                      {area.features.map((f) => <li key={f}>{f}</li>)}
                    </ul>
                  </div>
                ))}
              </div>
            </div>
          )}

          {data.training.length > 0 && (
            <div className="training-section">
              <h2>Clinical Training Excellence</h2>
              <div className="training-grid">
                {data.training.map((item) => (
                  <div className="training-item" key={item.title}>
                    <div className="training-header">
                      <h3>{item.title}</h3>
                      <div className="training-icon">{item.icon}</div>
                    </div>
                    <p>{item.description}</p>
                    <div className="training-features">
                      {item.features.map((f) => (
                        <div className="feature-item" key={f}>
                          <span className="feature-icon">✓</span>
                          <span>{f}</span>
                        </div>
                      ))}
                    </div>
                  </div>
                ))}
              </div>
            </div>
          )}

          {data.careers.length > 0 && (
            <div className="career-section">
              <h2>Career Opportunities</h2>
              <div className="career-grid">
                {data.careers.map((career) => (
                  <div className="career-item" key={career.title}>
                    <div className="career-icon">{career.icon}</div>
                    <h3>{career.title}</h3>
                    <ul className="career-list">
                      {career.items.map((item) => <li key={item}>{item}</li>)}
                    </ul>
                  </div>
                ))}
              </div>
            </div>
          )}

          {data.stats.length > 0 && (
            <div className="stats-section">
              <h2>Department Impact</h2>
              <div className="stats-grid">
                {data.stats.map((stat) => (
                  <div className="stat-item" key={stat.label}>
                    <div className="stat-number">{stat.number}</div>
                    <div className="stat-label">{stat.label}</div>
                    <div className="stat-desc">{stat.description}</div>
                  </div>
                ))}
              </div>
            </div>
          )}
        </div>
      </section>
    </div>
  )
}

export default NursingDepartmentDetail
