<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            '#FEDCD2', '#EB6E80','#E9B000', '#DE744C', '#BFD8D2', '#7D1935', '#565656', '#3CC37E', '#018E97', '#DC143C', '#E0FFFF', '#F0E68C', '#D8BFD8', '#FFE4B5',
            ];

        foreach ($colors as $color) {
            DB::Table('colors')->insert([
                'color' => $color,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
        }
    }
}
