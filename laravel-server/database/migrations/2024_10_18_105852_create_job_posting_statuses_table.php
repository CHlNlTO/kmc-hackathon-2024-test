<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_posting_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Seed initial job posting statuses
        DB::table('job_posting_statuses')->insert([
            ['name' => 'Open'],
            ['name' => 'Closed'],
            ['name' => 'Draft'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('job_posting_statuses');
    }
};
