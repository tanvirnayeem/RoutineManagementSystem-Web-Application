<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::user()->role == "Student"){

        $batch = substr(Auth::user()->reg_no, 0, 4);

        $result = DB::table('routines')->where('year', $batch)->where('semester', '1')->first();

        if(!$result){
          return view('individualroutine')->with('param_batch', $batch)->with('param_semester', '2');
        }else{
          return view('individualroutine')->with('param_batch', $batch)->with('param_semester', '1');
        }



      }else if(Auth::user()->role == "CR"){

        $batch = substr(Auth::user()->reg_no, 0, 4);

        $result = DB::table('routines')->where('year', $batch)->where('semester', '1')->first();

        if(!$result){
          return view('individualroutine')->with('param_batch', $batch)->with('param_semester', '2');
        }else{
          return view('individualroutine')->with('param_batch', $batch)->with('param_semester', '1');
        }

      }else if(Auth::user()->role == "Teacher"){
        return view('home');
      }else{
        return view('individualroutine')->with('param_batch', '2012')->with('param_semester', '2');
      }

    }

    public function getclass($batch, $semester)
    {
      //return \Auth::user()->id;
        if(($batch == "All") && ($semester == "All")){
            return redirect('home');
        }else{
            return view('individualroutine')->with('param_batch', $batch)->with('param_semester', $semester);
        }

    }
}
