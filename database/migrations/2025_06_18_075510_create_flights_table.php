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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('airline');
            $table->string('flight_number');
            $table->foreignId('origin_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('destination_id')->constrained('locations')->onDelete('cascade');
            $table->datetime('departure_time');
            $table->datetime('arrival_time');
            $table->decimal('base_price', 10, 2);
            $table->integer('seats_available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
