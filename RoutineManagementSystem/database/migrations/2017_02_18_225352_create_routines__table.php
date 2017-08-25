<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('routines', function (Blueprint $table) {
          $table->increments('id');
          $table->boolean('lab');
          $table->string('start_time');
          $table->string('end_time');
          $table->string('day');
          $table->string('status');
          $table->string('year');
          $table->string('semester');
          $table->string('dept');
          $table->unsignedInteger('labassis_id');
          $table->unsignedInteger('user_id');
          $table->unsignedInteger('course_id');
          $table->unsignedInteger('teacher_id');
          $table->unsignedInteger('room_id');
          $table->foreign('room_id')->references('id')->on('rooms');
          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('course_id')->references('id')->on('courses');
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
        //
    }
}
