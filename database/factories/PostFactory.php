<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'userId' => $this->faker->unique()->numberBetween(1, 100), // Предполагая, что у вас есть до 100 пользователей
            'tags' => json_encode($this->faker->words($nb = 3, $asText = false)), // Преобразование массива в JSON строку
            'reactions' => $this->faker->numberBetween(0, 1000), // Случайное количество реакций
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
