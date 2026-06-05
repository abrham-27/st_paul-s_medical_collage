// API service for latest posts
const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000/api';
const POSTS_URL = `${API_BASE_URL}/latest-posts`;

export interface Leader {
  id: number;
  full_name: string;
  position: string;
  profile_image: string | null;
  profile_image_url: string | null;
  biography: string | null;
  qualification: string | null;
  display_order: number;
  status: 'active' | 'inactive';
}

export interface AboutPage {
  id: number;
  page_title: string | null;
  subtitle: string | null;
  main_description: string | null;
  history_text: string | null;
  featured_image: string | null;
  featured_image_url: string | null;
  additional_content: string | null;
  seo_title: string | null;
  seo_description: string | null;
}

export interface MissionVisionData {
  mission: { id: number; type: string; title: string; description: string };
  vision:  { id: number; type: string; title: string; description: string };
  values:  { id: number; title: string; description: string | null; icon: string | null; sort_order: number }[];
}

export interface HealthDisease {
  id: number;
  health_category_id: number;
  name: string;
  description: string | null;
  symptoms: string[];
  prevention: string[];
  advice: string[];
  sort_order: number;
}

export interface HealthCategory {
  id: number;
  name: string;
  description: string | null;
  icon: string | null;
  sort_order: number;
  diseases: HealthDisease[];
}

export interface GalleryItem {
  id: number;
  title: string | null;
  image: string;
  category: string | null;
  sort_order: number;
  created_at: string;
}

export interface AcademicStaffMember {
  id: number;
  school_type: string;
  full_name: string;
  slug: string;
  position: string;
  department: string | null;
  profile_image: string | null;
  biography: string | null;
  qualification: string | null;
  email: string | null;
  phone: string | null;
}

export interface AcademicProject {
  id: number;
  title: string;
  slug: string;
  image: string | null;
  excerpt: string | null;
  content: string | null;
  category: string | null;
  school_type: string | null;
  authors: string | null;
  attachment: string | null;
  external_link: string | null;
  created_at: string;
}

export interface AcademicPageData {
  id: number;
  school_type: string;
  page_type: string;
  title: string | null;
  content: string | null;
  secondary_title: string | null;
  secondary_content: string | null;
  tertiary_title: string | null;
  tertiary_content: string | null;
  featured_image: string | null;
}

export interface ResearchPublicationItem {
  id: number;
  slug: string;
  school_type: string;
  title: string;
  subtitle: string | null;
  abstract: string | null;
  authors: string | null;
  publication_type: string | null;
  publication_date: string | null;
  journal_name: string | null;
  doi_link: string | null;
  external_link: string | null;
  cover_image: string | null;
  pdf_file: string | null;
  keywords: string | null;
  featured: boolean;
  status: string;
  display_order: number;
  created_at: string;
  updated_at: string;
}

export interface SpecializedCenterData {
  id: number;
  name: string;
  description: string | null;
  details: string | null;
  icon: string | null;
  location: string | null;
  hours: string | null;
  contact: string | null;
  sort_order: number;
}

export interface LatestPost {
  id: number;
  title: string;
  slug: string;
  content: string | null;
  type: 'news' | 'announcement' | 'event' | 'document';
  featured_image: string | null;
  file_path: string | null;
  event_date: string | null;
  author: string | null;
  status: 'draft' | 'published';
  created_at: string;
  updated_at: string;
  formatted_event_date?: string;
  is_upcoming_event?: boolean;
}

export interface HomeHeroSlide {
  id: number;
  title: string;
  subtitle: string | null;
  description: string | null;
  image: string | null;
  image_url?: string | null;
  button_text: string | null;
  button_link: string | null;
  display_order: number;
  status: boolean;
  created_at: string;
  updated_at: string;
}

export interface PaginatedResponse<T> {
  success: boolean;
  data: {
    current_page: number;
    data: T[];
    first_page_url: string;
    last_page: number;
    per_page: number;
  };
}

// Medicine Department Interfaces
export interface MedicineDepartment {
  id: number;
  name: string;
  slug: string;
  description: string | null;
  icon: string | null;
  image: string | null;
  display_order: number;
  status: boolean;
}

