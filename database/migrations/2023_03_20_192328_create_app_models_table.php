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
        Schema::create('productTable', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->string('product_price');
            $table->integer('product_quantity');
            $table->string('product_category');
            $table->string('product_status');
            $table->string('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productTable');
    }
};
