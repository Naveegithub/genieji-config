<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prospect_purchase', function (Blueprint $table) {
            $table->id();

            $table->foreignId('prospect_id')
                ->constrained('prospect_personal')
                ->cascadeOnDelete();

            $table->decimal('monthly_budget', 10, 2)->nullable();

            $table->enum('purchase_frequency', [
                'Once a month',
                'Once a week',
                'Several days a week',
                'Daily'
            ])->nullable();

            $table->enum('status', ['Active', 'Inactive', 'Deleted'])
                ->default('Active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prospect_purchase');
    }
};
