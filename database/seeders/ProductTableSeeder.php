<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $countCatalog = Catalog::all();

        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'name' => $faker->unique()->words(1, true),
                'description' => $faker->unique()->realText(200),
                'price' => $faker->randomNumber(4),
                'count' => $faker->randomNumber(3),
                'catalogs_id' => $faker->randomElement($countCatalog)['id'],
            ]);
        }
    }
}
