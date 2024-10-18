<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProformatTableMakeColumnsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proformat', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->nullable()->change();
            $table->decimal('shipping_cost', 8, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proformat', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->nullable(false)->change();
            $table->decimal('shipping_cost', 8, 2)->nullable(false)->change();
        });
    }
}