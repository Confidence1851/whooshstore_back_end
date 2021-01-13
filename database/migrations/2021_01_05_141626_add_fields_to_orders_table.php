<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'file')) $table->dropColumn("file");
            if (!Schema::hasColumn('orders', 'payment_id')) {
                $table->unsignedBigInteger('payment_id')->after("status");
                $table->foreign('payment_id')->references('id')->on('payments')->cascadeOnDelete();
            }
            if (!Schema::hasColumn('orders', 'history')) $table->text("history")->nullable()->after("status");
            if (!Schema::hasColumn('orders', 'billing_address_id')) {
                $table->unsignedBigInteger('billing_address_id')->after("status");
                $table->foreign('billing_address_id')->references('id')->on('billing_addresses');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
