<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = new User([
            'name' => $faker->name,
            'email' => 'admin',
            'email_verified_at' => now(),
            'password' =>  Hash::make('admin'),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        $user->save();
    }
}
