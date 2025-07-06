@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('posts.index') }}" class="text-decoration-none">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Post Details</li>
                </ol>
            </nav>

            <!-- Post Card -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h1 class="h3 mb-2">{{ $post->title }}</h1>
                            <div class="d-flex align-items-center text-white-50">
                                <i class="fas fa-calendar me-2"></i>
                                <span>{{ $post->created_at->format('F d, Y') }}</span>
                                <i class="fas fa-clock ms-3 me-2"></i>
                                <span>{{ $post->created_at->format('g:i A') }}</span>
                                <i class="fas fa-user ms-3 me-2"></i>
                                <span>Author</span>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">
                                        <i class="fas fa-edit me-2"></i>Edit Post
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this post?')">
                                            <i class="fas fa-trash me-2"></i>Delete Post
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="post-content">
                        <p class="lead mb-4">{{ $post->body }}</p>
                    </div>

                    <!-- Post Metadata -->
                    <div class="row mt-4 pt-4 border-top">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Post ID</small>
                                    <strong>#{{ $post->id }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Last Updated</small>
                                    <strong>{{ $post->updated_at->diffForHumans() }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-comments me-2"></i>Comments
                        <span class="badge bg-primary ms-2" id="comment-count">{{ $post->allComments()->count() }}</span>
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Add Comment Form -->
                    <div class="mb-4">
                        <form id="comment-form" data-post-id="{{ $post->id }}">
                            @csrf
                            <div class="mb-3">
                                <label for="comment-content" class="form-label">Add a comment</label>
                                <textarea 
                                    class="form-control" 
                                    id="comment-content" 
                                    rows="3" 
                                    placeholder="Share your thoughts..."
                                    required
                                ></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Post Comment
                            </button>
                        </form>
                    </div>

                    <!-- Comments List -->
                    <div id="comments-container">
                        @foreach($post->comments()->with('allReplies')->get() as $comment)
                            @include('comments.comment-item', ['comment' => $comment, 'depth' => 0])
                        @endforeach
                    </div>

                    <!-- No Comments Message -->
                    @if($post->allComments()->count() === 0)
                        <div class="text-center py-4">
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">No comments yet</h6>
                            <p class="text-muted mb-0">Be the first to share your thoughts!</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Posts
                </a>
                <div class="btn-group">
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Post
                    </a>
                    <button type="button" class="btn btn-outline-primary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Print
                    </button>
                </div>
            </div>

            <!-- Related Posts Section (Placeholder for future) -->
            <div class="card mt-5">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-link me-2"></i>Related Posts
                    </h5>
                </div>
                <div class="card-body text-center py-4">
                    <i class="fas fa-lightbulb fa-2x text-muted mb-3"></i>
                    <h6 class="text-muted">Related posts feature coming soon!</h6>
                    <p class="text-muted mb-0">We're working on showing you related content based on this post.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reply to Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="reply-form">
                    @csrf
                    <input type="hidden" id="reply-parent-id">
                    <div class="mb-3">
                        <label for="reply-content" class="form-label">Your Reply</label>
                        <textarea 
                            class="form-control" 
                            id="reply-content" 
                            rows="3" 
                            placeholder="Write your reply..."
                            required
                        ></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitReply()">Post Reply</button>
            </div>
        </div>
    </div>
</div>

<script>
// Comment submission
document.getElementById('comment-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData();
    formData.append('content', document.getElementById('comment-content').value);
    formData.append('post_id', this.dataset.postId);
    formData.append('_token', '{{ csrf_token() }}');
    
    fetch('{{ route("comments.store") }}', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('comment-content').value = '';
            location.reload(); // Reload to show new comment
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while posting the comment.');
    });
});

// Reply functionality
function showReplyModal(commentId, depth) {
    if (depth >= {{ App\Models\Comment::getMaxDepth() }}) {
        alert('Maximum reply depth reached. Cannot add more replies.');
        return;
    }
    
    document.getElementById('reply-parent-id').value = commentId;
    document.getElementById('reply-content').value = '';
    new bootstrap.Modal(document.getElementById('replyModal')).show();
}

function submitReply() {
    const formData = new FormData();
    formData.append('content', document.getElementById('reply-content').value);
    formData.append('post_id', '{{ $post->id }}');
    formData.append('parent_comment_id', document.getElementById('reply-parent-id').value);
    formData.append('_token', '{{ csrf_token() }}');
    
    fetch('{{ route("comments.store") }}', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('replyModal')).hide();
            location.reload(); // Reload to show new reply
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while posting the reply.');
    });
}

// Delete comment
function deleteComment(commentId) {
    if (confirm('Are you sure you want to delete this comment?')) {
        fetch(`/comments/${commentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting comment.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the comment.');
        });
    }
}
</script>
@endsection