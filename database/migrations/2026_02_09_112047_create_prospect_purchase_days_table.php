<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prospect_purchase_days', function (Blueprint $table) {
            $table->id();

            $table->foreignId('prospect_purchase_id')
                ->constrained('prospect_purchase')
                ->cascadeOnDelete();

            $table->tinyInteger('day');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prospect_purchase_days');
    }
};
