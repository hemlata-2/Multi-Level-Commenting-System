<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'post_id',
        'parent_comment_id',
    ];

    protected $casts = [
        'depth' => 'integer',
    ];

    // Maximum depth allowed for comments
    const MAX_DEPTH = 3;

    /**
     * Get the post that owns the comment.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the parent comment.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    /**
     * Get the replies to this comment.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_comment_id')->orderBy('created_at', 'asc');
    }

    /**
     * Get all replies recursively.
     */
    public function allReplies(): HasMany
    {
        return $this->replies()->with('allReplies');
    }

    /**
     * Check if this comment can have replies (depth limit).
     */
    public function canHaveReplies(): bool
    {
        return $this->depth < self::MAX_DEPTH;
    }

    /**
     * Get the maximum depth allowed.
     */
    public static function getMaxDepth(): int
    {
        return self::MAX_DEPTH;
    }

    /**
     * Calculate depth for a new comment.
     */
    public static function calculateDepth(?int $parentCommentId): int
    {
        if (!$parentCommentId) {
            return 0;
        }
        $parentComment = self::find($parentCommentId);
        return $parentComment ? ($parentComment->depth + 1) : 0;
    }

    /**
     * Check if adding a reply would exceed the maximum depth.
     */
    public static function wouldExceedMaxDepth(?int $parentCommentId): bool
    {
        $newDepth = self::calculateDepth($parentCommentId);
        return $newDepth >= self::MAX_DEPTH;
    }

    /**
     * Boot method to automatically set depth when creating comments.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($comment) {
            $comment->depth = self::calculateDepth($comment->parent_comment_id);
        });
    }
}
