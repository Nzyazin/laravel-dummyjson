<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Services\DummyJsonService; // Предполагается, что этот сервис реализует логику запросов к внешнему API

class PostController extends Controller
{
    protected $dummyJsonService;
    protected $postRepository;
    protected $commentRepository;

    public function __construct(DummyJsonService $dummyJsonService, PostRepositoryInterface $postRepository, CommentRepositoryInterface $commentRepository)
    {
        $this->dummyJsonService = $dummyJsonService;
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
    }

    public function import()
    {
        try {
            // Подсчитываем уже имеющееся количество постов
            $skip = $this->postRepository->countPosts();
            // Получаем 10 постов из внешнего сервиса
            $posts = $this->dummyJsonService->getPosts($limit = 10, $skip, $select = 'title,body,userId,tags,reactions');
    
            if ($posts) {
                $this->postRepository->importPosts($posts);
                return redirect('/')->with('success', 'Posts imported successfully');
            } else {
                // Если посты не были получены, возвращаемся с ошибкой
                return redirect('/')->with('error', 'No posts to import');
            }
        } catch (\Exception $e) {
            // В случае возникновения исключения возвращаемся с ошибкой
            return redirect('/')->with('error', 'Failed to import. Error: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $posts = $this->postRepository->getLatestPostsWithComments();
        // Передаем посты
        return view('index', compact('posts'));
    }

    public function welcome()
    {
        return view('welcome');
    }
}
