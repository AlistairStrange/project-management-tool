<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->longText('description');
            $table->enum('status', [
                'Open',
                'In Progress',
                'QA',
                'In Review',
                'Closed',
                'Rejected',
            ])->default('Open');
            $table->date('deadline');
            $table->string('contact'); // email address
            $table->string('reporter'); // email address
            $table->timestamps();

            // Relationships assignee
            $table->bigInteger('assignee_id')->unsigned()->nullable();
            $table->foreign('assignee_id')->references('id')
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
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign('tickets_assignee_id_foreign');
        });

        Schema::dropIfExists('tickets');
    }
}
