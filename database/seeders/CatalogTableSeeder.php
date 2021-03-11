<?php

namespace Database\Seeders;

use App\Models\Catalog;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CatalogTableSeeder extends Seeder
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
            Catalog::create([
                'title' => $faker->unique()->words(1, true),
            ]);
        }
    }
}
