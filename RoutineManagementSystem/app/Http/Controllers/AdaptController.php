<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Routine;
use App\Record;
use DB;

class AdaptController extends Controller
{

    public function storeComments(Request $request)
    {

      $result = Record::where('routine_id', $request->id)
              ->update(['comment' => $request->comment]);

      return $result;
    }

    
    public function adaptrequest(Request $request)
    {
        $id = $request->id;
        $newday = $request->day;
        $newtime = $request->time;
        $batch = $request->batch;
        $semester = $request->semester;
        $dif = $request->dif;

        $oldday = $request->oldday;
        $oldtime = $request->oldtime;
        $teacher_id = $request->teacher_id;
        $room_id = $request->room_id;


        $data = DB::table('routines')
                  ->where('start_time', $newtime)
                  ->where('day', $newday)
                  ->where('year', $batch)
                  ->where('semester', $semester)
                  ->where('room_id', $room_id)
                  ->first();

        if(empty($data)){
          $Record = new Record;
          $Record->start_time = $oldtime;
          $Record->end_time = $oldtime + $dif;
          $Record->day = $oldday;
          $Record->status = 'pending';
          $Record->comment = '';
          $Record->user_id = (int)$teacher_id;
          $Record->room_id = $room_id;
          $Record->routine_id = $id;
          $Record->save();


          Routine::where('id', $id)
            ->update(['status' => 'pending']);

          Routine::where('id', $id)
            ->update(['day' => $newday]);

          Routine::where('id', $id)
            ->update(['start_time' => (int)$newtime]);

          Routine::where('id', $id)
              ->update(['end_time' => (int)$newtime + (int)$dif]);
        }else {
            return "1";
        }

    }
}
