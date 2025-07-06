<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('parent_comment_id')->nullable()->constrained('comments')->onDelete('cascade');
            $table->unsignedInteger('depth')->default(0);
            $table->timestamps();
            
            // Index for better performance
            $table->index(['post_id', 'parent_comment_id']);
            $table->index('depth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
