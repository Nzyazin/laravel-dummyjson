<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DummyJsonService
{
    protected $baseUrl = 'https://dummyjson.com';

    // Метод для получения постов
    public function getPosts($limit = 10, $skip, $select = 'title,reactions,userId')
    {        
        $response = Http::get("{$this->baseUrl}/posts", [
            'limit' => $limit,
            'skip' => $skip,
            'select' => $select
        ]);

        if ($response->successful()) {
            // После успешного запроса увеличиваем счетчик загруженных постов
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
   
}
