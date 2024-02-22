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
            $table->string('attributes');
            $table->string('barcode');
            $table->string('brand');
            $table->string('categories');
            $table->string('color');
            $table->decimal('cost', 12, 4)->nullable();
            $table->string('description');
            $table->string('dimensions');
            $table->string('images');
            $table->string('locale');
            $table->string('name');
            $table->string('price');
            $table->string('quantity');
            $table->string('qr_code');
            $table->string('serial');
            $table->string('sku')->unique();
            $table->string('slug')->unique();
            $table->string('state');
            $table->string('status');
            $table->string('tags');
            $table->string('type');
            $table->string('unit_of_measure');
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
