<?php

use Illuminate\Database\Seeder;

class RoutinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('routines')->insert([ //sunday dsp theory
            'lab' => true,
            'start_time' => '8',
            'end_time' => '11',
            'day' => 'Sunday',
            'status' => 'regular',
            'year' => '2012',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '3',
            'course_id' => '2',
            'teacher_id' => '1',
            'room_id' => '2',
        ]);
        DB::table('routines')->insert([ //sunday bio theory
            'lab' => false,
            'start_time' => '11',
            'end_time' => '12',
            'day' => 'Sunday',
            'status' => 'regular',
            'year' => '2012',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '2',
            'course_id' => '3',
            'teacher_id' => '2',
            'room_id' => '3',
        ]);

        DB::table('routines')->insert([ //monday dsp theory
            'lab' => false,
            'start_time' => '10',
            'end_time' => '11',
            'day' => 'Monday',
            'status' => 'regular',
            'year' => '2012',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '1',
            'course_id' => '1',
            'teacher_id' => '1',
            'room_id' => '3',
        ]);

        DB::table('routines')->insert([ //tuesday bio lab
            'lab' => true,
            'start_time' => '10',
            'end_time' => '13',
            'day' => 'Tuesday',
            'status' => 'regular',
            'year' => '2012',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '2',
            'course_id' => '4',
            'teacher_id' => '2',
            'room_id' => '4',
        ]);

        DB::table('routines')->insert([ //wednesday bio theory
            'lab' => false,
            'start_time' => '11',
            'end_time' => '12',
            'day' => 'Wednesday',
            'status' => 'regular',
            'year' => '2012',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '2',
            'course_id' => '3',
            'teacher_id' => '2',
            'room_id' => '3',
        ]);


        DB::table('routines')->insert([ //thursday dsp 8-10
            'lab' => false,
            'start_time' => '8',
            'end_time' => '10',
            'day' => 'Thursday',
            'status' => 'regular',
            'year' => '2012',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '1',
            'course_id' => '1',
            'teacher_id' => '1',
            'room_id' => '1',
        ]);

        DB::table('routines')->insert([ //thursday bio theory
            'lab' => false,
            'start_time' => '11',
            'end_time' => '12',
            'day' => 'Thursday',
            'status' => 'regular',
            'year' => '2012',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '2',
            'course_id' => '3',
            'teacher_id' => '2',
            'room_id' => '7',
        ]);

        //'13batch's routine

        DB::table('routines')->insert([ //sunday SE lab
            'lab' => true,
            'start_time' => '8',
            'end_time' => '11',
            'day' => 'Sunday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '4',
            'course_id' => '5',
            'teacher_id' => '4',
            'room_id' => '8',
        ]);

        DB::table('routines')->insert([ //sunday graphics lab
            'lab' => true,
            'start_time' => '11',
            'end_time' => '13',
            'day' => 'Sunday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '5',
            'course_id' => '6',
            'teacher_id' => '5',
            'room_id' => '8',
        ]);

        DB::table('routines')->insert([ //sunday 300
            'lab' => true,
            'start_time' => '14',
            'end_time' => '17',
            'day' => 'Sunday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '6',
            'course_id' => '7',
            'teacher_id' => '6',
            'room_id' => '9',
        ]);

        DB::table('routines')->insert([ //monday Technical writing
            'lab' => false,
            'start_time' => '9',
            'end_time' => '11',
            'day' => 'Monday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '7',
            'course_id' => '8',
            'teacher_id' => '7',
            'room_id' => '8',
        ]);

        DB::table('routines')->insert([ //monday networking
            'lab' => false,
            'start_time' => '11',
            'end_time' => '12',
            'day' => 'Monday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '8',
            'course_id' => '9',
            'teacher_id' => '8',
            'room_id' => '7',
        ]);

        DB::table('routines')->insert([ //monday graphics
            'lab' => false,
            'start_time' => '12',
            'end_time' => '13',
            'day' => 'Monday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '5',
            'course_id' => '10',
            'teacher_id' => '5',
            'room_id' => '8',
        ]);

        DB::table('routines')->insert([ //monday SE
            'lab' => false,
            'start_time' => '14',
            'end_time' => '15',
            'day' => 'Monday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '4',
            'course_id' => '11',
            'teacher_id' => '4',
            'room_id' => '6',
        ]);

        DB::table('routines')->insert([ //monday CA
            'lab' => false,
            'start_time' => '15',
            'end_time' => '16',
            'day' => 'Monday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '9',
            'course_id' => '12',
            'teacher_id' => '9',
            'room_id' => '6',
        ]);

        DB::table('routines')->insert([ //tuesday CA
            'lab' => false,
            'start_time' => '8',
            'end_time' => '9',
            'day' => 'Tuesday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '9',
            'course_id' => '12',
            'teacher_id' => '9',
            'room_id' => '6',
        ]);

        DB::table('routines')->insert([ //tuesday Technical writing
            'lab' => false,
            'start_time' => '9',
            'end_time' => '10',
            'day' => 'Tuesday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '7',
            'course_id' => '8',
            'teacher_id' => '7',
            'room_id' => '8',
        ]);

        DB::table('routines')->insert([ //tuesday 300
            'lab' => true,
            'start_time' => '10',
            'end_time' => '11',
            'day' => 'Tuesday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '6',
            'course_id' => '7',
            'teacher_id' => '6',
            'room_id' => '9',
        ]);

        DB::table('routines')->insert([ //tuesday networking
            'lab' => false,
            'start_time' => '11',
            'end_time' => '12',
            'day' => 'Tuesday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '8',
            'course_id' => '9',
            'teacher_id' => '8',
            'room_id' => '7',
        ]);

        DB::table('routines')->insert([ //tuesday graphics
            'lab' => false,
            'start_time' => '12',
            'end_time' => '13',
            'day' => 'Tuesday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '5',
            'course_id' => '10',
            'teacher_id' => '5',
            'room_id' => '7',
        ]);
