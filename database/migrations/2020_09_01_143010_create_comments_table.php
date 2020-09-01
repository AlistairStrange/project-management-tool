<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->longtext('content');

            // FOREIGN KEYS 
            // User-Comment Relationship
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            // Ticket-Comment Relationship
            $table->bigInteger('ticket_id')->unsigned()->nullable();
            $table->foreign('ticket_id')->references('id')->on('tickets');

            // Comment-Comment / reply self relationship
            $table->bigInteger('comment_parent_id')->unsigned()->nullable();
            $table->foreign('comment_parent_id')->references('id')->on('comments');

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
        Schema::table('comments', function (Blueprint $table){
            $table->dropForeign('comments_user_id_foreign');
            $table->dropForeign('comments_ticket_id_foreign');
            $table->dropForeign('comments_comment_parent_id_foreign');
        });

        Schema::dropIfExists('comments');
    }
}
