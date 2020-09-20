<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Magazine;
use App\Publisher;

class MagazineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        $publisherIds = Publisher::getAllPublishersIds();
        for ($i = 0; $i < 20; $i++) {
            $magazine = new Magazine([
                'name' => $faker->word,
                'publisher_id' => $faker->randomElement($publisherIds)
            ]);
            $magazine->save();
        }
    }
}
