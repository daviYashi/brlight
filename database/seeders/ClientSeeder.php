<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Client::create([
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'cpf' => $faker->unique()->numerify('###.###.###-##'),
                'car_plate' => $faker->bothify('???-####'),
            ]);
        }
    }
}
