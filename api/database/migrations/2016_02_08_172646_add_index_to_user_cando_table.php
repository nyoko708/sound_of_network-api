<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToUserCandoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_cando', function (Blueprint $table) {
            $table->primary(['user_id', 'doit_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_cando', function (Blueprint $table) {
            $table->dropPrimary(['user_id', 'doit_id']);
        });
    }
}
