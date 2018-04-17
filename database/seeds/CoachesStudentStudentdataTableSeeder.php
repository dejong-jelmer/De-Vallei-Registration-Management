<?php

use Carbon\Carbon;
use App\Models\Coach;
use App\Models\Color;
use Illuminate\Database\Seeder;

class CoachesStudentStudentdataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        

        $coaches = [
            'Hans' ,
            'Maria' ,
            'Michel' ,
            'Judith' ,
            'Freek' ,
            'Johan' ,
            'Chantal' ,
            'Antoinette' ,
            'Jaap' 

        ];

        foreach ($coaches as $coach) {
            DB::Table('coaches')->insert([
                'coach' => $coach,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $colors = App\Models\Color::get();
        $coaches = Coach::get();

        foreach ($coaches as $coach) {
            $random = random_int(0, count($colors)-1);
            $color = $colors[$random];
            
            $coach->coachData()->save(factory(App\Models\Coachdata::class)->make());

            $coach->color()->associate($color);
            $coach->save();

            $coach->students()->saveMany(factory(App\Models\Student::class, 10)->make())
                    ->each(
                        function ($student) use ($colors) {
                            $random = random_int(0, count($colors)-1);
                            $color = $colors[$random];
                            $student->studentdata()->save(factory(App\Models\Studentdata::class)->make());
                            $student->color()->associate($color);
                            $student->save();
                    }); 
        }
    }


}
