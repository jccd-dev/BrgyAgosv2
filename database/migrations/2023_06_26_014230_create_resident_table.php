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
        Schema::create('resident', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('suffix');
            $table->date('dob');
            $table->tinyInteger('age');
            $table->string('sex');
            $table->string('cstatus');
            $table->tinyInteger('zone');
            $table->string('bplace');
            $table->string('cpnumber')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('pwd')->default(0);
            $table->tinyInteger('senior')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resident');
    }
};
