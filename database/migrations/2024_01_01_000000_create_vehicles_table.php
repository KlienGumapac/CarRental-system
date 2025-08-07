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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('car_id', 10)->unique();
            $table->string('license_plate', 20)->unique();
            $table->string('make', 50);
            $table->string('model', 50);
            $table->integer('year');
            $table->string('color', 30);
            $table->string('car_type', 30);
            $table->string('transmission', 20);
            $table->string('fuel_type', 20);
            $table->decimal('daily_rate', 10, 2);
            $table->string('availability', 20);
            $table->integer('mileage');
            $table->integer('seating_capacity');
            $table->string('insurance', 50);
            $table->date('last_service');
            $table->string('condition', 30);
            $table->json('images')->nullable(); // Store image paths as JSON array
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
