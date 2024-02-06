<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

class DummyJsonService
{
    protected $baseUrl = 'https://dummyjson.com';
    protected $postsLoaded = 0;

    // Конструктор класса, если необходим
    public function __construct()
    {
        // Инициализация клиента HTTP, если необходимо
    }

    // Метод для получения постов
    public function getPosts($limit = 10, $select = 'title,reactions,userId')
    {
        $skip = $this->postsLoaded;
        $response = Http::get("{$this->baseUrl}/posts", [
            'limit' => $limit,
            'skip' => $skip,
            'select' => $select
        ]);

        if ($response->successful()) {
            // После успешного запроса увеличиваем счетчик загруженных постов
            $this->postsLoaded += $limit;
            return $response->json();
        } else {
            // Обработка ошибочного ответа
            Log::error("Ошибка при получении постов: {$response->status()}");
            return []; // Возврат пустого массива или сообщения об ошибке
        }
    }

    // Метод для получения комментариев к посту
    public function getCommentsByPost($postId)
    {
        $response = Http::get("{$this->baseUrl}/posts/{$postId}/comments");

        // Проверка на успешность ответа и возвращение данных или обработка ошибок
        if ($response->successful()) {
            return $response->json();
        } else {
            // Обработка ошибочного ответа
            Log::error("Ошибка при получении комментариев: {$response->status()}");
            return []; // Возврат пустого массива или сообщения об ошибке
        }
    }

    public function resetPostsLoaded()
    {
        $this->postsLoaded = 0;
    }
}
