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
      Schema::create('prospect_preferences', function (Blueprint $table) {
    $table->id();

    $table->foreignId('prospect_id')
        ->constrained('prospect_personal')
        ->cascadeOnDelete();

    $table->enum('dietary_preference', [
        'Vegetarian','Eggetarian','Non-Vegetarian'
    ]);

    // Lifestyle flags
    $table->boolean('is_health_conscious')->default(false);
    $table->boolean('is_fitness_gym_going')->default(false);
    $table->boolean('is_kids_nutrition_focused')->default(false);
    $table->boolean('is_elderly_care_focused')->default(false);
    $table->boolean('is_weight_management')->default(false);

    // Religious / food preferences
    $table->boolean('pref_jain_food')->default(false);
    $table->boolean('pref_satvik_food')->default(false);
    $table->boolean('pref_no_onion_no_garlic')->default(false);


    $table->enum('value_sensitivity', [
        'Cost-conscious','Balanced','Quality-conscious'
    ])->nullable();

    $table->enum('status', ['Active','Inactive','Deleted'])->default('Active');
    $table->timestamps();

    $table->unique('prospect_id'); // one preference record per prospect
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospect_preferences');
    }
};
