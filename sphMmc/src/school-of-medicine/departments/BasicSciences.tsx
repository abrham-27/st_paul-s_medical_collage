import { type JSX } from 'react';
import DepartmentDetail from './DepartmentDetail';

export default function BasicSciences({ onBack }: { onBack: () => void }): JSX.Element {
    return <DepartmentDetail slug="basic" onBack={onBack} />;
}
