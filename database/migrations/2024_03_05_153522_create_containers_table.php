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
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->unique()->nullable();
            $table->string('color')->nullable();
            $table->string('description')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('images')->nullable();
            $table->string('locale');
            $table->string('material')->nullable();
            $table->string('name');
            $table->unsignedInteger('parent');
            $table->string('qr_code')->unique()->nullable();
            $table->string('sku')->unique();
            $table->string('state');
            $table->string('tags')->nullable();
            $table->string('unit_of_measure')->nullable();
            $table->timestamps();

            $table->softDeletes();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('containers');
    }
};
