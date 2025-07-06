@extends('layouts.app')
@section('content')
<div class="container">
    <!-- Stats Section -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-number">{{ App\Models\Post::count() }}</div>
                <div class="stats-label">Total Posts</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="stats-number">{{ App\Models\Post::where('created_at', '>=', now()->subDays(7))->count() }}</div>
                <div class="stats-label">Posts This Week</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="stats-number">{{ App\Models\Post::where('created_at', '>=', now()->subDays(30))->count() }}</div>
                <div class="stats-label">Posts This Month</div>
            </div>
        </div>
    </div>

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title">All Posts</h1>
            <p class="text-muted mb-0">Discover and engage with our community posts</p>
        </div>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Create New Post
        </a>
    </div>

    <!-- Posts List -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>Recent Posts
                </h5>
                <span class="badge bg-light text-dark">{{ $posts->total() }} posts</span>
            </div>
        </div>
        <div class="list-group list-group-flush">
            @forelse($posts as $post)
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                                <div>
                                    <a href="{{ route('posts.show', $post->id) }}" class="post-title d-block">
                                        {{ $post->title }}
                                    </a>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $post->created_at->format('M d, Y') }}
                                        <i class="fas fa-clock ms-3 me-1"></i>
                                        {{ $post->created_at->format('g:i A') }}
                                    </small>
                                </div>
                            </div>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                {{ Str::limit($post->body, 150) }}
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>View
                                </a>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="list-group-item text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-inbox fa-3x text-muted"></i>
                    </div>
                    <h5 class="text-muted">No posts yet</h5>
                    <p class="text-muted mb-3">Be the first to create a post and start the conversation!</p>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Create Your First Post
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    @if($posts->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection