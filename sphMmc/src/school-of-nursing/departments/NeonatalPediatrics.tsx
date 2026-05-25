import { type JSX } from 'react'
import NursingDepartmentDetail from './NursingDepartmentDetail'

interface NeonatalPediatricsProps {
  onBack: () => void
}

function NeonatalPediatrics({ onBack }: NeonatalPediatricsProps): JSX.Element {
  return <NursingDepartmentDetail slug="neonatal" onBack={onBack} />
}

export default NeonatalPediatrics
