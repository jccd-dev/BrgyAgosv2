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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('families_id');
            // $table->unsignedBigInteger('resident_id');
            $table->string('family_role');
            $table->foreignId('families_id')->constrained(
                table: 'families', indexName: 'members_family_id'
            )->onDelete('cascade');
            $table->foreignId('resident_id')->constrained(
                table: 'resident', indexName: 'members_resident_id'
            )->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
