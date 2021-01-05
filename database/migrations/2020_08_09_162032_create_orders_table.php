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
            $table->unsignedBigInteger('user_id',false);
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->string('reference')->unique();
            $table->decimal('amount');
            $table->decimal('discount')->default(0);
            $table->string('payment_type');
            $table->string('file')->nullable();
            $table->string('comment')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['Approved', 'Pending', 'Cancelled', 'Pprocessing', 'Completed'])->default('Pending');
            $table->timestamps();
            $table->softDeletes();
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
