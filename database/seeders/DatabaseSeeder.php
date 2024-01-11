<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\WebsiteConfig;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create 1 user with admin role
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@google.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);
        // create 1 user with gate role
        User::create([
            'name' => 'Gate',
            'username' => 'gate',
            'email' => 'gate@google.com',
            'password' => bcrypt('gate123'),
            'role' => 'gate',
        ]);
        // create 1 user with kasir role
        User::create([
            'name' => 'Kasir',
            'username' => 'kasir',
            'email' => 'kasir@google.com',
            'password' => bcrypt('kasir123'),
            'role' => 'kasir',
        ]);

        User::factory(10)->create();

        WebsiteConfig::create([
            'nama_config' => 'harga_tiket',
            'value' => '10000',
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
