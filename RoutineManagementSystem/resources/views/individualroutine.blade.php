
<!DOCTYPE html>
<?php
$time = array('8','9','10','11','12','13','14','15','16','17');

//<button onclick="sendDiscard(this)" value="'.$row->id.'" style="float: right; margin-left: 5px; margin-right: 5px;">Discard</button>


$years = DB::table('routines')
          ->select('year')
          ->groupby('year')
          ->get();

$semesters = DB::table('routines')
          ->select('semester')
          ->groupby('semester')
          ->get();

$userid = Auth::user()->id;

function convertTime($time)
{
  if($time<12){
    return (string)$time.':00am';
  }else if($time>12){
    return (string)($time-12).':00pm';
  }else if($time==12){
    return (string)($time).':00pm';
  }
}


function getData($time, $day, $year, $sem) {

  $data = DB::table('routines')
            ->join('courses', 'routines.course_id', '=', 'courses.id')
            ->join('users', 'courses.t_id', '=', 'users.id')
			      ->join('rooms', 'routines.room_id', '=', 'rooms.id')
            ->select('rooms.room_no', 'users.name', 'routines.teacher_id', 'routines.status', 'courses.course_no', 'routines.room_id', 'routines.id', 'routines.start_time', 'routines.end_time', 'courses.title')
            ->where('start_time', $time)
            ->where('day', $day)
            ->where('year', $year)
            ->where('semester', $sem)
            ->first();

  if(empty($data)){
    $data = DB::table('routines')
              ->join('records', 'records.routine_id', '=', 'routines.id')
              ->join('courses', 'routines.course_id', '=', 'courses.id')
              ->join('users', 'courses.t_id', '=', 'users.id')
			         ->join('rooms', 'routines.room_id', '=', 'rooms.id')
              ->select('rooms.room_no', 'users.name', 'routines.teacher_id', 'courses.course_no', 'routines.room_id', 'routines.id', 'routines.start_time', 'routines.end_time', 'courses.title')
              ->where('records.start_time', $time)
              ->where('records.day', $day)
              ->where('routines.year', $year)
              ->where('routines.semester', $sem)
              ->where('records.status', 'pending')

              ->first();
  }

  return $data;
}


function getOccupiedRooms($time, $day) {

  $rooms = DB::table('routines')
            ->join('rooms', 'routines.room_id', '=', 'rooms.id')
            ->select('rooms.room_no', 'routines.start_time', 'routines.end_time')
            ->where('day', $day)
            ->get();

  $strRooms = "";
  if(!empty($rooms)){
    
       foreach($rooms as $room)
        {

            $dif = abs((int)$room->start_time - (int)$room->end_time);

           if((int)$room->start_time == (int)$time){
              $strRooms .= $room->room_no." ";
           }else if($dif>1){
              
              if((int)$room->start_time<(int)$time && (int)$room->end_time>$time){
              $strRooms .= $room->room_no." ";
           }
           }
        }
    
  }

  return $strRooms;
  

}

?>


<html lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Creating a School Timetable - jQuery EasyUI Demo</title>
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">

    <link href="  {{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert.js') }}" ></script>







    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
    <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Class Scheduling System') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/w3.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>
<body style="background:#E0E0E0">



  <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
          <div class="navbar-header">

              <!-- Collapsed Hamburger -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                  <span class="sr-only">Toggle Navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>

              <!-- Branding Image -->
              <a class="navbar-brand" href="{{ url('/') }}">
                  Class Scheduling System
              </a>
          </div>

          <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <!-- Left Side Of Navbar -->
              <ul class="nav navbar-nav">
                  &nbsp;
              </ul>

              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                  <!-- Authentication Links -->
                  @if (Auth::guest())
                      <li><a href="{{ route('login') }}">Login</a></li>
                      <li><a href="{{ route('register') }}">Register</a></li>
                  @else
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu" role="menu">
                              <li>
                                  <a href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                      Logout
                                  </a>

                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                  </form>
                              </li>
                          </ul>
                      </li>
                  @endif
              </ul>
          </div>
      </div>
  </nav>



