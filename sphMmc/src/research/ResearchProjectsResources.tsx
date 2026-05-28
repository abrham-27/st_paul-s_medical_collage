import React from 'react';
import { sanitizeHtml } from '../utils/richText';

interface Resource {
  id: number;
  title: string;
  description?: string;
  file_path?: string;
  file_type?: string;
  file_size?: string;
  external_url?: string;
  download_count?: number;
}

interface ResourcesProps {
  title: string;
  subtitle?: string;
  resources: Resource[];
  icon?: string;
  backgroundColor?: 'white' | 'light' | 'navy';
}

const ResearchProjectsResources: React.FC<ResourcesProps> = ({
  title,
  subtitle,
  resources,
  icon = '📁',
  backgroundColor = 'light'
}) => {
  const sectionClass = `rp-section-modern rp-section-${backgroundColor}`;
  
  const getFileIcon = (fileType?: string): string => {
    const icons: { [key: string]: string } = {
      'pdf': '📄',
      'doc': '📝',
      'docx': '📝',
      'xls': '📊',
      'xlsx': '📊',
      'ppt': '📊',
      'pptx': '📊',
      'zip': '📦',
      'rar': '📦',
      'jpg': '🖼️',
      'jpeg': '🖼️',
      'png': '🖼️',
      'gif': '🖼️',
      'mp4': '🎥',
      'avi': '🎥',
      'mov': '🎥',
      'mp3': '🎵',
      'wav': '🎵',
    };
    
    return icons[fileType?.toLowerCase() || ''] || '📄';
  };
  
  const getFileUrl = (resource: Resource): string => {
    if (resource.external_url) {
      return resource.external_url;
    }
    
    if (resource.file_path) {
      const apiUrl = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000/api';
      const storageBase = apiUrl.replace(/\/+$/, '').replace(/\/api$/, '') + '/storage';
      const normalized = resource.file_path.replace(/^\/+/, '').replace(/^storage\/+/, '');
      return `${storageBase}/${normalized}`;
    }
    
    return '#';
  };
  
  const handleDownload = (resource: Resource) => {
    const url = getFileUrl(resource);
    if (url !== '#') {
      window.open(url, '_blank');
    }
  };
  
  return (
    <section className={sectionClass}>
      <div className="rp-container">
        <div className="rp-section-header">
          <span className="rp-section-icon">{icon}</span>
          <h2 className="rp-section-title">{title}</h2>
          {subtitle && (
            <p className="rp-section-subtitle">{subtitle}</p>
          )}
          <div className="rp-underline"></div>
        </div>
        
        {resources.length > 0 ? (
          <div className="rp-resources-grid">
            {resources.map((resource) => (
              <div key={resource.id} className="rp-resource-card">
                <div className="rp-resource-header">
                  <div className="rp-resource-icon">
                    {getFileIcon(resource.file_type)}
                  </div>
                  <h3 className="rp-resource-title">{resource.title}</h3>
                </div>
                
                {resource.description && (
                  <div 
                    className="rp-resource-description"
                    dangerouslySetInnerHTML={{ __html: sanitizeHtml(resource.description) }}
                  />
                )}
                
                <div className="rp-resource-meta">
                  <span>
                    {resource.file_type?.toUpperCase() || 'FILE'}
                    {resource.file_size && ` • ${resource.file_size}`}
                  </span>
                  {resource.download_count !== undefined && (
                    <span>📥 {resource.download_count} downloads</span>
                  )}
                </div>
                
                <button 
                  className="rp-resource-download"
                  onClick={() => handleDownload(resource)}
                  disabled={getFileUrl(resource) === '#'}
                >
                  <span>📥</span>
                  {resource.external_url ? 'Visit Link' : 'Download'}
                </button>
              </div>
            ))}
          </div>
        ) : (
          <div style={{ 
            textAlign: 'center', 
            padding: '3rem 2rem',
            color: backgroundColor === 'navy' ? '#bae6fd' : '#64748b'
          }}>
            <div style={{ fontSize: '3rem', marginBottom: '1rem' }}>📄</div>
            <p style={{ fontSize: '1.1rem', margin: 0 }}>
              Resources and documents will be available soon.
            </p>
          </div>
        )}
      </div>
    </section>
  );
};

export default ResearchProjectsResources;