<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
  protected $fillable = [
      'lab','start_time', 'end_time', 'day', 'status', 'year', 'semester', 'dept', 'labassis_id', 'user_id', 'course_id', 'teacher_id', 'room_id',
  ];
}
