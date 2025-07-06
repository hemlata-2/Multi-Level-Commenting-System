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
                    <li class="breadcrumb-item active" aria-current="page">Create Post</li>
                </ol>
            </nav>

            <!-- Create Post Card -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-plus text-primary"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">Create New Post</h4>
                            <small class="text-white-50">Share your thoughts with the community</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf
                        
                        <!-- Title Field -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">
                                <i class="fas fa-heading me-2"></i>Post Title
                            </label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                placeholder="Enter a compelling title for your post..."
                                value="{{ old('title') }}"
                                required
                            >
                            @error('title')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-lightbulb me-1"></i>Make it catchy and descriptive
                            </div>
                        </div>

                        <!-- Body Field -->
                        <div class="mb-4">
                            <label for="body" class="form-label fw-semibold">
                                <i class="fas fa-align-left me-2"></i>Post Content
                            </label>
                            <textarea 
                                name="body" 
                                id="body" 
                                class="form-control @error('body') is-invalid @enderror" 
                                rows="8" 
                                placeholder="Write your post content here... Share your thoughts, ideas, or questions with the community."
                                required
                            >{{ old('body') }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>Be clear and engaging in your content
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Cancel
                            </a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-primary" onclick="previewPost()">
                                    <i class="fas fa-eye me-2"></i>Preview
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Publish Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Writing Tips Card -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-lightbulb me-2 text-warning"></i>Writing Tips
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Keep your title clear and descriptive
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Write engaging content that adds value
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Use proper formatting and paragraphs
                        </li>
                        <li>
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Be respectful and constructive in your tone
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewPost() {
    const title = document.getElementById('title').value;
    const body = document.getElementById('body').value;
    
    if (!title || !body) {
        alert('Please fill in both title and content before previewing.');
        return;
    }
    
    // Create a preview modal
    const modal = document.createElement('div');
    modal.className = 'modal fade';
    modal.innerHTML = `
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Post Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h3>${title}</h3>
                    <hr>
                    <p>${body.replace(/\n/g, '<br>')}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    const modalInstance = new bootstrap.Modal(modal);
    modalInstance.show();
    
    modal.addEventListener('hidden.bs.modal', function() {
        document.body.removeChild(modal);
    });
}
</script>
@endsection