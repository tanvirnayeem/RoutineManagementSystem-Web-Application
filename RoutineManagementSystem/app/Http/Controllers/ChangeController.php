<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Routine;
use App\Record;
use DB;

class ChangeController extends Controller
{
    //

    public function changeClass(Request $request)
    {

        $result = Routine::where('id', $request->id)
          ->update(['status' => 'changed']);

        if($result){
          $result = Record::where('routine_id', $request->id)
              ->update(['status' => 'done']);
        }


        return $result;
    }

    public function noChangeClass(Request $request)
    {
        $data = DB::table('records')
                  ->where('routine_id', $request->id)
                  ->where('status', 'pending')
                  ->first();
        
      
        $result = Routine::where('id', $request->id)
          ->update(['status' => 'regular']);
        $result = Routine::where('id', $request->id)
          ->update(['day' => $data->day]);
        $result = Routine::where('id', $request->id)
          ->update(['start_time' => $data->start_time]);
        $result = Routine::where('id', $request->id)
          ->update(['end_time' => $data->end_time]);
          
        
            $result = Record::where('routine_id', $request->id)
              ->delete();

        return $result;
    }
}
