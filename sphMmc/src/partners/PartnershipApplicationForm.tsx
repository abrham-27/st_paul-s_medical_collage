import { useState, type FormEvent } from 'react'
import './PartnershipApplicationForm.css'

const API_BASE = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000/api'

const INSTITUTION_TYPES = [
  { value: '', label: 'Select type…' },
  { value: 'university', label: 'University / Academic' },
  { value: 'hospital', label: 'Hospital / Healthcare' },
  { value: 'ngo', label: 'NGO / Non-profit' },
  { value: 'government', label: 'Government Agency' },
  { value: 'industry', label: 'Industry / Private Sector' },
  { value: 'research', label: 'Research Institute' },
  { value: 'other', label: 'Other' },
]

interface Props {
  isOpen: boolean
  onClose: () => void
}

export default function PartnershipApplicationForm({ isOpen, onClose }: Props) {
  const [submitting, setSubmitting] = useState(false)
  const [success, setSuccess] = useState<string | null>(null)
  const [error, setError] = useState<string | null>(null)
  const [fieldErrors, setFieldErrors] = useState<Record<string, string[]>>({})

  const [form, setForm] = useState({
    institution_name: '',
    institution_type: '',
    country: '',
    city: '',
    website_url: '',
    contact_person_name: '',
    contact_email: '',
    contact_phone: '',
    contact_role: '',
    collaboration_interests: '',
    message: '',
  })

  const update = (field: string, value: string) => {
    setForm((prev) => ({ ...prev, [field]: value }))
    setFieldErrors((prev) => {
      const next = { ...prev }
      delete next[field]
      return next
    })
  }

  const handleSubmit = async (e: FormEvent) => {
    e.preventDefault()
    setSubmitting(true)
    setError(null)
    setFieldErrors({})

    try {
      const res = await fetch(`${API_BASE}/partnership-applications`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
        },
        body: JSON.stringify({
          ...form,
          institution_type: form.institution_type || null,
          city: form.city || null,
          website_url: form.website_url || null,
          contact_phone: form.contact_phone || null,
          contact_role: form.contact_role || null,
          collaboration_interests: form.collaboration_interests || null,
          message: form.message || null,
        }),
      })

      const data = await res.json()

      if (!res.ok) {
        if (res.status === 422 && data.errors) {
          setFieldErrors(data.errors)
          setError('Please correct the highlighted fields.')
        } else {
          setError(data.message || 'Submission failed. Please try again.')
        }
        return
      }

      setSuccess(data.message || 'Application submitted successfully.')
      setForm({
        institution_name: '',
        institution_type: '',
        country: '',
        city: '',
        website_url: '',
        contact_person_name: '',
        contact_email: '',
        contact_phone: '',
        contact_role: '',
        collaboration_interests: '',
        message: '',
      })
    } catch {
      setError('Unable to connect. Please check your connection and try again.')
    } finally {
      setSubmitting(false)
    }
  }

  const handleClose = () => {
    if (submitting) return
    setSuccess(null)
    setError(null)
    setFieldErrors({})
    onClose()
  }

  if (!isOpen) return null

  return (
    <div className="partner-app-overlay" role="dialog" aria-modal="true" aria-labelledby="partner-app-title">
      <div className="partner-app-backdrop" onClick={handleClose} aria-hidden="true" />
      <div className="partner-app-modal">
        <button type="button" className="partner-app-close" onClick={handleClose} aria-label="Close">
          ×
        </button>

        {success ? (
          <div className="partner-app-success">
            <h2 id="partner-app-title">Thank you</h2>
            <p>{success}</p>
            <p className="partner-app-success-note">
              Our partnership office will review your application and respond via the email you provided.
            </p>
            <button type="button" className="partner-app-submit" onClick={handleClose}>
              Close
            </button>
          </div>
        ) : (
          <>
            <h2 id="partner-app-title">Become a partner with SPHMMC</h2>
            <p className="partner-app-intro">
              Submit your institution&apos;s details below. Our team will review your request and get in touch.
            </p>

            {error && <div className="partner-app-error">{error}</div>}

            <form onSubmit={handleSubmit} className="partner-app-form" noValidate>
              <fieldset className="partner-app-fieldset">
                <legend>Institution</legend>
                <div className="partner-app-row">
                  <label>
                    Institution name <span className="required">*</span>
                    <input
                      type="text"
                      value={form.institution_name}
                      onChange={(e) => update('institution_name', e.target.value)}
                      required
                    />
                    {fieldErrors.institution_name && (
                      <span className="field-error">{fieldErrors.institution_name[0]}</span>
                    )}
                  </label>
                  <label>
                    Institution type
                    <select
                      value={form.institution_type}
                      onChange={(e) => update('institution_type', e.target.value)}
                    >
                      {INSTITUTION_TYPES.map((t) => (
                        <option key={t.value} value={t.value}>
                          {t.label}
                        </option>
                      ))}
                    </select>
                  </label>
                </div>
                <div className="partner-app-row">
                  <label>
                    Country <span className="required">*</span>
                    <input
                      type="text"
                      value={form.country}
                      onChange={(e) => update('country', e.target.value)}
                      required
                    />
                    {fieldErrors.country && <span className="field-error">{fieldErrors.country[0]}</span>}
                  </label>
                  <label>
                    City
                    <input type="text" value={form.city} onChange={(e) => update('city', e.target.value)} />
                  </label>
                </div>
                <label>
                  Website URL
                  <input
                    type="url"
                    placeholder="https://"
                    value={form.website_url}
                    onChange={(e) => update('website_url', e.target.value)}
                  />
                  {fieldErrors.website_url && (
                    <span className="field-error">{fieldErrors.website_url[0]}</span>
                  )}
                </label>
              </fieldset>

              <fieldset className="partner-app-fieldset">
                <legend>Contact person</legend>
                <div className="partner-app-row">
                  <label>
                    Full name <span className="required">*</span>
                    <input
                      type="text"
                      value={form.contact_person_name}
                      onChange={(e) => update('contact_person_name', e.target.value)}
                      required
                    />
                    {fieldErrors.contact_person_name && (
                      <span className="field-error">{fieldErrors.contact_person_name[0]}</span>
                    )}
                  </label>
                  <label>
                    Role / title
                    <input
                      type="text"
                      value={form.contact_role}
                      onChange={(e) => update('contact_role', e.target.value)}
                    />
                  </label>
                </div>
                <div className="partner-app-row">
                  <label>
                    Email <span className="required">*</span>
                    <input
                      type="email"
                      value={form.contact_email}
                      onChange={(e) => update('contact_email', e.target.value)}
                      required
                    />
                    {fieldErrors.contact_email && (
                      <span className="field-error">{fieldErrors.contact_email[0]}</span>
                    )}
                  </label>
                  <label>
                    Phone
                    <input
                      type="tel"
                      value={form.contact_phone}
                      onChange={(e) => update('contact_phone', e.target.value)}
                    />
                  </label>
                </div>
              </fieldset>

              <fieldset className="partner-app-fieldset">
                <legend>Partnership details</legend>
                <label>
                  Areas of collaboration interest
                  <textarea
                    rows={3}
                    placeholder="e.g. clinical training, research, student exchange…"
                    value={form.collaboration_interests}
                    onChange={(e) => update('collaboration_interests', e.target.value)}
                  />
                </label>
                <label>
                  Additional message
                  <textarea
                    rows={3}
                    value={form.message}
                    onChange={(e) => update('message', e.target.value)}
                  />
                </label>
              </fieldset>

              <div className="partner-app-actions">
                <button type="button" className="partner-app-cancel" onClick={handleClose} disabled={submitting}>
                  Cancel
                </button>
                <button type="submit" className="partner-app-submit" disabled={submitting}>
                  {submitting ? 'Submitting…' : 'Submit application'}
                </button>
              </div>
            </form>
          </>
        )}
      </div>
    </div>
  )
}
