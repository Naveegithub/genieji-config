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
       Schema::create('prospect_household', function (Blueprint $table) {
    $table->id();
    $table->foreignId('prospect_id')->constrained('prospect_personal')->cascadeOnDelete();
    $table->integer('household_size');
    $table->integer('male_count')->nullable();
    $table->integer('female_count')->nullable();
    $table->integer('infants')->nullable();
    $table->integer('children')->nullable();
    $table->integer('adults')->nullable();
    $table->integer('seniors')->nullable();
    $table->longText('auto_tags')->nullable();
    $table->enum('status', ['Active','Inactive','Deleted'])->default('Active');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospect_household');
    }
};
