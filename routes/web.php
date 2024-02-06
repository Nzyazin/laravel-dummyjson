<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Главная страница с кнопкой импорта
Route::get('/', [PostController::class, 'welcome']);

// Импорт данных
Route::get('/import', [PostController::class, 'import']);

// Вывод постов
Route::get('/posts', [PostController::class, 'index']);
