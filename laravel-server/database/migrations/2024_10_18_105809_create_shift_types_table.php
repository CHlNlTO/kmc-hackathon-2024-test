<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shift_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Seed initial shift types
        DB::table('shift_types')->insert([
            ['name' => 'Day shift'],
            ['name' => 'Night shift'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('shift_types');
    }
};
