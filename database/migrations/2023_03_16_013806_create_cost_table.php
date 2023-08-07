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
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->double('sst');
            $table->double('factorRate');
            $table->double('totalcost');
            $table->double('role_sub');
            $table->double('service_sub');
            $table->double('event_sub');
            $table->double('hotel_sub');
            $table->double('trans_sub');
            $table->double('infras_sub');
            $table->double('market_sub');
            $table->string('profile');
            $table->string('size');
            $table->boolean('is_checked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costs');
    }
};
