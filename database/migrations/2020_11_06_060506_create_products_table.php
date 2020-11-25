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
            // $table->unsignedBigInteger('category_id')->index();
            // $table->integer('user_id')->unsignedBigInteger()->index();
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('slug')->unique();
            $table->integer('quantity');
            $table->double('price', 10, 2);
            $table->string('image');    
            $table->string('video')->nullable();
            $table->text('description');
            $table->text('details')->nullable()->default('text');
            $table->string('tags');
            $table->integer('percent_off')->nullable();
            $table->integer('weight')->nullable();
            $table->string('color')->nullable();
            $table->enum('size', ['XXS','XS','S','M','L','XL','XXL','XXXL'])->nullable();
            $table->enum('type',['New','Featured']);
            $table->enum('status', ['Inactive', 'Active']);
            // $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
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
