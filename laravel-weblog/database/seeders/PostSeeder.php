<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()
        ->count(20)
        ->state(
            // adding randomized created_at timestamps to the posts
            function () {
                $date = fake()->dateTimeBetween('-1 year', 'now');

                return [
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            }
        )
        ->create()
        ->each(function (Post $post) {
            // attach random categories to the post
            $categories = \App\Models\Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $post->categories()->attach($categories);
        });
    }
}
