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
            $table->string('image')->nullable();
            $table->bigInteger('price');
            $table->bigInteger('discount_price')->nullable();
            $table->bigInteger('base_price');
            $table->integer('quantity_shop')->default('0');
            $table->integer('quantity_warehouse')->default('0');
            $table->integer('location_id');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->integer('supplier_id');
            $table->string('supplier_model')->default('OEM');
            $table->bigInteger('sold')->default('0');
            $table->string('tanggal_masuk');
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
