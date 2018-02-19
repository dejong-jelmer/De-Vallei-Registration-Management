<?php

use Carbon\Carbon;
use App\Models\Coach;
use Illuminate\Database\Seeder;

class CoachesStudentStudentdataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
        
    //     factory(App\Models\Coach::class, 10)
    //     ->create()
    //     ->each(
    //         function ($coach) {
            
    //             $coach->coachData()->save(factory(App\Models\Coachdata::class)->make());

    //             $coach->students()->saveMany(factory(App\Models\Student::class, 10)->make())
    //                 ->each(
    //                     function ($student) {
    //                         $student->studentdata()->save(factory(App\Models\Studentdata::class)->make());    
    //                 }); 
    //     });
        
    // }

    public function run()
    {
        $coaches = [
            'Hans' => [
                'color' => '#BFD8D2'
            ],
            'Maria' => [
                'color' => '#FEDCD2'
            ],
            'Michel' => [
                'color' => '#E9B000'
            ],
            'Judith' => [
                'color' => '#EB6E80'
            ],
            'Freek' => [
                'color' => '#7D1935'
            ],
            'Johan' => [
                'color' => '#3CC37E'
            ],
            'Chantal' => [
                'color' => '#018E97'
            ],
            'Antoinette' => [
                'color' => '#565656'
            ],
            'Jaap' => [
                'color' => '#DE744C'
            ]

        ];

        foreach ($coaches as $key => $value) {
            DB::Table('coaches')->insert([
                'coach' => $key,
                'color' => $value['color'],
                'deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $coaches = Coach::get();

        foreach ($coaches as $coach) {
            $coach->coachData()->save(factory(App\Models\Coachdata::class)->make());

            $coach->students()->saveMany(factory(App\Models\Student::class, 10)->make())
                    ->each(
                        function ($student) {
                            $student->studentdata()->save(factory(App\Models\Studentdata::class)->make());    
                    }); 
        }
    }


}
