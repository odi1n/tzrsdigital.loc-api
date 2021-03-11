<?php

namespace Database\Seeders;

use App\Models\Catalog;
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
                'title' => $faker->unique()->words(1, true),
            ]);
        }
    }
}
