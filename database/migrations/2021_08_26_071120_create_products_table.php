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

            $table->string('name')->nullable();
            $table->text('detail')->nullable();
            $table->string('category')->nullable();
            $table->text('picturePath')->nullable();
            $table->string('product_unit')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('price_after_discount')->nullable();

            $table->softDeletes();
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
