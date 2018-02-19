<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Student;
use App\Models\Coachdata;
use App\Models\Attendance;
use App\Models\Studentdata;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// $factory->define(User::class, function (Faker\Generator $faker) {
//     return [
//         'naam' => $faker->name,
//     ];
// });

$factory->define(Coach::class, function (Faker\Generator $faker) {
    
    return [
        'coach' => $faker->name,
        'color' => $faker->name,
    ];
});

$factory->define(Coachdata::class, function (Faker\Generator $faker) {
    
    return [
        'voornaam' => $faker->name,
        'tussenvoegsel' => str_random(2),
        'achternaam' => $faker->name,
        'email' => $faker->email,
        'huisnummer' => random_int(0, 999)."",
        'mobiel' => random_int(0000000000, 9999999999)."",
        'postcode' => random_int(0000, 9999) . str_random(2),
        'straat' => str_random(5),
        'telefoon' => random_int(0000000000, 9999999999)."",
    ];
});




$factory->define(Student::class, function (Faker\Generator $faker) {
    
    $namen = ['Kim', 'Peter', 'Jolien', 'Danielle', 'Felix', 'Daan', 'Daan', 'Levy', 'Selma', 'Danny', 'Noah', 'Shara', 'Jullia', 'Henk', 'Lucas', 'Fin', 'Emma', 'Tess', 'Sofie', 'Milan', 'Jesse', 'Liam', 'Mees', 'Noud', 'Adam', 'James', 'Max', 'Anna', 'Zoë', 'Fleur', 'Lauren', 'Yara', 'Marleen', 'Bram', 'Nora', 'Feline', 'Elise'];
    $naam = $namen[random_int(0,count($namen)-1)];

    $kleuren = ['#FEDCD2', '#EB6E80','#E9B000', '#DE744C', '#BFD8D2', '#7D1935', '#565656', '#3CC37E', '#018E97', '#DC143C', '#E0FFFF', '#F0E68C', '#D8BFD8', '#FFE4B5'];
    $kleur = $kleuren[random_int(0,count($kleuren)-1)];

    return [
        'naam' => $naam,
        'status_id' => 1,
        'color' => $kleur
    ];
});


// $factory->define(Status::class, function (Faker\Generator $faker) {
//     return [
//         'status' => str_random(5),
//     ];
// });

$factory->define(Studentdata::class, function (Faker\Generator $faker) {
    return [
        'voornaam' => $faker->name,
        'tussenvoegsel' => str_random(2),
        'achternaam' => $faker->name,
        'email' => $faker->email,
        'huisnummer' => random_int(0, 999)."",
        'postcode' => random_int(0000, 9999) . str_random(2),
        'straat' => str_random(5),
        'telefoon_1' => random_int(0000000000, 9999999999)."",
        'leerlingnummer' => random_int(00000, 99999)."",
    ];
});



