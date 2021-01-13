<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecentlyViewedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recently_viewed_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id',false)->nullable();
            $table->unsignedBigInteger('session_key',false)->nullable();
            $table->unsignedBigInteger('product_id')->index();
            $table->foreign("product_id")->references("id")->on("products")->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('recently_viewed_products');
    }
}
