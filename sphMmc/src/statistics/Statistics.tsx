import React, { useState, useEffect } from 'react';
import './Statistics.css';

interface Statistic {
  id: number;
  title: string;
  value: string;
  description: string;
}

const Statistics: React.FC = () => {
  const [statistics, setStatistics] = useState<Statistic[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    fetch('http://localhost:8000/api/statistics')
      .then(response => {
        if (!response.ok) {
          throw new Error(`Server returned ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        if (Array.isArray(data)) {
          setStatistics(data);
        } else {
          console.error("Fetched data is not an array:", data);
          setError('Invalid data format');
        }
      })
      .catch(err => {
        console.error("Failed to fetch statistics from backend:", err);
        setError(err.message);
      })
      .finally(() => {
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <div>Loading...</div>;
  }

  if (error) {
    return <div>Error: {error}</div>;
  }

  return (
    <div className="statistics-container">
      {statistics.map(stat => (
        <div key={stat.id} className="statistic-card">
          <h2>{stat.value}</h2>
          <h3>{stat.title}</h3>
          <p>{stat.description}</p>
        </div>
      ))}
    </div>
  );
};

export default Statistics;