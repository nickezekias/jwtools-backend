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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('attributes')->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->string('brand')->nullable();
            $table->string('categories')->nullable();
            $table->string('color')->nullable();
            $table->string('container')->nullable();
            $table->decimal('cost', 12, 4)->nullable();
            $table->string('description')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('images')->nullable();
            $table->string('locale');
            $table->string('name');
            $table->decimal('price', 12, 4)->nullable();
            $table->unsignedSmallInteger('quantity');
            $table->string('qr_code')->unique()->nullable();
            $table->string('serial')->unique()->nullable();
            $table->string('sku')->unique();
            $table->string('slug')->unique();
            $table->string('state');
            $table->string('status');
            $table->string('tags')->nullable();
            $table->string('type')->nullable();
            $table->string('unit_of_measure')->nullable();
            $table->string('warehouse');
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
        Schema::dropIfExists('products');
    }
};
