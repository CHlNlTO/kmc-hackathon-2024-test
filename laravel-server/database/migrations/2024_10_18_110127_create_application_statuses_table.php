<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('application_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Seed initial application statuses
        DB::table('application_statuses')->insert([
            ['name' => 'Submitted'],
            ['name' => 'Under Review'],
            ['name' => 'Interviewed'],
            ['name' => 'Offered'],
            ['name' => 'Rejected'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('application_statuses');
    }
};
