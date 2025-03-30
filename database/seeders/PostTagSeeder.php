<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post_tags = PostTag::factory(4)->create();

        $posts = Post::inRandomOrder()->limit(2)->get();
        foreach ($posts as $post) {
            $post->postTags()->sync($post_tags->random(rand(1, 4)));
        }
    }
}
