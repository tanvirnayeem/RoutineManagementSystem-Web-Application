<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('records', function (Blueprint $table) {
          $table->increments('id');
          $table->string('start_time');
          $table->string('end_time');
          $table->string('day');
          $table->string('status');
          $table->string('comment');
          $table->unsignedInteger('user_id');
          $table->unsignedInteger('room_id');
          $table->unsignedInteger('routine_id');
          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('room_id')->references('id')->on('rooms');
          $table->foreign('routine_id')->references('id')->on('routines');
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
