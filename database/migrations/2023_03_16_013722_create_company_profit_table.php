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
        Schema::create('company_profit', function (Blueprint $table) {
            $table->id();
            $table->double('otherFactor')->default(20.0);
            $table->double('company_profit')->default(60.0);
            $table->double('factor_1')->default(0.0);
            $table->double('factor_2')->default(0.0);
            $table->double('factor_3')->default(50.0);
            $table->double('factor_4')->default(50.0);
            $table->double('factor_5')->default(50.0);
            $table->double('factor_6')->default(100.0);
            $table->double('factor_7')->default(100.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profit');
    }
};
