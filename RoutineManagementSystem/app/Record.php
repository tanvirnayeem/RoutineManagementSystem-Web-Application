<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
  protected $fillable = [
      'start_time', 'end_time', 'day', 'status', 'user_id', 'room_id', 'routine_id',
  ];
}
