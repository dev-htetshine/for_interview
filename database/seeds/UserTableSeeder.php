<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'profile_photo' => Str::random(5).'.png',
            'type' =>  0,
            'phone' => Str::random(11),
            'address' => Str::random(255),
            'date_of_birth' => Carbon::create('2000', '01', '01'),
            'created_user_id' => 1,
            'updated_user_id' => 1,
        ]);
    }
}
