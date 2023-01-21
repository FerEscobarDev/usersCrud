<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'category_id' => Category::all()->random()->id,
            'name' => 'Fernando',
            'lastname' => 'Escobar',
            'cedula' => fake()->numberBetween(7000000, 1500000000),
            'country' => 'islas Malvinas',
            'address' => fake()->address(),
            'mobil' => fake()->numberBetween(3000000000, 3229999999),
            'email' => 'admin@prueba.com',
            'email_verified_at' => now(),
            'password' => bcrypt('PasswordAdmin'),
        ]);

        User::factory(99)->create();
    }
}
