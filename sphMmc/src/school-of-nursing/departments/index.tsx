import { useEffect, useState, type JSX } from 'react'
import { apiService, type NursingDepartmentsIndex } from '../../services/api'
import './departments.css'

interface Props {
  onBack: () => void
  onSelect: (id: string) => void
}

function SchoolOfNursingDepartments({ onBack, onSelect }: Props): JSX.Element {
  const [data, setData] = useState<NursingDepartmentsIndex | null>(null)
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    let cancelled = false
    apiService.getNursingDepartments()
      .then((res) => { if (!cancelled) setData(res) })
      .catch(() => { if (!cancelled) setData(null) })
      .finally(() => { if (!cancelled) setLoading(false) })
    return () => { cancelled = true }
  }, [])

  const landing = data?.landing
  const departments = data?.departments ?? []

  return (
    <div className="nursing-departments">
      <section className="departments-hero">
        <div className="hero-overlay">
          <div className="container">
            <button onClick={onBack} className="back-btn">← Back</button>
            <h1>{landing?.hero_title ?? 'Our Departments'}</h1>
            <p>{landing?.hero_subtitle ?? 'Excellence in Specialized Nursing Education'}</p>
          </div>
        </div>
      </section>

      <section className="departments-content">
        <div className="dept-full-width">
          {loading ? (
            <p style={{ textAlign: 'center', padding: '2rem' }}>Loading departments…</p>
          ) : (
            <div className="departments-row">
              {departments.map((d) => (
                <button
                  key={d.slug}
                  className="dept-card"
                  onClick={() => onSelect(d.slug)}
                >
                  <div className="dept-card-icon">{d.icon}</div>
                  <h2 className="dept-card-title">{d.title}</h2>
                  <p className="dept-card-sub">{d.subtitle}</p>
                  <p className="dept-card-desc">{d.description}</p>
                  <ul className="dept-card-features">
                    {(d.features ?? []).map((f, i) => <li key={i}>{f}</li>)}
                  </ul>
                  <span className="dept-card-cta">Explore →</span>
                </button>
              ))}
            </div>
          )}
        </div>

        <div className="container">
          {(landing?.excellence?.length ?? 0) > 0 && (
            <div className="overview-section">
              <h2>Department Excellence</h2>
              <div className="excellence-grid">
                {landing!.excellence.map((e) => (
                  <div key={e.title} className="excellence-item">
                    <div className="excellence-icon">{e.icon}</div>
                    <h3>{e.title}</h3>
                    <p>{e.description}</p>
                  </div>
                ))}
              </div>
            </div>
          )}

          {(landing?.stats?.length ?? 0) > 0 && (
            <div className="stats-section">
              <h2>Department Impact</h2>
              <div className="stats-grid">
                {landing!.stats.map((s) => (
                  <div key={s.label} className="stat-item">
                    <div className="stat-number">{s.number}</div>
                    <div className="stat-label">{s.label}</div>
                    <div className="stat-desc">{s.description}</div>
                  </div>
                ))}
              </div>
            </div>
          )}

          {(landing?.programs?.length ?? 0) > 0 && (
            <div className="programs-section">
              <h2>Program Offerings</h2>
              <div className="programs-grid">
                {landing!.programs.map((program) => (
                  <div key={program.title} className="program-card">
                    <h3>{program.title}</h3>
                    <ul className="program-list">
                      {program.items.map((item) => <li key={item}>{item}</li>)}
                    </ul>
                    {program.footer && <p>{program.footer}</p>}
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

export default SchoolOfNursingDepartments