////////////////////////////////////////////////////
        DB::table('routines')->insert([ //Wednesday CA
            'lab' => false,
            'start_time' => '8',
            'end_time' => '9',
            'day' => 'Wednesday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '9',
            'course_id' => '12',
            'teacher_id' => '9',
            'room_id' => '6',
        ]);

        DB::table('routines')->insert([ //Wednesday Technical writing
            'lab' => false,
            'start_time' => '9',
            'end_time' => '10',
            'day' => 'Wednesday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '7',
            'course_id' => '8',
            'teacher_id' => '7',
            'room_id' => '8',
        ]);

        DB::table('routines')->insert([ //Wednesday networking
            'lab' => false,
            'start_time' => '10',
            'end_time' => '11',
            'day' => 'Wednesday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '8',
            'course_id' => '9',
            'teacher_id' => '8',
            'room_id' => '7',
        ]);

        DB::table('routines')->insert([ //Wednesday graphics
            'lab' => false,
            'start_time' => '11',
            'end_time' => '12',
            'day' => 'Wednesday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '5',
            'course_id' => '10',
            'teacher_id' => '5',
            'room_id' => '7',
        ]);

        DB::table('routines')->insert([ //Wednesday SE
            'lab' => false,
            'start_time' => '14',
            'end_time' => '15',
            'day' => 'Wednesday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '4',
            'course_id' => '11',
            'teacher_id' => '4',
            'room_id' => '6',
        ]);


        DB::table('routines')->insert([ //Thursday CA
            'lab' => false,
            'start_time' => '8',
            'end_time' => '10',
            'day' => 'Thursday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '9',
            'course_id' => '12',
            'teacher_id' => '9',
            'room_id' => '6',
        ]);

        DB::table('routines')->insert([ //Thursday networking lab
            'lab' => true,
            'start_time' => '10',
            'end_time' => '13',
            'day' => 'Thursday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '8',
            'course_id' => '13',
            'teacher_id' => '8',
            'room_id' => '8',
        ]);

        DB::table('routines')->insert([ //Thursday SE
            'lab' => false,
            'start_time' => '14',
            'end_time' => '15',
            'day' => 'Thursday',
            'status' => 'regular',
            'year' => '2013',
            'semester' => '2',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '4',
            'course_id' => '11',
            'teacher_id' => '4',
            'room_id' => '6',
        ]);












        //'14 batch routine
        DB::table('routines')->insert([ //Sunday micro
            'lab' => false,
            'start_time' => '9',
            'end_time' => '10',
            'day' => 'Sunday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '10',
            'course_id' => '14',
            'teacher_id' => '10',
            'room_id' => '1',
        ]);

        DB::table('routines')->insert([ //Sunday mis
            'lab' => false,
            'start_time' => '10',
            'end_time' => '11',
            'day' => 'Sunday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '7',
            'course_id' => '15',
            'teacher_id' => '7',
            'room_id' => '1',
        ]);

        DB::table('routines')->insert([ //Sunday data com
            'lab' => false,
            'start_time' => '11',
            'end_time' => '12',
            'day' => 'Sunday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '10',
            'course_id' => '16',
            'teacher_id' => '10',
            'room_id' => '1',
        ]);

        DB::table('routines')->insert([ //Sunday os
            'lab' => false,
            'start_time' => '12',
            'end_time' => '13',
            'day' => 'Sunday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '11',
            'course_id' => '17',
            'teacher_id' => '11',
            'room_id' => '1',
        ]);

        DB::table('routines')->insert([ //Sunday database
            'lab' => false,
            'start_time' => '14',
            'end_time' => '15',
            'day' => 'Sunday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '12',
            'course_id' => '18',
            'teacher_id' => '12',
            'room_id' => '1',
        ]);


        DB::table('routines')->insert([ //Monday micro
            'lab' => false,
            'start_time' => '9',
            'end_time' => '10',
            'day' => 'Monday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '10',
            'course_id' => '14',
            'teacher_id' => '10',
            'room_id' => '1',
        ]);

        DB::table('routines')->insert([ //Monday mis
            'lab' => false,
            'start_time' => '10',
            'end_time' => '11',
            'day' => 'Monday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '7',
            'course_id' => '15',
            'teacher_id' => '7',
            'room_id' => '1',
        ]);

        DB::table('routines')->insert([ //Monday data com
            'lab' => false,
            'start_time' => '11',
            'end_time' => '12',
            'day' => 'Monday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '10',
            'course_id' => '16',
            'teacher_id' => '10',
            'room_id' => '1',
        ]);

        DB::table('routines')->insert([ //Monday database
            'lab' => false,
            'start_time' => '12',
            'end_time' => '13',
            'day' => 'Monday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '12',
            'course_id' => '18',
            'teacher_id' => '12',
            'room_id' => '1',
        ]);

        DB::table('routines')->insert([ //Monday database lab
            'lab' => true,
            'start_time' => '14',
            'end_time' => '17',
            'day' => 'Monday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '12',
            'course_id' => '19',
            'teacher_id' => '12',
            'room_id' => '2',
        ]);





        DB::table('routines')->insert([ //Tuesday micro
            'lab' => false,
            'start_time' => '9',
            'end_time' => '10',
            'day' => 'Tuesday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '10',
            'course_id' => '14',
            'teacher_id' => '10',
            'room_id' => '1',
        ]);

        DB::table('routines')->insert([ //Tuesday mis
            'lab' => false,
            'start_time' => '10',
            'end_time' => '11',
            'day' => 'Tuesday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '7',
            'course_id' => '15',
            'teacher_id' => '7',
            'room_id' => '1',
        ]);

        DB::table('routines')->insert([ //Tuesday data com
            'lab' => false,
            'start_time' => '11',
            'end_time' => '12',
            'day' => 'Tuesday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '10',
            'course_id' => '16',
            'teacher_id' => '10',
            'room_id' => '1',
        ]);

        DB::table('routines')->insert([ //Tuesday database
            'lab' => false,
            'start_time' => '12',
            'end_time' => '13',
            'day' => 'Tuesday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '12',
            'course_id' => '18',
            'teacher_id' => '12',
            'room_id' => '1',
        ]);



        DB::table('routines')->insert([ //Wednesday database lab
            'lab' => true,
            'start_time' => '9',
            'end_time' => '12',
            'day' => 'Wednesday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '12',
            'course_id' => '19',
            'teacher_id' => '12',
            'room_id' => '5',
        ]);

        DB::table('routines')->insert([ //Wednesday os
            'lab' => false,
            'start_time' => '14',
            'end_time' => '15',
            'day' => 'Wednesday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '11',
            'course_id' => '17',
            'teacher_id' => '11',
            'room_id' => '1',
        ]);

        DB::table('routines')->insert([ //Wednesday mis
            'lab' => false,
            'start_time' => '15',
            'end_time' => '16',
            'day' => 'Wednesday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '7',
            'course_id' => '15',
            'teacher_id' => '7',
            'room_id' => '1',
        ]);


        DB::table('routines')->insert([ //Thursday data com lab
            'lab' => true,
            'start_time' => '8',
            'end_time' => '11',
            'day' => 'Thursday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '10',
            'course_id' => '20',
            'teacher_id' => '10',
            'room_id' => '5',
        ]);

        DB::table('routines')->insert([ //Thursday os lab
            'lab' => true,
            'start_time' => '11',
            'end_time' => '13',
            'day' => 'Thursday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '11',
            'course_id' => '21',
            'teacher_id' => '11',
            'room_id' => '5',
        ]);

        DB::table('routines')->insert([ //Thursday micro lab
            'lab' => true,
            'start_time' => '14',
            'end_time' => '17',
            'day' => 'Thursday',
            'status' => 'regular',
            'year' => '2014',
            'semester' => '1',
            'dept' => 'CSE',
            'labassis_id' => '3',
            'user_id' => '10',
            'course_id' => '22',
            'teacher_id' => '10',
            'room_id' => '7',
        ]);



    }
}
