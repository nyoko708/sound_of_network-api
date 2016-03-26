<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('user_area', function(Blueprint $table)
      {
        $table->integer('user_id');
        $table->integer('area_id');
        $table->timestamps();
        $table->boolean('delete_flag')->default(0);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('user_area');
    }
}
