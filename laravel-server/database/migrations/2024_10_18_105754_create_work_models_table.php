<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_models', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Seed initial work models
        DB::table('work_models')->insert([
            ['name' => 'On-site'],
            ['name' => 'Hybrid'],
            ['name' => 'Remote'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('work_models');
    }
};
