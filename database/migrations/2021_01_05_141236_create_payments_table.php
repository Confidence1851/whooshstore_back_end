<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('payer_email')->nullable();
            $table->string('currency')->nullable();
            $table->string('method');
            $table->text('reference');
            $table->decimal('amount');
            $table->decimal('fees')->default(0);
            $table->string('receipt')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->foreign('admin_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('payments');
    }
}
