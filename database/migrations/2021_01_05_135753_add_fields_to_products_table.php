<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'today_deal')) $table->enum('today_deal', ['Inactive', 'Active'])->default("Inactive")->after("type");
            if (!Schema::hasColumn('products', 'sales_count')) $table->string('sales_count')->default(0)->after("type");
            if (!Schema::hasColumn('products', 'star_rating')) $table->decimal('star_rating')->default(0.0)->after("type");
            if (!Schema::hasColumn('products', 'deleted_at')) $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
