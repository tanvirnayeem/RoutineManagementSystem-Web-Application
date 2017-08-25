
<!DOCTYPE html>
<?php
$time = array('8','9','10','11','12','13','14','15','16','17');

$years = DB::table('routines')
          ->select('year')
          ->groupby('year')
          ->get();

$semesters = DB::table('routines')
          ->select('semester')
          ->groupby('semester')
          ->get();

$userid = Auth::user()->id;

function getData($time, $day) {

  $userid = Auth::user()->id;

  $data = DB::table('routines')
            ->join('courses', 'routines.course_id', '=', 'courses.id')
            ->join('users', 'courses.t_id', '=', 'users.id')
			->join('rooms', 'routines.room_id', '=', 'rooms.id')
            ->select('rooms.room_no','users.name', 'routines.teacher_id', 'routines.status', 'routines.room_id', 'routines.id', 'routines.start_time', 'routines.end_time', 'courses.title', 'courses.course_no')
            ->where('start_time', $time)
            ->where('day', $day)
            ->where('teacher_id', $userid)
            ->first();

  if(empty($data)){
    $data = DB::table('routines')
              ->join('records', 'records.routine_id', '=', 'routines.id')
              ->join('courses', 'routines.course_id', '=', 'courses.id')
              ->join('users', 'courses.t_id', '=', 'users.id')
			  ->join('rooms', 'routines.room_id', '=', 'rooms.id')
              ->select('rooms.room_no','users.name', 'routines.teacher_id', 'routines.room_id', 'routines.id', 'routines.start_time', 'routines.end_time', 'courses.title', 'courses.course_no')
              ->where('records.start_time', $time)
              ->where('records.day', $day)
              ->where('records.status', 'pending')
              ->where('teacher_id', $userid)
              ->first();
  }

  return $data;
}
?>


