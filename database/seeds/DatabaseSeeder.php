<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $faker = Faker\Factory::create();

        for($i = 0; $i <= 10; $i++) {
            App\User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password'=> app('hash')->make('12345')
            ]);
        }

    }
}
