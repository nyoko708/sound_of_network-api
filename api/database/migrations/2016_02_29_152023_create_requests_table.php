<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('requests', function (Blueprint $table) {
        $table->increments('requests_id');
        $table->integer('from_user_id');
        $table->integer('to_user_id');
        $table->text('message');
        $table->smallInteger('read_status'); // 0:未読, 1:既読
        $table->smallInteger('response_status'); // 0:NG, 1:OK
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
      Schema::drop('requests');
    }
}
