import { type JSX } from 'react'
import NursingDepartmentDetail from './NursingDepartmentDetail'

interface MedicalSurgicalProps {
  onBack: () => void
}

function MedicalSurgical({ onBack }: MedicalSurgicalProps): JSX.Element {
  return <NursingDepartmentDetail slug="medical" onBack={onBack} />
}

export default MedicalSurgical
