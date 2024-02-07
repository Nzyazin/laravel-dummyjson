<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'body' => $this->faker->paragraph,
            'postId' => function () {
                return Post::factory()->create()->id;
            }, // Автоматическое создание связанного поста
            'user' => json_encode([
                'id' => $this->faker->unique()->randomNumber(5),
                'name' => $this->faker->name                
            ]), // Генерация случайных данных пользователя в формате JSON
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
