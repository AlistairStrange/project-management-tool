<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjectRelationshipToTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Relationship to ProjectBoard
            $table->bigInteger('project_board_id')->unsigned()->nullable();
            $table->foreign('project_board_id')->references('id')
                ->on('project_boards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign('tickets_project_board_id_foreign');
            $table->dropColumn('project_board_id');
        });
    }
}
