<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('job_id')->unique();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('location')->nullable();
            $table->date('application_deadline')->nullable();
            $table->foreignId('job_type_id')->nullable()->constrained();
            $table->foreignId('work_model_id')->nullable()->constrained();
            $table->foreignId('shift_type_id')->nullable()->constrained();
            $table->foreignId('status_id')->nullable()->constrained('job_posting_statuses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
