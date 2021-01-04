<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateBillingAddressesTable.
 */
class CreateBillingAddressesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('billing_addresses', function(Blueprint $table) {
			$table->id();
            $table->unsignedBigInteger('user_id',false);
            $table->string('name');    
            $table->string('country_id')->nullable();    
            $table->string('state_id')->nullable();    
            $table->string('city_id')->nullable();    
            $table->string('house_no')->nullable();    
            $table->string('street')->nullable();    
            $table->text('full_address');    
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
		Schema::drop('billing_addresses');
	}
}
