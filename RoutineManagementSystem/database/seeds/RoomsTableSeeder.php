<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //'12 batch

        DB::table('rooms')->insert([    //1
            'capacity' => '100',
            'room_no' => '329',
        ]);
        DB::table('rooms')->insert([    //2
            'capacity' => '90',
            'room_no' => '330',
        ]);
        DB::table('rooms')->insert([    //3
            'capacity' => '80',
            'room_no' => '331',
        ]);

        //'13 batch
        DB::table('rooms')->insert([    //4
            'capacity' => '90',
            'room_no' => '303',
        ]);
        DB::table('rooms')->insert([    //5
            'capacity' => '80',
            'room_no' => '304',
        ]);

        //'14 batch
        DB::table('rooms')->insert([    //6
            'capacity' => '90',
            'room_no' => 'Gallery-1',
        ]);
        DB::table('rooms')->insert([    //7
            'capacity' => '80',
            'room_no' => 'Gallery-2',
        ]);
        DB::table('rooms')->insert([    //8
            'capacity' => '80',
            'room_no' => '130',
        ]);
        DB::table('rooms')->insert([    //9
            'capacity' => '80',
            'room_no' => '0',
        ]);

    }
}
