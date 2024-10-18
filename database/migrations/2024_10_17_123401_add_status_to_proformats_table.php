<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('proformat', function (Blueprint $table) {
            $table->string('status')->default('Pending'); // default status is "Pending"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('proformat', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
