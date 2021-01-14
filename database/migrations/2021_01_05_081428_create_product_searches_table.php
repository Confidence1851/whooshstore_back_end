<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProductSearchesTable.
 */
class CreateProductSearchesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_searches', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id',false)->nullable();
            $table->string('search_keywords');    
            $table->string('results_count')->nullable();    
            $table->text('query')->nullable();    
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
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
		Schema::drop('product_searches');
	}
}
