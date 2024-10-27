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
        Schema::create('preaching_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('territory_code');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('preached_by');
            $table->string('assigned_to')->nullable();
            $table->string('total_publishers')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preaching_sessions');
    }
};
