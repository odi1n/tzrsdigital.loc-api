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
        $title = ['Размер', 'Вес', 'Диагональ', 'Тип', 'Мощность'];

        for ($i = 0; $i < 100; $i++) {
            Property::create([
                'title' => $faker->randomElement($title),
                'value' => $faker->words(2, true),
            ]);
        }
    }
}
