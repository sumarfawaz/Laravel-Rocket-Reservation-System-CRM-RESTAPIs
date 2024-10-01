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
        Schema::create('schedulers', function (Blueprint $table) {
            $table->id();
            $table->string('scheduler_name')->unique();
            // Add rocketname column to the schedulers table
            $table->string('rocketname');
            // Add spacestation_name column to the schedulers table
            $table->string('spacestation_name');
            // Define foreign key constraints
            $table->foreign('rocketname')->references('rocketname')->on('rockets')->onDelete('cascade');
            $table->foreign('spacestation_name')->references('spacestation_name')->on('space_stations')->onDelete('cascade');
            // Date and time of launch
            $table->dateTime('launch_date_time');
            // Price of the launch
            $table->integer('price');
            // Amount of passengers
            $table->integer('passengers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedulers');
    }
};
