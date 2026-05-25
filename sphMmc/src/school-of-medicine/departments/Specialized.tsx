import DepartmentDetail from './DepartmentDetail';

export default function Specialized({ onBack }: { onBack: () => void }) {
    return <DepartmentDetail slug="specialized" onBack={onBack} />;
}
