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
        Schema::create('prospect_personal', function (Blueprint $table) {
            $table->id();

            // Prospect identity
            $table->string('name');
            $table->string('mobile', 10);

            // Salesperson / system user who captured this prospect
            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Address details
            $table->string('flat_no', 50)->nullable();
            $table->string('floor', 50)->nullable();
            $table->string('block_street')->nullable();

            // Auto-captured metadata
            $table->string('gps_location')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Business logic
            $table->string('remarks')->nullable();
            $table->integer('version')->default(1);
            $table->enum('status', ['Active','Inactive','Deleted'])->default('Active');

            // Community reference
            $table->foreignId('community_id')
                ->nullable()
                ->constrained('communities')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospect_personal');
    }
};
