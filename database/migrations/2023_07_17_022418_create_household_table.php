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
        Schema::create('household', function (Blueprint $table) {
            $table->id();
            $table->string('family_head');
            $table->string('h_structure');
            $table->string('water_source');
            $table->string('electricity');
            $table->string('comfort_room');
            $table->string('waste_management');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('household');
    }
};
