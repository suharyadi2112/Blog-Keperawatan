<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' =>  Hash::make('12345678'),
        // ]);
        
        // create 1 user
        \App\Models\User::factory()->create([
            'name' => 'Admin Keperawatan',
            'username' => 'admkp',
            'password' =>  Hash::make('12345678'),
        ]);
    }
}
