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
        Schema::create('role_cost', function (Blueprint $table) {
            $table->id();
            $table->string('cost_id');
            $table->string('role');
            $table->double('salary_per_day');
            $table->integer('qty');
            $table->integer('day');
            $table->double('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_cost');
    }
};
