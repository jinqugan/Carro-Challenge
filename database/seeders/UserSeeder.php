<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)
            ->hasPosts(3)
            ->create([
                'name' => 'carro',
                'email' => 'carro@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('qweqwe11'),
                'remember_token' => Str::random(10),
            ]);

        \App\Models\User::factory()
            ->count(10)
            ->hasPosts(10)
            ->create();

        // \App\Models\User::factory(10)->create();
    }
}