<center>
  <?php
        if(Auth::user()->role == 'Teacher' || Auth::user()->role == 'Lab Assistant'){
              echo '<h2>Class Schedule</h2>';
              echo '<div class="demo-info" style="margin-bottom:10px">
                  <div class="demo-tip icon-tip">&nbsp;</div>
                  <h3>Click and drag a class to change its schedule</h3>
              </div>';
            }
        else{
            echo '<h2>Class Schedule</h2>';
        }
    ?>
      <div>
        <label>Batch
          <select id="batch">
            <?php

            if(Auth::user()->role == 'Teacher'){
              if($param_batch=="All"){
                echo "<option value=\"All\" selected>All</option>";
              }else
                 echo "<option value=\"All\">All</option>";
               foreach ($years as $batch) {
                   if($param_batch ==  $batch->year){
                     echo "<option value=\"".$batch->year."\" selected>".$batch->year."</option>";

                   }else
                     echo "<option value=\"".$batch->year."\">".$batch->year."</option>";

               }

            }else{
              if($param_batch=="All"){
                //echo "<option value=\"All\" selected>All</option>";
              }else
                 //echo "<option value=\"All\">All</option>";
               foreach ($years as $batch) {
                   if($param_batch ==  $batch->year){
                     echo "<option value=\"".$batch->year."\" selected>".$batch->year."</option>";

                   }else
                     echo "<option value=\"".$batch->year."\">".$batch->year."</option>";

               }
            }





             ?>
          </select>
        </lebel>
        <label>Semester
          <select id="semester">
            <?php

            if(Auth::user()->role == 'Teacher'){
              if($param_semester=="All"){
                echo "<option value=\"All\" selected>All</option>";
              }else
                 echo "<option value=\"All\">All</option>";
              foreach ($semesters as $semester) {
                if($param_semester == $semester->semester){
                  echo "<option value=\"".$semester->semester."\" selected>".$semester->semester."</option>";

                }else
                echo "<option value=\"".$semester->semester."\">".$semester->semester."</option>";
              }

            }else{

              if($param_semester=="All"){
                //echo "<option value=\"All\" selected>All</option>";
              }else
                 //echo "<option value=\"All\">All</option>";
              foreach ($semesters as $semester) {
                if($param_semester == $semester->semester){
                  echo "<option value=\"".$semester->semester."\" selected>".$semester->semester."</option>";

                }else
                echo "<option value=\"".$semester->semester."\">".$semester->semester."</option>";
              }
            }






            ?>
            </select>
          </lebel>
          <button onclick="getRoutines()">Go</button>
      </div>



    <div style="float:left; width: 80px; height:25px; background-color:#FFF59D;">Pending
    </div>  
    <div style="float:left; width: 80px; height:25px; background-color:#EF9A9A;">Requested
    </div>
    <div style="float:left; width: 80px; height:25px; background-color:#A5D6A7;">Changed
    </div>


