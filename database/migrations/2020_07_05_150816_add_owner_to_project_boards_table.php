<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOwnerToProjectBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_boards', function (Blueprint $table) {
            $table->bigInteger('owner_id')->unsigned()->nullable();

            $table->foreign('owner_id')->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_boards', function (Blueprint $table) {
            $table->dropForeign('project_boards_owner_id_foreign');
            $table->dropColumn('owner_id');
        });
    }
}
