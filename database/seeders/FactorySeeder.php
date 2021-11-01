<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i < 20; $i++) {

        	DB::table('factory')->insert([
                'name' => $faker->name,
                'price' => $faker->numerify('######'),
                'bedrooms' => $faker->numberBetween(1,5),
                'bathrooms'=> $faker->numberBetween(1,5),
                'storeys'  => $faker->numberBetween(1,5),
                'garages'  => $faker->numberBetween(1,5),
            ]);


        }
    }
}