export interface AcademicUnit {
  id: number;
  name: string;
  description: string | null;
  display_order: number;
  status: boolean;
}

export interface MedicineSubDepartment {
  id: number;
  name: string;
  slug: string;
  description: string | null;
  icon: string | null;
  image: string | null;
  display_order: number;
  status: boolean;
  academic_units?: AcademicUnit[];
}

export interface MedicineSubDepartmentDetail extends MedicineSubDepartment {
  academic_units: AcademicUnit[];
}

export interface MedicineDepartmentDetail extends MedicineDepartment {
  sub_departments: MedicineSubDepartment[];
}

export interface MedicinePartnershipListItem {
  id: number;
  title: string;
  slug: string;
  area: 'local' | 'international';
  area_label: string;
  featured_image: string | null;
  excerpt: string | null;
}

export interface NursingDepartmentListItem {
  id: number;
  slug: string;
  icon: string | null;
  title: string;
  subtitle: string | null;
  description: string | null;
  features: string[];
}

export interface NursingDepartmentLanding {
  hero_title: string | null;
  hero_subtitle: string | null;
  excellence: { icon: string; title: string; description: string }[];
  stats: { number: string; label: string; description: string }[];
  programs: { title: string; items: string[]; footer?: string }[];
}

export interface NursingDepartmentsIndex {
  landing: NursingDepartmentLanding;
  departments: NursingDepartmentListItem[];
}

export interface NursingDepartmentDetail extends NursingDepartmentListItem {
  page_title?: string;
  hero_tagline?: string | null;
  mission_text?: string | null;
  intro?: string | null;
  areas: { icon: string; title: string; description: string; features: string[] }[];
  training: { icon: string; title: string; description: string; features: string[] }[];
  careers: { icon: string; title: string; items: string[] }[];
  stats: { number: string; label: string; description: string }[];
}

export interface MedicinePartnershipDetail extends MedicinePartnershipListItem {
  content: string | null;
  display_order: number;
}

export type NursingPartnershipListItem = MedicinePartnershipListItem;
export type NursingPartnershipDetail = MedicinePartnershipDetail;
export type PublicHealthPartnershipListItem = MedicinePartnershipListItem;
export type PublicHealthPartnershipDetail = MedicinePartnershipDetail;

// Alumni Interfaces
export interface AlumniMember {
  id: number;
  name: string;
  graduation_year: number;
  degree: string;
  specialty: string;
  current_position: string | null;
  workplace: string | null;
  location: string | null;
  email: string;
  phone: string | null;
  image: string | null;
  achievements: string[] | null;
  awards: string[] | null;
  bio: string | null;
  linkedin: string | null;
  twitter: string | null;
  research_gate: string | null;
  publications: number;
  is_featured: boolean;
  is_active: boolean;
}

export interface AlumniEvent {
  id: number;
  title: string;
  date: string;
  location: string;
  type: string;
  description: string | null;
  attendees: string | null;
  is_active: boolean;
}

export interface AlumniStat {
  number: string;
  label: string;
  icon: string;
}

