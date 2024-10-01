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
        Schema::create('space_stations', function (Blueprint $table) {
            $table->id();
            $table->string('spacestation_name')-> unique();
            $table->string('spacestation_location');
            $table->string('distance_from_earth');
            $table->string('time_at_space_station');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_stations');
    }
};
