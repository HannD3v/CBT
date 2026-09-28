<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_id')->constrained('challenges')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['menunggu', 'sedang dikerjakan', 'selesai'])->default('menunggu');
            $table->text('content_text');
            $table->text('ai_feedback')->nullable();
            $table->decimal('ai_assistance_score', 5, 2)->nullable();
            $table->integer('teacher_score')->nullable();
            $table->text('teacher_comment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};