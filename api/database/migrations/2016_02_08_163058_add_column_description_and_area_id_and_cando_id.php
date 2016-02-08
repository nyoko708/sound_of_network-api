<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDescriptionAndAreaIdAndCandoId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->text('description')->nullable()->after("password");
          $table->integer('area_id')->nullable()->after("description");
          $table->integer('cando_id')->nullable()->after("area_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->dropColumn('description');
           $table->dropColumn('area_id');
           $table->dropColumn('cando_id');
        });
    }
}
