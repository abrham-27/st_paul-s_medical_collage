import { type JSX } from 'react'
import NursingDepartmentDetail from './NursingDepartmentDetail'

interface OperativeTheatreProps {
  onBack: () => void
}

function OperativeTheatre({ onBack }: OperativeTheatreProps): JSX.Element {
  return <NursingDepartmentDetail slug="operative" onBack={onBack} />
}

export default OperativeTheatre
