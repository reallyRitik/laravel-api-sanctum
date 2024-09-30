<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $value) {
            DB::table('students')->insert([
                'name' => $faker->name(),
                'city' => $faker->city(),
                'fees' => $faker->randomFloat(2, 0, 10000), // Adjusting range for fees
            ]);
        }
    }
}
