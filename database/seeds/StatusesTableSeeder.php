<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $statuses = [
            'afwezig' => [
                'student_selectable' => 1, 
                'coach_selectable' => 1, 
                'text' => 'Afmelden', 
                'color' => '#bb3d49',
                'reason_requierd'=> 0,
            ],
            'aanwezig' => [
                'student_selectable' => 0, 
                'coach_selectable' => 1, 
                'text' => 'Aanmelden',
                'color' => '#61e786',
                'reason_requierd'=> 0,
            ],
            'tussendoor uit' => [
                'student_selectable' => 1,
                'coach_selectable' => 0, 
                'text' => 'Tussendoor uit',
                'color' =>'#db4547',
                'reason_requierd'=> 1,
            ],
            'activiteit' => [
                'student_selectable' => 0,
                'coach_selectable' => 1, 
                'text' => 'Activiteit, buiten school',
                'color' => '#982395',
                'reason_requierd'=> 0,
            ],
            'bso' => [
                'student_selectable' => 1, 
                'coach_selectable' => 0, 
                'text' => 'BSO',
                'color' => '#61c0bf',
                'reason_requierd'=> 0,
            ],
            'ziek' => [
                'student_selectable' => 0,
                'coach_selectable' => 1, 
                'text' => 'Ziek',
                'color' => '#9B539C',
                'reason_requierd'=> 0,
            ],
            'ziek naar huis' => [
                'student_selectable' => 1,
                'coach_selectable' => 1, 
                'text' => 'Ziek naar huis',
                'color' => '#da507a',
                'reason_requierd'=> 1,
            ],
            'bijzonder verlof' => [
                'student_selectable' => 0, 
                'coach_selectable' => 0, 
                'text' => 'Bijzonder verlof',
                'color' => '#354458',
                'reason_requierd'=> 0,
            ],
        ];

        foreach ($statuses as $key => $value) {
            DB::Table('statuses')->insert([
                'status' => $key,
                'text' => $value['text'],
                'color' => $value['color'],
                'student_selectable' => $value['student_selectable'],
                'coach_selectable' => $value['coach_selectable'],
                'reason_requierd'=> $value['reason_requierd'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        
    }
}
