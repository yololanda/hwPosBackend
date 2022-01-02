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
            $table->string('name');
            $table->string('model');
            $table->bigInteger('price');
            $table->bigInteger('base_price');
            $table->bigInteger('discount_first');
            $table->bigInteger('discount_second');
            $table->integer('quantity_shop');
            $table->integer('quantity_warehouse');
            $table->integer('location_id');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->integer('supplier_id');
            $table->string('date_input');
            $table->bigInteger('sold');
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