class ApiService {
  private async request<T>(url: string, options?: RequestInit): Promise<T> {
    try {
      const headers: Record<string, string> = {
        'Accept': 'application/json',
      };
      if (!(options?.body instanceof FormData)) {
        headers['Content-Type'] = 'application/json';
      }

      const response = await fetch(url, {
        headers: {
          ...headers,
          ...options?.headers,
        },
        ...options,
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      return await response.json();
    } catch (error) {
      console.error('API request failed:', error);
      throw error;
    }
  }

  // Get all latest posts with optional filtering
  async getLatestPosts(params?: {
    type?: string;
    published_only?: boolean;
    upcoming_events?: boolean;
    per_page?: number;
  }): Promise<PaginatedResponse<LatestPost>> {
    const searchParams = new URLSearchParams();
    
    if (params?.type) searchParams.append('type', params.type);
    if (params?.published_only !== undefined) searchParams.append('published_only', params.published_only.toString());
    if (params?.upcoming_events !== undefined) searchParams.append('upcoming_events', params.upcoming_events.toString());
    if (params?.per_page) searchParams.append('per_page', params.per_page.toString());

    const url = searchParams.toString() ? `${POSTS_URL}?${searchParams}` : POSTS_URL;
    return this.request<PaginatedResponse<LatestPost>>(url);
  }

  // Get posts by type
  async getPostsByType(type: string): Promise<PaginatedResponse<LatestPost>> {
    return this.request<PaginatedResponse<LatestPost>>(`${POSTS_URL}/type/${type}`);
  }

  // Get latest news (limited to 5)
  async getLatestNews(): Promise<{ success: boolean; data: LatestPost[] }> {
    return this.request<{ success: boolean; data: LatestPost[] }>(`${POSTS_URL}/latest-news`);
  }

  // Get latest announcements (limited to 5)
  async getLatestAnnouncements(): Promise<{ success: boolean; data: LatestPost[] }> {
    return this.request<{ success: boolean; data: LatestPost[] }>(`${POSTS_URL}/latest-announcements`);
  }

  // Get upcoming events
  async getUpcomingEvents(): Promise<PaginatedResponse<LatestPost>> {
    return this.request<PaginatedResponse<LatestPost>>(`${POSTS_URL}/upcoming-events`);
  }

  // Get past events
  async getPastEvents(): Promise<PaginatedResponse<LatestPost>> {
    return this.request<PaginatedResponse<LatestPost>>(`${POSTS_URL}/past-events`);
  }
  // Get home hero slides
  async getHomeHeroSlides(): Promise<{ success: boolean; data: HomeHeroSlide[] }> {
    return this.request<{ success: boolean; data: HomeHeroSlide[] }>(`${API_BASE_URL}/home-hero-slides`);
  }
  // Get single post by slug
  async getPost(slug: string): Promise<{ success: boolean; data: LatestPost }> {
    return this.request<{ success: boolean; data: LatestPost }>(`${POSTS_URL}/${slug}`);
  }

  // Create new post
  async createPost(postData: Partial<LatestPost>): Promise<{ success: boolean; data: LatestPost; message: string }> {
    return this.request<{ success: boolean; data: LatestPost; message: string }>(POSTS_URL, {
      method: 'POST',
      body: JSON.stringify(postData),
    });
  }

  // Update post
  async updatePost(slug: string, postData: Partial<LatestPost>): Promise<{ success: boolean; data: LatestPost; message: string }> {
    return this.request<{ success: boolean; data: LatestPost; message: string }>(`${POSTS_URL}/${slug}`, {
      method: 'PUT',
      body: JSON.stringify(postData),
    });
  }

  // Delete post
  async deletePost(slug: string): Promise<{ success: boolean; message: string }> {
    return this.request<{ success: boolean; message: string }>(`${POSTS_URL}/${slug}`, {
      method: 'DELETE',
    });
  }

  // ── About section ──────────────────────────────────────────────────────────

  async getAboutPage(): Promise<{ success: boolean; data: AboutPage }> {
    return this.request<{ success: boolean; data: AboutPage }>(`${API_BASE_URL}/about`);
  }

  async getLeaders(): Promise<{ success: boolean; data: Leader[] }> {
    return this.request<{ success: boolean; data: Leader[] }>(`${API_BASE_URL}/leaders`);
  }

  async getMissionVisionValues(): Promise<{ success: boolean; data: MissionVisionData }> {
    return this.request<{ success: boolean; data: MissionVisionData }>(`${API_BASE_URL}/mission-vision-values`);
  }

  async getHealthCategories(): Promise<{ success: boolean; data: HealthCategory[] }> {
    return this.request<{ success: boolean; data: HealthCategory[] }>(`${API_BASE_URL}/health-categories`);
  }

  async getSpecializedCenters(): Promise<{ success: boolean; data: SpecializedCenterData[] }> {
    return this.request<{ success: boolean; data: SpecializedCenterData[] }>(`${API_BASE_URL}/specialized-centers`);
  }

  async getGallery(): Promise<{ success: boolean; data: GalleryItem[] }> {
    return this.request<{ success: boolean; data: GalleryItem[] }>(`${API_BASE_URL}/gallery`);
  }

  async getAcademicStaffs(school: string, department?: string): Promise<{ success: boolean; data: AcademicStaffMember[] }> {
    const query = new URLSearchParams();
    if (department) query.append('department', department);

    const url = `${API_BASE_URL}/academic-staffs/${school}${query.toString() ? `?${query}` : ''}`;
    return this.request<{ success: boolean; data: AcademicStaffMember[] }>(url);
  }

  async getAcademicStaff(school: string, slug: string): Promise<{ success: boolean; data: AcademicStaffMember }> {
    return this.request<{ success: boolean; data: AcademicStaffMember }>(`${API_BASE_URL}/academic-staffs/${school}/${slug}`);
  }

  async getAcademicPage(school: string, page: string): Promise<{ success: boolean; data: AcademicPageData | null }> {
    return this.request<{ success: boolean; data: AcademicPageData | null }>(`${API_BASE_URL}/academic-pages/${school}/${page}`);
  }

  async getAcademicProjects(params?: { category?: string; school?: string; page?: number }): Promise<{ success: boolean; data: AcademicProject[]; meta: { current_page: number; last_page: number; total: number } }> {
    const q = new URLSearchParams();
    if (params?.category) q.append('category', params.category);
    if (params?.school) q.append('school', params.school);
    if (params?.page) q.append('page', String(params.page));
    const url = q.toString() ? `${API_BASE_URL}/academic-projects?${q}` : `${API_BASE_URL}/academic-projects`;
    return this.request(url);
  }

  async getAcademicProject(slug: string): Promise<{ success: boolean; data: AcademicProject }> {
    return this.request(`${API_BASE_URL}/academic-projects/${slug}`);
  }

  async getSchoolResearchPublications(school: string, page = 1): Promise<{ success: boolean; data: ResearchPublicationItem[]; meta: { current_page: number; last_page: number; per_page: number; total: number } }> {
    const response = await this.request<{ success: boolean; data: { data: ResearchPublicationItem[] } | ResearchPublicationItem[]; meta: { current_page: number; last_page: number; per_page: number; total: number } }>(`${API_BASE_URL}/academics/${school}/research-publications?page=${page}`);

    const data = Array.isArray(response.data) ? response.data : response.data.data ?? [];
    const meta = response.meta ?? {
      current_page: 1,
      last_page: 1,
      per_page: data.length,
      total: data.length,
    };

    return { success: response.success, data, meta };
  }

  async getSchoolResearchPublication(school: string, slug: string): Promise<{ success: boolean; data: ResearchPublicationItem }> {
    return this.request(`${API_BASE_URL}/academics/${school}/research-publications/${slug}`);
  }

  async getAcademicResearch(params?: { page?: number; school_type?: string; publication_type?: string; search?: string; per_page?: number }): Promise<{ success: boolean; data: ResearchPublicationItem[]; meta: { current_page: number; last_page: number; per_page: number; total: number; publication_types?: string[] } }> {
    const query = new URLSearchParams();

    if (params?.page) query.append('page', String(params.page));
    if (params?.school_type) query.append('school_type', params.school_type);
    if (params?.publication_type) query.append('publication_type', params.publication_type);
    if (params?.search) query.append('search', params.search);
    if (params?.per_page) query.append('per_page', String(params.per_page));

    const response = await this.request<{ success: boolean; data: { data: ResearchPublicationItem[] } | ResearchPublicationItem[]; meta: { current_page: number; last_page: number; per_page: number; total: number; publication_types?: string[] } }>(`${API_BASE_URL}/academics/academic-research${query.toString() ? `?${query.toString()}` : ''}`);

    const data = Array.isArray(response.data) ? response.data : response.data.data ?? [];
    const meta = response.meta ?? {
      current_page: 1,
      last_page: 1,
      per_page: data.length,
      total: data.length,
      publication_types: [],
    };

    return { success: response.success, data, meta };
  }

  async getAcademicResearchPublication(slug: string): Promise<{ success: boolean; data: ResearchPublicationItem }> {
    return this.request(`${API_BASE_URL}/academics/academic-research/${slug}`);
  }

  // ── Medicine Departments ──────────────────────────────────────────────────

  async getMedicineDepartments(): Promise<any> {
    return this.request<any>(`${API_BASE_URL}/medicine/departments`);
  }

  async getMedicineDepartment(slug: string): Promise<any> {
    return this.request<any>(`${API_BASE_URL}/medicine/departments/${slug}`);
  }

  async getMedicineSubDepartment(id: number): Promise<MedicineSubDepartmentDetail> {
    return this.request<MedicineSubDepartmentDetail>(`${API_BASE_URL}/medicine/sub-departments/${id}`);
  }

  async getMedicineSubDepartmentBySlug(slug: string): Promise<MedicineSubDepartmentDetail> {
    return this.request<MedicineSubDepartmentDetail>(`${API_BASE_URL}/medicine/sub-departments/slug/${slug}`);
  }

  async getMedicinePartnerships(): Promise<MedicinePartnershipListItem[]> {
    return this.request<MedicinePartnershipListItem[]>(`${API_BASE_URL}/medicine/partnerships`);
  }

  async getMedicinePartnership(slug: string): Promise<MedicinePartnershipDetail> {
    return this.request<MedicinePartnershipDetail>(`${API_BASE_URL}/medicine/partnerships/${slug}`);
  }

  async getMedicineAcademicUnits(subDepartmentId: number): Promise<AcademicUnit[]> {
    const response = await this.request<AcademicUnit[] | { data: AcademicUnit[] }>(
      `${API_BASE_URL}/medicine/sub-departments/${subDepartmentId}/academic-units`
    );
    if (Array.isArray(response)) return response;
    return response.data ?? [];
  }

  async getNursingPartnerships(): Promise<NursingPartnershipListItem[]> {
    return this.request<NursingPartnershipListItem[]>(`${API_BASE_URL}/nursing/partnerships`);
  }

  async getNursingPartnership(slug: string): Promise<NursingPartnershipDetail> {
    return this.request<NursingPartnershipDetail>(`${API_BASE_URL}/nursing/partnerships/${slug}`);
  }

  async getPublicHealthPartnerships(): Promise<PublicHealthPartnershipListItem[]> {
    return this.request<PublicHealthPartnershipListItem[]>(`${API_BASE_URL}/public-health/partnerships`);
  }

  async getPublicHealthPartnership(slug: string): Promise<PublicHealthPartnershipDetail> {
    return this.request<PublicHealthPartnershipDetail>(`${API_BASE_URL}/public-health/partnerships/${slug}`);
  }

  // ── Nursing Departments ─────────────────────────────────────────────────────

  async getNursingDepartments(): Promise<NursingDepartmentsIndex> {
    return this.request<NursingDepartmentsIndex>(`${API_BASE_URL}/nursing/departments`);
  }

  async getNursingDepartment(slug: string): Promise<NursingDepartmentDetail> {
    return this.request<NursingDepartmentDetail>(`${API_BASE_URL}/nursing/departments/${slug}`);
  }

  // ── Alumni Section ─────────────────────────────────────────────────────────

  async getAlumni(params?: {
    search?: string;
    specialty?: string;
    year?: string;
    featured?: boolean;
  }): Promise<{ success: boolean; data: AlumniMember[] }> {
    const query = new URLSearchParams();
    if (params?.search) query.append('search', params.search);
    if (params?.specialty && params.specialty !== 'all') query.append('specialty', params.specialty);
    if (params?.year && params.year !== 'all') query.append('year', params.year);
    if (params?.featured !== undefined) query.append('featured', String(params.featured));

    const url = query.toString() ? `${API_BASE_URL}/alumni?${query}` : `${API_BASE_URL}/alumni`;
    return this.request<{ success: boolean; data: AlumniMember[] }>(url);
  }

  async getAlumniStats(): Promise<{ success: boolean; data: AlumniStat[] }> {
    return this.request<{ success: boolean; data: AlumniStat[] }>(`${API_BASE_URL}/alumni/stats`);
  }

  async getAlumniEvents(): Promise<{ success: boolean; data: AlumniEvent[] }> {
    return this.request<{ success: boolean; data: AlumniEvent[] }>(`${API_BASE_URL}/alumni/events`);
  }

  async registerAlumnus(formData: FormData): Promise<{ success: boolean; message: string; data: AlumniMember }> {
    return this.request<{ success: boolean; message: string; data: AlumniMember }>(`${API_BASE_URL}/alumni/register`, {
      method: 'POST',
      body: formData,
      headers: {},
    });
  }
}

export const apiService = new ApiService();
