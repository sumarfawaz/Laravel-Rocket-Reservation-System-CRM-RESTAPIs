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
        Schema::create('rockets', function (Blueprint $table) {
            $table->id();
            $table->string('rocketname') -> unique();
            $table->decimal('height',8,2);
            $table->decimal('diameter',8,2);
            $table->integer('mass');
            $table->integer('payloadtoleo');
            $table->integer('payloadtogto');
            $table->integer('payloadtomars');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rockets');
    }
};
