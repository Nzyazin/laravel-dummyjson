<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all(); // Получение всех постов

        foreach ($posts as $post) {
            Comment::factory(rand(1, 5))->create([
                'postId' => $post->id // Установка postId для каждого комментария
            ]);
        }
    }
}
