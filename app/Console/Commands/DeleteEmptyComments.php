<?php

namespace App\Console\Commands;

use App\Models\Comment;
use Illuminate\Console\Command;

class DeleteEmptyComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comments:delete-empty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete comments with empty content fields';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to delete empty comments...');

        // Find comments with empty or null content
        $emptyComments = Comment::where(function ($query) {
            $query->whereNull('content')
                  ->orWhere('content', '')
                  ->orWhere('content', ' ');
        })->get();

        $count = $emptyComments->count();

        if ($count === 0) {
            $this->info('No empty comments found.');
            return 0;
        }

        $this->info("Found {$count} empty comment(s).");

        if ($this->confirm('Do you want to delete these empty comments?')) {
            $deletedCount = 0;

            foreach ($emptyComments as $comment) {
                try {
                    $comment->delete();
                    $deletedCount++;
                    $this->line("Deleted comment ID: {$comment->id}");
                } catch (\Exception $e) {
                    $this->error("Failed to delete comment ID {$comment->id}: " . $e->getMessage());
                }
            }

            $this->info("Successfully deleted {$deletedCount} empty comment(s).");
        } else {
            $this->info('Operation cancelled.');
        }

        return 0;
    }
}
