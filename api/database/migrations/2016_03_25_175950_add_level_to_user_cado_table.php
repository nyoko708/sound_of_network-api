<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLevelToUserCadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_cando', function (Blueprint $table) {
          $table->smallInteger('level')->default(0)->after('doit_id'); // 技術レベル
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
        Schema::table('user_cando', function (Blueprint $table) {
            $table->dropColumn('level');
            $table->dropColumn('delete_flag');
        });
    }
}
