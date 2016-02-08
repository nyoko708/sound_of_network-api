<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('projects', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->integer('members_id');
        $table->text('description')->nullable();
        $table->smallInteger('access')->default(1);
        $table->text('goal_description');
        $table->integer('good_sum');
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
      Schema::drop('projects');
    }
}
