<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(30)->create();
        User::insert([
            [
                'id' => 1,
                'name' => 'Daffa',
                'email' => 'muhdaffa2410@gmail.com',
                'password' => bcrypt('admin1234'),
            ],
        ]);
    }
}
