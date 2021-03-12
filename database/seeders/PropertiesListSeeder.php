<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\Product;
use App\Models\PropertiesLists;
use App\Models\Property;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PropertiesListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $productAll = Product::all();
        $propertyAll = Property::all();

        for ($i = 0; $i < 100; $i++) {
            PropertiesLists::create([
                'product_id'=>$faker->randomElement($productAll)['id'],
                'property_id'=>$faker->randomElement($propertyAll)['id'],
                'value'=>$faker->unique()->words(1,true),
            ]);

            $propertyAll = Property::all();
        }
    }
}
