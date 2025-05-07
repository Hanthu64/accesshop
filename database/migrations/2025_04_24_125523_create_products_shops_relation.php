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
        Schema::create('products_shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->constrained("products");
            $table->foreignId("shop_id")->constrained("shops");
            $table->double("rating")->nullable();
            $table->string("product_link")->nullable();
            $table->double("price")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_shops');
    }
};
