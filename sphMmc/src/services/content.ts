const HTML_TAG_PATTERN = /<\/?[a-z][\s\S]*>/i;

export function containsHtml(content: string): boolean {
  return HTML_TAG_PATTERN.test(content);
}
