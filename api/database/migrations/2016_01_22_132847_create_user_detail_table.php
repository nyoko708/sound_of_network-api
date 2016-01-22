<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('user_detail', function (Blueprint $table) {
        $table->integer('user_id')->unique();
        $table->string('description');
        $table->integer('can_ids');
        $table->integer('actice_area_ids');
        $table->integer('pay_id');
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
      Schema::drop('user_detail');
    }
}
