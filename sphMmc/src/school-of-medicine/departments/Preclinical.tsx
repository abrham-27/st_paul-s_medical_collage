import { type JSX } from 'react';
import DepartmentDetail from './DepartmentDetail';

export default function Preclinical({ onBack }: { onBack: () => void }): JSX.Element {
    return <DepartmentDetail slug="preclinical" onBack={onBack} />;
}
