<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample post if none exists
        $post = Post::firstOrCreate([
            'title' => 'Sample Post for Testing Comments'
        ], [
            'body' => 'This is a sample post to test the multi-level commenting system. You can add comments and replies to see how the depth checking works.'
        ]);

        // Create top-level comments
        $comment1 = Comment::create([
            'content' => 'This is a great post! Thanks for sharing.',
            'post_id' => $post->id,
            'parent_comment_id' => null,
            'depth' => 0
        ]);

        $comment2 = Comment::create([
            'content' => 'I agree with the points made here.',
            'post_id' => $post->id,
            'parent_comment_id' => null,
            'depth' => 0
        ]);

        // Create replies to comment1 (level 1)
        $reply1 = Comment::create([
            'content' => 'I also think this is very informative.',
            'post_id' => $post->id,
            'parent_comment_id' => $comment1->id,
            'depth' => 1
        ]);

        $reply2 = Comment::create([
            'content' => 'Could you elaborate on this point?',
            'post_id' => $post->id,
            'parent_comment_id' => $comment1->id,
            'depth' => 1
        ]);

        // Create replies to reply1 (level 2)
        $reply3 = Comment::create([
            'content' => 'I would like to know more about this topic.',
            'post_id' => $post->id,
            'parent_comment_id' => $reply1->id,
            'depth' => 2
        ]);

        // Create replies to reply3 (level 3 - max depth)
        $reply4 = Comment::create([
            'content' => 'This is the maximum depth level. No more replies allowed.',
            'post_id' => $post->id,
            'parent_comment_id' => $reply3->id,
            'depth' => 3
        ]);

        // Create some empty comments for testing the cleanup command
        Comment::create([
            'content' => '',
            'post_id' => $post->id,
            'parent_comment_id' => null,
            'depth' => 0
        ]);

        Comment::create([
            'content' => '   ',
            'post_id' => $post->id,
            'parent_comment_id' => null,
            'depth' => 0
        ]);

        $this->command->info('Sample comments created successfully!');
        $this->command->info('Post ID: ' . $post->id);
        $this->command->info('Total comments created: ' . Comment::count());
    }
}
