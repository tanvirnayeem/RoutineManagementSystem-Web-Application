<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //'12 batch
        DB::table('courses')->insert([  //dsp 1
            'course_no' => '425',
            'title' => 'Digital Signal Processing',
            'credit' => '3',
            'num_of_students' => '60',
            't_id' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);
        DB::table('courses')->insert([  //dsp lab 2
            'course_no' => '426',
            'title' => 'Digital Signal Processing',
            'credit' => '1.5',
            'num_of_students' => '60',
            't_id' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);
        DB::table('courses')->insert([  //Bio 3
            'course_no' => '469',
            'title' => 'Bio Informatics',
            'credit' => '3',
            'num_of_students' => '30',
            't_id' => '2',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);
        DB::table('courses')->insert([  //Bio lab 4
            'course_no' => '470',
            'title' => 'Bio Informatics',
            'credit' => '1.5',
            'num_of_students' => '30',
            't_id' => '2',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);







        //'13 batch
        DB::table('courses')->insert([  //SE Lab 5
            'course_no' => '332',
            'title' => 'Software Engineering Lab',
            'credit' => '1.5',
            'num_of_students' => '60',
            't_id' => '4',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //Graphics Lab 6
            'course_no' => '374',
            'title' => 'Computer Graphics & Image Processing Lab',
            'credit' => '1.5',
            'num_of_students' => '60',
            't_id' => '5',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //300 7
            'course_no' => '300',
            'title' => 'Project Work & Seminar',
            'credit' => '2',
            'num_of_students' => '60',
            't_id' => '6',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //Technical writing 8
            'course_no' => '375',
            'title' => 'Technical Writing & Presentation',
            'credit' => '2',
            'num_of_students' => '60',
            't_id' => '7',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //Networking 9
            'course_no' => '361',
            'title' => 'Computer Networking',
            'credit' => '3',
            'num_of_students' => '60',
            't_id' => '8',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //Graphics 10
            'course_no' => '373',
            'title' => 'Computer Graphics & Image Processing',
            'credit' => '3',
            'num_of_students' => '60',
            't_id' => '5',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //SE 11
            'course_no' => '331',
            'title' => 'Software Engineering',
            'credit' => '3',
            'num_of_students' => '60',
            't_id' => '4',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //CA 12
            'course_no' => '329',
            'title' => 'Computer Architecture',
            'credit' => '3',
            'num_of_students' => '60',
            't_id' => '9',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //Networking lab 13
            'course_no' => '362',
            'title' => 'Computer Networking Lab',
            'credit' => '3',
            'num_of_students' => '60',
            't_id' => '8',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);






        //'14 batch
        DB::table('courses')->insert([  //micro 14
            'course_no' => '367',
            'title' => 'Microprocessor & Interfacing',
            'credit' => '3',
            'num_of_students' => '60',
            't_id' => '10',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //mis 15
            'course_no' => '351',
            'title' => 'Management Information System',
            'credit' => '3',
            'num_of_students' => '60',
            't_id' => '7',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //data com 16
            'course_no' => '365',
            'title' => 'Communication Engineering',
            'credit' => '3',
            'num_of_students' => '60',
            't_id' => '10',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //os 17
            'course_no' => '335',
            'title' => 'Operating System & System Programming',
            'credit' => '3',
            'num_of_students' => '60',
            't_id' => '11',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //database 18
            'course_no' => '333',
            'title' => 'Database System',
            'credit' => '3',
            'num_of_students' => '60',
            't_id' => '12',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //database lab 19
            'course_no' => '334',
            'title' => 'Database System Lab',
            'credit' => '3',
            'num_of_students' => '60',
            't_id' => '12',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //data com lab 20
            'course_no' => '366',
            'title' => 'Communication Engineering Lab',
            'credit' => '1.5',
            'num_of_students' => '60',
            't_id' => '10',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //os lab 21
            'course_no' => '336',
            'title' => 'Operating System & System Programming Lab',
            'credit' => '1.5',
            'num_of_students' => '60',
            't_id' => '11',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        DB::table('courses')->insert([  //micro lab 22
            'course_no' => '368',
            'title' => 'Microprocessor & Interfacing Lab',
            'credit' => '1.5',
            'num_of_students' => '60',
            't_id' => '10',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);


    }
}