<html lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Creating a School Timetable - jQuery EasyUI Demo</title>
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
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

    <title>Class Scheduling System</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


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
        if(Auth::user()->role == 'Teacher' || Auth::user()->role == 'Lab Assistant')
              echo '<h2>Class Schedule</h2>';
        else{
            echo '<h2>Schedule</h2>';
        }
    ?>
      <div>
        <label>Batch
          <select id="batch">
            <?php
              echo "<option value=\"All\">All</option>";
              foreach ($years as $batch) {
                  echo "<option value=\"".$batch->year."\">".$batch->year."</option>";
              }
             ?>
          </select>
        </lebel>
        <label>Semester
          <select id="semester">
            <?php
            echo "<option value=\"All\">All</option>";
            foreach ($semesters as $semester) {
                echo "<option value=\"".$semester->semester."\">".$semester->semester."</option>";
            }
            ?>
            </select>
          </lebel>
          <button onclick="getRoutines()">Go</button>
      </div>


  <div class="demo-info" style="margin-bottom:10px">
      <div class="demo-tip icon-tip">&nbsp;</div>
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
                  $data = getData($time[$i], 'Sunday');
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
                          $row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Sunday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id." class=\"assignedpending\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                        }else {
                          if($data->teacher_id != $userid)
                            $row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Sunday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id." class=\"assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                          else
                            $row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Sunday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id." class=\"popup item assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                        }
                      }catch(Exception $ex){
                        $row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Sunday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id." class=\"assignedrequested\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }
                      //$row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." colspan = ".$dif."><div data-id=".$data->id." class=\"item assigned\"><p>".$data->course_no."</br>".$subjects."</br>Room - ".$data->room_id."</p></div></td>";


                      $i = $i + $dif;
                    }
                    else{
                      $row = "<td id=\"1".($i+1)."\" data-dif=\"".$dif."\" data-id=\"1".($i+1)."\" data-day=\"Sunday\" data-time=".$time[$i]." class=\"drop\"></td>";
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
                $data = getData($time[$i], 'Monday');
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
                        $row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Monday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id."  class=\"assignedpending\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }else{
                        if($data->teacher_id != $userid)
                          $row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Monday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                        else
                          $row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Monday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"item assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }
                    }catch(Exception $ex){
                      $row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Monday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id." data-dif=".$dif." data-id=".$data->id."  class=\"assignedrequested\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                    }

                    //$row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." colspan = ".$dif."><div data-id=".$data->id." class=\"item assigned\"><p>".$data->course_no."</br>".$subjects."</br>Room - ".$data->room_id."</p></div></td>";
                    $i = $i + $dif;
                  }
                  else{
                    $row = "<td id=\"2".($i+1)."\" data-dif=\"".$dif."\" data-id=\"2".($i+1)."\" data-day=\"Monday\" data-time=".$time[$i]." class=\"drop\"></td>";
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
                $data = getData($time[$i], 'Tuesday');
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
                        $row = "<td id=\"3".($i+1)."\" data-dif=\"".$dif."\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Tuesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedpending\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }else{
                        if($data->teacher_id != $userid)
                          $row = "<td id=\"3".($i+1)."\" data-dif=\"".$dif."\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Tuesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                        else
                          $row = "<td id=\"3".($i+1)."\" data-dif=\"".$dif."\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Tuesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"item assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }
                    }catch(Exception $ex){
                      $row = "<td id=\"3".($i+1)."\" data-dif=\"".$dif."\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Tuesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedrequested\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";

                    }

                    $i = $i + $dif;
                  }
                  else{
                    $row = "<td id=\"3".($i+1)."\" data-dif=\"".$dif."\" data-id=\"3".($i+1)."\" data-day=\"Tuesday\" data-time=".$time[$i]." class=\"drop\"></td>";
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
                $data = getData($time[$i], 'Wednesday');
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
                        $row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Wednesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedpending\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }else{
                        if($data->teacher_id != $userid)
                          $row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Wednesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                        else
                          $row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Wednesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"item assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }
                    }catch(Exception $ex){
                      $row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Wednesday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedrequested\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                    }

                    //$row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\" data-time=".$time[$i]." colspan = ".$dif."><div data-id=".$data->id." class=\"item assigned\"><p>".$data->course_no."</br>".$subjects."</br>Room - ".$data->room_id."</p></div></td>";
                    $i = $i + $dif;
                  }
                  else{
                    $row = "<td id=\"4".($i+1)."\" data-dif=\"".$dif."\" data-id=\"4".($i+1)."\" data-day=\"Wednesday\"  data-time=".$time[$i]." class=\"drop\"></td>";
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
                $data = getData($time[$i], 'Thursday');
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
                        $row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Thursday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedpending\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }else{
                        if($data->teacher_id != $userid)
                          $row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Thursday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                        else
                          $row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Thursday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"item assigned\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                      }
                    }catch(Exception $ex){
                      $row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]." colspan = ".$dif."><div data-day=\"Thursday\" data-time=".$time[$i]." data-room_id=".$data->room_id." data-teacher_id=".$data->teacher_id."  data-dif=".$dif." data-id=".$data->id." class=\"assignedrequested\"><p>".$data->course_no."-".$subjects."</br>Room - ".$data->room_no."</p></div></td>";
                    }

                    //$row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]." colspan = ".$dif."><div data-id=".$data->id." class=\"item assigned\"><p>".$data->course_no."</br>".$subjects."</br>Room - ".$data->room_id."</p></div></td>";
                    $i = $i + $dif;
                  }
                  else{
                    $row = "<td id=\"5".($i+1)."\" data-dif=\"".$dif."\" data-id=\"5".($i+1)."\" data-day=\"Thursday\" data-time=".$time[$i]."  class=\"drop\"></td>";
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
<br/>
<div id="snackbar">You can not put that class there</div>
</center>

<link rel="stylesheet" type="text/css" href="css/home.css" />
<script type="text/javascript" src="js/home.js"></script>

</body>
</html>
