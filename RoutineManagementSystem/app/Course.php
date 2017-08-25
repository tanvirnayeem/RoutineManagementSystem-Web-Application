<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  protected $fillable = [
      'course_no','title','credit','num_of_students','t_id', 'created_at', 'updated_at',
  ];
}
