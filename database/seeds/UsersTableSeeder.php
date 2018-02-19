<?php

use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::Table('users')->insert([
                'naam' => 'Dev',
                'email' => 'test@test.com',
                'password' => Hash::make('1'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

    }
}
