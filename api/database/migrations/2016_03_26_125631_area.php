<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Area extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('area', function(Blueprint $table)
      {
        $table->increments('id');
        $table->char('area_name', 50);
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
      Schema::drop('area');
    }
}
