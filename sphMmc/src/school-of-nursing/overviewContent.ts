import type { AcademicPageData } from '../services/api';

export interface NursingTimelineItem {
  year: string;
  title: string;
  description: string;
}

export interface NursingOverviewContent {
  hero_subtitle: string | null;
  about_text: string | null;
  timeline: NursingTimelineItem[];
}

export function parseNursingOverviewContent(
  content: string | null | undefined
): NursingOverviewContent {
  const empty: NursingOverviewContent = {
    hero_subtitle: null,
    about_text: null,
    timeline: [],
  };

  if (!content?.trim()) return empty;

  try {
    const parsed = JSON.parse(content) as Partial<NursingOverviewContent>;
    if (parsed && typeof parsed === 'object') {
      return {
        hero_subtitle: parsed.hero_subtitle ?? null,
        about_text: parsed.about_text ?? null,
        timeline: Array.isArray(parsed.timeline) ? parsed.timeline : [],
      };
    }
  } catch {
    return { ...empty, about_text: content };
  }

  return empty;
}

export function getNursingOverviewContent(page: AcademicPageData | null): NursingOverviewContent {
  return parseNursingOverviewContent(page?.content);
}
