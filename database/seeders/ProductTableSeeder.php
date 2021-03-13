<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\Product;
use App\Models\PropertiesLists;
use App\Models\Property;
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
        $catalogAll = Catalog::all();
        $properties = Property::all();

        for ($i = 0; $i < 50; $i++) {
            $product = Product::create([
                'name' => $faker->unique()->words(1, true),
                'description' => $faker->unique()->realText(200),
                'price' => $faker->randomNumber(4),
                'count' => $faker->randomNumber(3),
                'catalogs_id' => $faker->randomElement($catalogAll)['id'],
            ]);

            $product->properties()->attach([
                $faker->randomElement($properties)['id'],
                $faker->randomElement($properties)['id'],
                $faker->randomElement($properties)['id'],
            ]);
        }
    }
}
