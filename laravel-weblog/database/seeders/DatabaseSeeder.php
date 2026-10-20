<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create(
            [
                'name' => 'premium user',
                'email' => 'premium@example.com',
                'password' => 'Password',
                'premium' => true,
            ]
        );

        User::factory()->create(
            [
                'name' => 'free user',
                'email' => 'free@example.com',
                'password' => 'Password',
                'premium' => false,
            ]
        );

        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
