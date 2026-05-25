import { type JSX } from 'react'
import NursingDepartmentDetail from './NursingDepartmentDetail'

interface EmergencyCriticalCareProps {
  onBack: () => void
}

function EmergencyCriticalCare({ onBack }: EmergencyCriticalCareProps): JSX.Element {
  return <NursingDepartmentDetail slug="emergency" onBack={onBack} />
}

export default EmergencyCriticalCare
