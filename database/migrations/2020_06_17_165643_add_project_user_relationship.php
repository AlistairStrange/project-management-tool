<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjectUserRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates pivot table for Many-to-Many relationship (ProjectBoard - User)
        Schema::create('project_board_user', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Foreign key to USERS tables
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Foreign key to ProjectBoards tables
            $table->unsignedBigInteger('project_board_id')->index();
            $table->foreign('project_board_id')->references('id')
                ->on('project_boards')
                ->onDelete('cascade');

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
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('project_board_id');
        });

        Schema::dropIfExists('project_boards_users');
    }
}
