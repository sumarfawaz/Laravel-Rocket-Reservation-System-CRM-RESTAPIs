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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            //Foreign Key to the Customers Table 
            $table->string('epassportid');
            $table->foreign('epassportid')->references('epassportid')->on('customers')->onDelete('cascade');
            //Foreign Key to the Schedulers Table
            $table->string('scheduler_name');
            $table->foreign('scheduler_name')->references('scheduler_name')->on('schedulers')->onDelete('cascade');
            //Total Price of the Ticket
            $table->integer('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
