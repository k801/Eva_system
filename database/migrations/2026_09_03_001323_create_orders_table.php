<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->unsignedBigInteger('shipping_method_id');
            $table->foreign('shipping_method_id')->references('id')->on('shippings')->onDelete('cascade');
            $table->string('order_name');
            $table->string('order_date');
            $table->integer('quantity');
            $table->string('price');
            $table->string('taxes');
            $table->string('discount');
            $table->string('shipping_date');
            $table->enum('order_tracking_status',array('delivered','canceled','pendding','created'))->default('pendding');
            $table->string('other_order_details');
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
        Schema::dropIfExists('orders');
    }
}
