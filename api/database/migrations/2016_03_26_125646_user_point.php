<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserPoint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('user_point', function(Blueprint $table)
      {
        $table->integer('user_id');
        $table->integer('point')->defalut(0);
        $table->integer('point')->defalut(0);
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
      Schema::drop('user_point');
    }
}