<div style="width:100%; ">

    <div class="right">
        <table>
            <tr>
                <td id="00" data-id="00" class="blank"></td>
                <td id="01" data-id="01" class="title">8 AM</td>
                <td id="02" data-id="02" class="title">9 AM</td>
                <td id="03" data-id="03" class="title">10 AM</td>
                <td id="04" data-id="04" class="title">11 AM</td>
                <td id="05" data-id="05" class="title">12 PM</td>
                <td id="06" data-id="06" class="title">1  PM</td>
                <td id="07" data-id="07" class="title">2  PM</td>
                <td id="08" data-id="08" class="title">3  PM</td>
                <td id="09" data-id="09" class="title">4  PM</td>
                <td id="010" data-id="010" class="title">5  PM</td>
            </tr>
            <tr>
                <td id="10" data-id="10" class="time">Sunday</td>
                <?php
                $i = 0;
                while($i<10){
                  $dif = 0;
                  $data = getData($time[$i], 'Sunday', $param_batch, $param_semester);
                  if($i!=5){
                    if($data!=null){
                      $dif = abs($data->start_time - $data->end_time);

                      $words = explode(" ", $data->title);
                      $subjects = "";
                      foreach ($words as $value) {
                          $subjects .= substr($value, 0, 1);
                      }


                      /*
                      $k = 0;
                      foreach ($words as $value) {
                          if($k>=3){
                            break;
                          }else{
                            $subjects .= substr($value, 0, 1);
                            $k = $k + 1;
                          }
                      }
                      */

                      try{
                        if($data->status == 'pending'){
                          $row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Sunday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id." class=\"assignedpending\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                        }else {
                          if($data->teacher_id != $userid){
                              if($data->status == 'changed')
                                $row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Sunday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id." class=\"assignedDone\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                            else $row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Sunday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id." class=\"assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                          }else{

                            if($data->status == 'changed')
                                $row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Sunday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id." class=\"popup item assignedDone\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                            else $row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Sunday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id." class=\"popup item assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";

                          } 
                        }
                      }catch(Exception $ex){
                        $row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Sunday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id." class=\"assignedrequested\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }


                      $i = $i + $dif;
                    }
                    else{

                       $strRooms = getOccupiedRooms($time[$i], 'Sunday');

                      if($strRooms!="")
                        $row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$strRooms."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." class=\"drop\">".$strRooms." </br> Occupied</td>";
                      else{
                        $row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$strRooms."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." class=\"drop\"></td>";
                      }
                      $i = $i +1;
                    }
                    echo $row;
                  } else {
                    echo "<td id=\"1".($i+1)."\" data-dif=\"1\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." class=\"lunch\">Lunch</td>";
                    $i = $i +1;
                  }
                }
                ?>
            </tr>
            <tr>
              <td id="20" data-id="20" class="time">Monday</td>
              <?php
              $i = 0;

              while($i<10){
                  $dif = 0;
                $data = getData($time[$i], 'Monday', $param_batch, $param_semester);
                if($i!=5){
                  if($data!=null){
                    $dif = abs($data->start_time - $data->end_time);

                    $words = explode(" ", $data->title);
                    $subjects = "";
                    foreach ($words as $value) {
                        $subjects .= substr($value, 0, 1);
                    }

                    try{
                      if($data->status == 'pending'){
                        $row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Monday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id."  class=\"assignedpending\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }else{
                        if($data->teacher_id != $userid){
                          if($data->status == 'changed')
                          $row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Monday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedDone\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                            else $row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Monday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                        }else{
                          if($data->status == 'changed')
                          $row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Monday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"pop item assignedDone\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                            else $row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Monday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"item assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";

                        }
                      }
                    }catch(Exception $ex){
                      $row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Monday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id."  class=\"assignedrequested\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                    }


                    $i = $i + $dif;
                  }
                  else{
                    $strRooms = getOccupiedRooms($time[$i], 'Monday');
                      
                      if($strRooms!="")
                    $row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$strRooms."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." class=\"drop\">".$strRooms." </br> Occupied</td>";
                      else{
                    $row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$strRooms."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." class=\"drop\"></td>";
                      }

                    $i = $i +1;
                  }
                  echo $row;
                } else {
                  echo "<td id=\"2".($i+1)."\" data-dif=\"1\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." class=\"lunch\">Lunch</td>";
                  $i = $i +1;
                }
              }
              ?>
            </tr>
            <tr>
              <td id="30" data-id="30" class="time">Tuesday</td>
              <?php
              $i = 0;
              while($i<10){
                  $dif = 0;
                $data = getData($time[$i], 'Tuesday', $param_batch, $param_semester);
                if($i!=5){
                  if($data!=null){
                    $dif = abs($data->start_time - $data->end_time);

                    $words = explode(" ", $data->title);
                    $subjects = "";
                    foreach ($words as $value) {
                        $subjects .= substr($value, 0, 1);
                    }

                    try{
                      if($data->status == 'pending'){
                        $row = "<td id=\"3".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Tuesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedpending\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }else{
                        if($data->teacher_id != $userid){
                          if($data->status == 'changed')
                          $row = "<td id=\"3".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Tuesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedDone\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                            else $row = "<td id=\"3".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Tuesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                        }else{
                          if($data->status == 'changed')
                          $row = "<td id=\"3".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Tuesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"item assignedDone\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                            else $row = "<td id=\"3".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Tuesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"item assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";

                        }
                      }
                    }catch(Exception $ex){
                      $row = "<td id=\"3".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Tuesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedrequested\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";

                    }



                    $i = $i + $dif;
                  }
                  else{
                     $strRooms = getOccupiedRooms($time[$i], 'Tuesday');

                      if($strRooms!="")
                    $row = "<td id=\"3".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$strRooms."\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." class=\"drop\">".$strRooms." </br> Occupied</td>";
                      else{
                    $row = "<td id=\"3".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$strRooms."\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." class=\"drop\"></td>";
                      }

                    $i = $i +1;
                  }
                  echo $row;
                } else {
                  echo "<td id=\"3".($i+1)."\" data-dif=\"1\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." class=\"lunch\">Lunch</td>";
                  $i = $i +1;
                }
              }
              ?>
            </tr>
            <tr>
              <td id="40 data-id="40" class="time">Wednesday</td>
              <?php
              $i = 0;

              while($i<10){
                $dif = 0;
                $data = getData($time[$i], 'Wednesday', $param_batch, $param_semester);
                if($i!=5){
                  if($data!=null){
                    $dif = abs($data->start_time - $data->end_time);

                    $words = explode(" ", $data->title);
                    $subjects = "";
                    foreach ($words as $value) {
                        $subjects .= substr($value, 0, 1);
                    }

                    try{
                      if($data->status == 'pending'){
                        $row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Wednesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedpending\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }else{
                        if($data->teacher_id != $userid){
                          if($data->status == 'changed')
                          $row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Wednesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedDone\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                            else $row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Wednesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                        }else{
                          if($data->status == 'changed')
                          $row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Wednesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"item assignedDone\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                            else $row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Wednesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"item assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";

                        }
                      }
                    }catch(Exception $ex){
                      $row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Wednesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedrequested\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                    }

                    $i = $i + $dif;
                  }
                  else{
                   $strRooms = getOccupiedRooms($time[$i], 'Wednesday');


                      if($strRooms!="")
                    $row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$strRooms."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\"  data-time=".$time[$i]." class=\"drop\">".$strRooms." </br> Occupied</td>";
                      else{
                    $row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$strRooms."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\"  data-time=".$time[$i]." class=\"drop\"></td>";
                      }

                    $i = $i +1;
                  }
                  echo $row;
                } else {
                  echo "<td id=\"4".($i+1)."\" data-dif=\"1\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\" data-time=".$time[$i]." class=\"lunch\">Lunch</td>";
                  $i = $i +1;
                }
              }
              ?>
            </tr>
            <tr>
              <td id="50" data-id="50" class="time">Thrusday</td>
              <?php
              $i = 0;

              while($i<10){
                $dif = 0;
                $data = getData($time[$i], 'Thursday', $param_batch, $param_semester);
                if($i!=5){
                  if($data!=null){
                    $dif = abs($data->start_time - $data->end_time);

                    $words = explode(" ", $data->title);
                    $subjects = "";
                    foreach ($words as $value) {
                        $subjects .= substr($value, 0, 1);
                    }

                    try{
                      if($data->status == 'pending'){
                        $row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Thursday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedpending\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }else{
                        if($data->teacher_id != $userid){
                          if($data->status == 'changed')
                          $row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Thursday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedDone\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                            else $row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Thursday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                        }else{
                          if($data->status == 'changed')
                          $row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Thursday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"item assignedDone\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                            else $row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Thursday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"item assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";

                        }
                      }
                    }catch(Exception $ex){
                      $row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$data->room_no."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Thursday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedrequested\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                    }


                    $i = $i + $dif;
                  }
                  else{ 
                    $strRooms = getOccupiedRooms($time[$i], 'Thursday');

                      if($strRooms!="")
                    $row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$strRooms."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]."  class=\"drop\">".$strRooms." </br> Occupied</td>";
                      else{
                    $row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-room=\"".$strRooms."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]."  class=\"drop\"></td>";
                      }

                    $i = $i +1;
                  }
                  echo $row;
                } else {
                  echo "<td id=\"5".($i+1)."\" data-dif=\"1\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]." class=\"lunch\">Lunch</td>";
                  $i = $i +1;
                }
              }
              ?>
            </tr>
        </table>
    </div>
</div>
<div id="snackbar">You can not put that class there</div>
</center>

<?php

if(Auth::user()->role == 'admin'){

  $batch = $param_batch;

  $data = DB::table('routines')
            ->join('courses', 'routines.course_id', '=', 'courses.id')
            ->join('users', 'courses.t_id', '=', 'users.id')
            ->select('users.name', 'routines.day','routines.teacher_id', 'routines.status', 'courses.course_no', 'routines.room_id', 'routines.id', 'routines.start_time', 'routines.end_time', 'courses.title')
            ->where('status', 'pending')
            ->where('year', $batch)
            ->get();

  foreach ($data as $row) {


    $olddata = DB::table('records')
              ->where('status', 'pending')
              ->where('routine_id', $row->id)
              ->first();

    if(!empty($olddata)){
      $new_start_time = convertTime((int) $row->start_time);
      $new_end_time = convertTime((int) $row->end_time);
      $old_start_time = convertTime((int) $olddata->start_time);
      $old_end_time = convertTime((int) $olddata->end_time);
          echo '<div style="background:white">
            <ul class="w3-ul w3-card-4">
              <li class="w3-padding-16">
                <img src="http://localhost:8000/change.png" class="w3-left w3-circle w3-margin-right" style="width:50px">
                <span class="w3-large">'.$row->title.'</span><br>
                <span>Course No: '.$row->course_no.'</span><br>
                <span style="margin-left:67px">Previous Day: '.$olddata->day.'</span><br>
                <span style="margin-left:67px">Previous Time: '.$old_start_time.' to '.$old_end_time.'</span><br>
                <span style="margin-left:67px">New Day: '.$row->day.'</span><br>
                <span style="margin-left:67px">New Time: '.$new_start_time.' to '.$new_end_time.'</span>
                <button onclick="sendOkay(this)" value="'.$row->id.'" style="float: right; margin-left: 5px; margin-right: 5px;">Okay</button>
              </li>
            </ul>
          </div>';
    }
  }
}else if(Auth::user()->role == 'Teacher'){
  $batch = $param_batch;

  $data = DB::table('routines')
            ->join('courses', 'routines.course_id', '=', 'courses.id')
            ->join('users', 'courses.t_id', '=', 'users.id')
            ->select('users.name', 'routines.day','routines.teacher_id', 'routines.status', 'courses.course_no', 'routines.room_id', 'routines.id', 'routines.start_time', 'routines.end_time', 'courses.title')
            ->where('status', 'pending')
            ->where('teacher_id', Auth::user()->id)
            ->where('year', $batch)
            ->get();

  foreach ($data as $row) {


    $olddata = DB::table('records')
              ->where('status', 'pending')
              ->where('routine_id', $row->id)
              ->first();

    if(!empty($olddata)){
      $new_start_time = convertTime((int) $row->start_time);
      $new_end_time = convertTime((int) $row->end_time);
      $old_start_time = convertTime((int) $olddata->start_time);
      $old_end_time = convertTime((int) $olddata->end_time);
          echo '<div style="background:white">
            <ul class="w3-ul w3-card-4">
              <li class="w3-padding-16">
                <textarea disabled id="'.$row->id.'" rows="4" cols="50" name="comment" style="float: right; margin-left: 5px; margin-right: 5px;">'.$olddata->comment.'</textarea>


                <img src="http://localhost:8000/change.png" class="w3-left w3-circle w3-margin-right" style="width:50px">
                <span class="w3-large">'.$row->title.'</span><br>
                <span>Course No: '.$row->course_no.'</span><br>
                <span style="margin-left:67px">Previous Day: '.$olddata->day.'</span><br>
                <span style="margin-left:67px">Previous Time: '.$old_start_time.' to '.$old_end_time.'</span><br>
                <span style="margin-left:67px">New Day: '.$row->day.'</span><br>
                <span style="margin-left:67px">New Time: '.$new_start_time.' to '.$new_end_time.'</span>
                <button onclick="sendDiscard(this)" value="'.$row->id.'" style="float: right; margin-left: 5px; margin-right: 5px;">Discard</button>
              </li>
            </ul>
          </div>';
    }
  }
}else if(Auth::user()->role == 'CR'){
  $batch = substr(Auth::user()->reg_no, 0, 4);
  $data = DB::table('routines')
            ->join('courses', 'routines.course_id', '=', 'courses.id')
            ->join('users', 'courses.t_id', '=', 'users.id')
            ->select('users.name', 'routines.day','routines.teacher_id', 'routines.status', 'courses.course_no', 'routines.room_id', 'routines.id', 'routines.start_time', 'routines.end_time', 'courses.title')
            ->where('status', 'pending')
            ->where('year', $batch)
            ->get();
  foreach ($data as $row) {
    $olddata = DB::table('records')
              ->where('status', 'pending')
              ->where('routine_id', $row->id)
              ->first();

    if(!empty($olddata)){
      $new_start_time = convertTime((int) $row->start_time);
      $new_end_time = convertTime((int) $row->end_time);
      $old_start_time = convertTime((int) $olddata->start_time);
      $old_end_time = convertTime((int) $olddata->end_time);
          echo '<div style="background:white">
            <ul class="w3-ul w3-card-4">
              <li class="w3-padding-16">
                <textarea id="'.$row->id.'" rows="4" cols="50" name="comment" style="float: right; margin-left: 5px; margin-right: 5px;">'.$olddata->comment.'</textarea>

                <img src="change.png" class="w3-left w3-circle w3-margin-right" style="width:50px">
                <span class="w3-large">'.$row->title.'</span><br>
                <span>Course No: '.$row->course_no.'</span><br>
                <span style="margin-left:67px">Previous Day: '.$olddata->day.'</span><br>
                <span style="margin-left:67px">Previous Time: '.$old_start_time.' to '.$old_end_time.'</span><br>
                <span style="margin-left:67px">New Day: '.$row->day.'</span><br>
                <span style="margin-left:67px">New Time: '.$new_start_time.' to '.$new_end_time.'</span>
                <button onclick="onSubmit(this)" value="'.$row->id.'" style="float: right; margin-left: 5px; margin-right: 5px;">Submit</button>
              </li>
            </ul>
          </div>';
    }
  }
}
?>




<link rel="stylesheet" type="text/css" href="http://localhost:8000/css/individualroutine.css" />
<script type="text/javascript" src="http://localhost:8000/js/individualroutine.js"></script>

</body>
</html>
