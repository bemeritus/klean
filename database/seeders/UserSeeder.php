<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John',
            'email' => 'john@example.com',
//            'password' => bcrypt('<PASSWORD>'),
            'password' => Hash::make('secret'),
        ]);

        User::factory((10))->unverified()->create();
    }
}
