<?php

namespace App\Http\Controllers;

use App\Models\LatestPost;
use App\Http\Requests\StoreLatestPostRequest;
use App\Http\Requests\UpdateLatestPostRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class LatestPostController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = LatestPost::query();

        if ($request->has('type')) {
            $query->byType($request->get('type'));
        }

        if ($request->get('published_only', true)) {
            $query->published();
        }

        if ($request->get('upcoming_events', false)) {
            $query->upcomingEvents();
        }

        $posts = $query->latestFirst()->paginate($request->get('per_page', 10));
        $posts = $this->attachFeaturedImageUrlToPaginator($posts);

        return response()->json([
            'success' => true,
            'data' => $posts,
        ]);
    }

    public function store(StoreLatestPostRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        $validated['status'] = $validated['status'] ?? 'published';

        $post = LatestPost::create($validated);
        $post = $this->attachFeaturedImageUrl($post);

        return response()->json([
            'success' => true,
            'message' => 'Latest post created successfully',
            'data' => $post,
        ], 201);
    }

    public function show(string $slug): JsonResponse
    {
        $post = LatestPost::where('slug', $slug)->firstOrFail();
        $post = $this->attachFeaturedImageUrl($post);

        return response()->json([
            'success' => true,
            'data' => $post,
        ]);
    }

    public function update(UpdateLatestPostRequest $request, string $slug): JsonResponse
    {
        $post = LatestPost::where('slug', $slug)->firstOrFail();

        $validated = $request->validated();

        if (isset($validated['title']) && $validated['title'] !== $post->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        }

        $post->update($validated);
        $post = $this->attachFeaturedImageUrl($post);

        return response()->json([
            'success' => true,
            'message' => 'Latest post updated successfully',
            'data' => $post,
        ]);
    }

    protected function attachFeaturedImageUrl(LatestPost $post): LatestPost
    {
        if ($post->featured_image && !str_starts_with($post->featured_image, 'http')) {
            $post->featured_image = asset('storage/' . $post->featured_image);
        }

        return $post;
    }

    protected function attachFeaturedImageUrlToPaginator($posts)
    {
        $posts->getCollection()->transform(function ($post) {
            return $this->attachFeaturedImageUrl($post);
        });

        return $posts;
    }

    public function destroy(string $slug): JsonResponse
    {
        $post = LatestPost::where('slug', $slug)->firstOrFail();
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Latest post deleted successfully',
        ]);
    }

    public function getByType(string $type): JsonResponse
    {
        if (!in_array($type, ['news', 'announcement', 'event', 'document'])) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid post type',
            ], 400);
        }

        $posts = LatestPost::byType($type)
            ->published()
            ->latestFirst()
            ->paginate(10);

        $posts = $this->attachFeaturedImageUrlToPaginator($posts);

        return response()->json([
            'success' => true,
            'data' => $posts,
        ]);
    }

    public function getUpcomingEvents(): JsonResponse
    {
        $events = LatestPost::upcomingEvents()
            ->published()
            ->paginate(10);

        $events = $this->attachFeaturedImageUrlToPaginator($events);

        return response()->json([
            'success' => true,
            'data' => $events,
        ]);
    }

    public function getPastEvents(): JsonResponse
    {
        $events = LatestPost::pastEvents()
            ->published()
            ->paginate(10);

        $events = $this->attachFeaturedImageUrlToPaginator($events);

        return response()->json([
            'success' => true,
            'data' => $events,
        ]);
    }

    public function getLatestNews(): JsonResponse
    {
        $news = LatestPost::byType('news')
            ->published()
            ->latestFirst()
            ->take(5)
            ->get()
            ->map(fn($post) => $this->attachFeaturedImageUrl($post));

        return response()->json([
            'success' => true,
            'data' => $news,
        ]);
    }

    public function getLatestAnnouncements(): JsonResponse
    {
        $announcements = LatestPost::byType('announcement')
            ->published()
            ->latestFirst()
            ->take(5)
            ->get()
            ->map(fn($post) => $this->attachFeaturedImageUrl($post));

        return response()->json([
            'success' => true,
            'data' => $announcements,
        ]);
    }
}
