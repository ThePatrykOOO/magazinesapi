<?php

use Illuminate\Database\Seeder;

use App\Publisher;
use Faker\Generator as Faker;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0;$i<5;$i++) {
            $user = new Publisher([
                'name' => $faker->company,
            ]);
            $user->save();
        }
    }
}
