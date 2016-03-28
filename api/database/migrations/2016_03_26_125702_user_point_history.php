<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserPointHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('user_point_history', function(Blueprint $table)
      {
        $table->integer('user_id');
        $table->integer('payments');
        $table->char('to', 20);
        $table->char('from', 20);
        $table->tinyInteger('point_kind_flag');
        $table->boolean('delete_flag')->default(0);
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('user_point_history');
    }
}
