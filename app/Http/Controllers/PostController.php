<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Services\DummyJsonService; // Предполагается, что этот сервис реализует логику запросов к внешнему API
use Illuminate\Http\Request;

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
        $posts = $this->dummyJsonService->getPosts(10); // Получаем 10 постов из внешнего сервиса


        return redirect('/posts')->with('success', 'Posts imported successfully');
    }

    public function index()
    {       

        // Передаем посты в вид
        return view('posts.index', compact('posts'));
    }
}

