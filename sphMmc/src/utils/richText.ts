export function getHtmlContent(value: string | null | undefined, fallback = ''): string {
  if (typeof value === 'string' && value.trim().length > 0) {
    return value;
  }

  return fallback;
}

export function stripHtml(value: string | null | undefined): string {
  if (!value) {
    return '';
  }

  const parsed = new DOMParser().parseFromString(value, 'text/html');
  return (parsed.body.textContent || '').replace(/\s+/g, ' ').trim();
}

export function toExcerpt(value: string | null | undefined, maxLength: number): string {
  const plainText = stripHtml(value);
  if (plainText.length <= maxLength) {
    return plainText;
  }

  return `${plainText.slice(0, maxLength)}…`;
}
