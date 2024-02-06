<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Services\DummyJsonService; // Предполагается, что этот сервис реализует логику запросов к внешнему API
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $skip = $this->postRepository->countPosts();
        // Получаем 10 постов из внешнего сервиса
        $posts = $this->dummyJsonService->getPosts($limit = 10, $skip,  $select = 'title,body,userId,tags,reactions');
        $this->postRepository->importPosts($posts);
        //dd($skip);              
        //return redirect('/posts')->with('success', 'Posts imported successfully');
    }

    public function index()
    {

        // Передаем посты в вид
        return view('posts.index', compact('posts'));
    }

    public function welcome()
    {
        return view('welcome');
    }
}
