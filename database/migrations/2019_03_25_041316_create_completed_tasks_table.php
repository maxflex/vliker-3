<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompletedTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('completed_tasks', function (Blueprint $table) {
            $table->unsignedInteger('task_id_from');
            $table->foreign('task_id_from')->references('id')->on('tasks')->onDelete('cascade');

            $table->unsignedInteger('task_id_to');
            $table->foreign('task_id_to')->references('id')->on('tasks')->onDelete('cascade');

            $table->primary(['task_id_from', 'task_id_to']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('completed_tasks');
    }
}
