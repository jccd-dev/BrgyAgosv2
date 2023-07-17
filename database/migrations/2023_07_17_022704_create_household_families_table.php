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
        Schema::create('household_families', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('household_id');
            // $table->unsignedBigInteger('families_id');
            $table->foreignId('household_id')->constrained(
                table: 'household', indexName: 'household_fam_household_id'
            )->onDelete('cascade');
            $table->foreignId('families_id')->constrained(
                table: 'families', indexName: 'families_fam_families_id'
            )->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('household_families');
    }
};
