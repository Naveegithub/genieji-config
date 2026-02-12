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
   Schema::create('prospect_preferences_cuisine', function (Blueprint $table) {
    $table->id();

    $table->foreignId('prospect_preferences_id')
        ->constrained('prospect_preferences')
        ->cascadeOnDelete();

    $table->foreignId('cuisine_id')
        ->constrained('cuisines')
        ->cascadeOnDelete();

    // SHORT, EXPLICIT UNIQUE INDEX NAME
    $table->unique(
        ['prospect_preferences_id', 'cuisine_id'],
        'uniq_pref_cuisine'
    );
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospect_preferences_cuisine');
    }
};
