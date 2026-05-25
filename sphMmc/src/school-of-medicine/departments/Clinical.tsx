import DepartmentDetail from './DepartmentDetail';

export default function Clinical({ onBack }: { onBack: () => void }) {
    return <DepartmentDetail slug="clinical" onBack={onBack} />;
}
