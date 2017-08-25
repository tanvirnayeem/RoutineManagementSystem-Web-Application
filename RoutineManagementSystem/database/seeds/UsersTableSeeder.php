<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([    //1
            'name' => 'Admin Panel',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'admin',
            'dept' => 'CSE',
            'reg_no' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([    //1
            'name' => 'Mohammed Jahirul Islam',
            'email' => 'jahir75bd@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'Teacher',
            'dept' => 'CSE',
            'reg_no' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([    //2
            'name' => 'Biswapriyo Chakrabarty',
            'email' => 'biswa-cse@sust.edu',
            'password' => bcrypt('123456'),
            'role' => 'Teacher',
            'dept' => 'CSE',
            'reg_no' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([    //3
            'name' => 'Billal',
            'email' => 'billal@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'Lab Assistant',
            'dept' => 'CSE',
            'reg_no' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


        DB::table('users')->insert([    //4
            'name' => 'Md Forhad Rabbi',
            'email' => 'frabbi-cse@sust.edu',
            'password' => bcrypt('123456'),
            'role' => 'Teacher',
            'dept' => 'CSE',
            'reg_no' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([    //5
            'name' => 'Mariam E Jannat',
            'email' => 'mukta-cse@sust.edu',
            'password' => bcrypt('123456'),
            'role' => 'Teacher',
            'dept' => 'CSE',
            'reg_no' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([    //6
            'name' => 'Md Saiful Islam',
            'email' => 'saiful-cse@sust.edu',
            'password' => bcrypt('123456'),
            'role' => 'Teacher',
            'dept' => 'CSE',
            'reg_no' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([    //7
            'name' => 'Mohammad Reza Selim',
            'email' => 'selim@sust.edu',
            'password' => bcrypt('123456'),
            'role' => 'Teacher',
            'dept' => 'CSE',
            'reg_no' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([    //8
            'name' => 'Md Masum',
            'email' => 'masum-cse@sust.edu',
            'password' => bcrypt('123456'),
            'role' => 'Teacher',
            'dept' => 'CSE',
            'reg_no' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([    //9
            'name' => 'Husne Ara Chowdhury',
            'email' => 'husne-cse@sust.edu',
            'password' => bcrypt('123456'),
            'role' => 'Teacher',
            'dept' => 'CSE',
            'reg_no' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);




        DB::table('users')->insert([    //10
            'name' => 'Mahruba Sharmin Chowdhury',
            'email' => 'mahruba-cse@sust.edu',
            'password' => bcrypt('123456'),
            'role' => 'Teacher',
            'dept' => 'CSE',
            'reg_no' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([    //11
            'name' => 'Sabir Ismail',
            'email' => 'sabir-cse@sust.edu',
            'password' => bcrypt('123456'),
            'role' => 'Teacher',
            'dept' => 'CSE',
            'reg_no' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([    //12
            'name' => 'Shikh Nabil Mohammad',
            'email' => 'nabil-cse@sust.edu',
            'password' => bcrypt('123456'),
            'role' => 'Teacher',
            'dept' => 'CSE',
            'reg_no' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);



    }
}
