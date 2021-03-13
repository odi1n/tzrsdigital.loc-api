<?php

namespace Database\Seeders;

use App\Models\Property;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Property::create([
                'title' => $faker->words(1, true),
                'value' => $faker->unique()->words(2, true),
            ]);
        }
    }
}
