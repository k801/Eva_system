<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('main_sku');
            $table->string('variant_sku');
            $table->string('name');
            $table->string('name_ar');
            $table->string('description');
            $table->string('description_ar');
            $table->string('long_description_ar');
            $table->string('weight');
            $table->string('brand_id');
            $table->string('stock');
            $table->string('price');
            $table->string('active');
            $table->string('type');
            $table->string('affiliate_commission');
            $table->unsignedBigInteger('discount_id');
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
