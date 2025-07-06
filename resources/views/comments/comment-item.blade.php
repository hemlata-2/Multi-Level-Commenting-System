<div class="comment-item mb-3" data-comment-id="{{ $comment->id }}" data-depth="{{ $depth }}">
    <div class="d-flex">
        <!-- Indentation based on depth -->
        <div class="me-3" style="width: {{ $depth * 20 }}px;"></div>
        
        <!-- Comment content -->
        <div class="flex-grow-1">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <!-- Comment header -->
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $comment->created_at->diffForHumans() }}
                                </small>
                                @if($depth > 0)
                                    <small class="text-muted">
                                        <i class="fas fa-reply me-1"></i>
                                        Reply to comment #{{ $comment->parent_comment_id }}
                                    </small>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Comment actions -->
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <ul class="dropdown-menu">
                                @if($comment->canHaveReplies())
                                    <li>
                                        <button class="dropdown-item" onclick="showReplyModal({{ $comment->id }}, {{ $depth }})">
                                            <i class="fas fa-reply me-2"></i>Reply
                                        </button>
                                    </li>
                                @else
                                    <li>
                                        <span class="dropdown-item text-muted">
                                            <i class="fas fa-ban me-2"></i>Max depth reached
                                        </span>
                                    </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <button class="dropdown-item text-danger" onclick="deleteComment({{ $comment->id }})">
                                        <i class="fas fa-trash me-2"></i>Delete
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Comment content -->
                    <div class="comment-content">
                        <p class="mb-0">{{ $comment->content }}</p>
                    </div>
                    
                    <!-- Depth indicator -->
                    @if($depth > 0)
                        <div class="mt-2">
                            <small class="badge bg-info">
                                <i class="fas fa-layer-group me-1"></i>
                                Level {{ $depth }}
                            </small>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Reply button (if not at max depth) -->
            @if($comment->canHaveReplies())
                <div class="mt-2">
                    <button class="btn btn-sm btn-outline-primary" onclick="showReplyModal({{ $comment->id }}, {{ $depth }})">
                        <i class="fas fa-reply me-1"></i>Reply
                    </button>
                </div>
            @else
                <div class="mt-2">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Maximum reply depth reached ({{ App\Models\Comment::getMaxDepth() }} levels)
                    </small>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Recursive replies -->
    @if($comment->replies->count() > 0)
        <div class="replies-container mt-3">
            @foreach($comment->replies as $reply)
                @include('comments.comment-item', ['comment' => $reply, 'depth' => $depth + 1])
            @endforeach
        </div>
    @endif
</div> 