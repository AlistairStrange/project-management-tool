<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_items', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->boolean('completed')->default(false);

            // Foreign key / relationship
            $table->bigInteger('todo_id')->unsigned()->nullable();
            $table->foreign('todo_id')->references('id')->on('todos')->onDelete('cascade');

            $table->softDeletes();
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
        Schema::table('todo_items', function (Blueprint $table) {
            $table->dropForeign('todo_items_todo_id_foreign');
            $table->dropSoftDeletes();
        });

        Schema::dropIfExists('todo_items');
    }
}
