# API Endpoints Test

## Base URL: http://127.0.0.1:8000/api

## Available Endpoints:

### CRUD Operations:
1. **GET /api/latest-posts** - Get all latest posts (with pagination)
   - Query parameters:
     - `type` - Filter by type (news, announcement, event, document)
     - `published_only` - Show only published posts (default: true)
     - `upcoming_events` - Show upcoming events only (default: false)
     - `per_page` - Items per page (default: 10)

2. **POST /api/latest-posts** - Create a new latest post
   - Required fields: title, type
   - Optional fields: content, featured_image, file_path, event_date (required if type=event), author, status

3. **GET /api/latest-posts/{slug}** - Get a specific latest post

4. **PUT/PATCH /api/latest-posts/{slug}** - Update a latest post

5. **DELETE /api/latest-posts/{slug}** - Delete a latest post

### Special Endpoints:
6. **GET /api/latest-posts/type/{type}** - Get posts by specific type

7. **GET /api/latest-posts/upcoming-events** - Get upcoming events

8. **GET /api/latest-posts/latest-news** - Get latest 5 news posts

9. **GET /api/latest-posts/latest-announcements** - Get latest 5 announcements

## Test Commands:

```bash
# Test getting all posts
curl -X GET "http://127.0.0.1:8000/api/latest-posts"

# Test getting latest news
curl -X GET "http://127.0.0.1:8000/api/latest-posts/latest-news"

# Test getting latest announcements
curl -X GET "http://127.0.0.1:8000/api/latest-posts/latest-announcements"

# Test getting upcoming events
curl -X GET "http://127.0.0.1:8000/api/latest-posts/upcoming-events"

# Test getting posts by type
curl -X GET "http://127.0.0.1:8000/api/latest-posts/type/news"

# Test creating a news post
curl -X POST "http://127.0.0.1:8000/api/latest-posts" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Test News Article",
    "content": "This is a test news article content.",
    "type": "news",
    "author": "Test Author"
  }'

# Test creating an event
curl -X POST "http://127.0.0.1:8000/api/latest-posts" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Test Event",
    "content": "This is a test event description.",
    "type": "event",
    "event_date": "2026-12-25T10:00:00",
    "author": "Event Organizer"
  }'
```

## Notes:
- The API is fully functional but requires a database connection to store/retrieve actual data
- All endpoints return JSON responses with consistent structure
- Validation is in place for all input fields
- Slug-based routing is used for better SEO-friendly URLs
