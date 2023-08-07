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
        Schema::create('hotel_costs', function (Blueprint $table) {
            $table->id();
            $table->string('cost_id');
            $table->string('hotel');
            $table->integer('pax');
            $table->integer('night');
            $table->double('cost');
            $table->double('total');
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_costs');
    }
};
