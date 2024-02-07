<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Comment;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use App\Services\DummyJsonService;
use App\Repositories\CommentRepository;

class PostRepository implements PostRepositoryInterface
{

    public function importPosts(array $posts)
    {   
        $commentsPosts = [];
        foreach ($posts['posts'] as $post) {
            
            $existingPost = Post::where('id', $post['id'])->first();

            if (!$existingPost) {
                $validator = Validator::make($post, [
                    'id' => 'required|numeric|unique:posts',
                    'title' => 'required|string',
                    'body' => 'required|string',
                    'userId' => 'required|numeric',
                    'tags' => 'nullable|array',
                    'reactions' => 'nullable|numeric',
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                Post::create([
                    'id' => $post['id'],
                    'title' => $post['title'],
                    'body' => $post['body'],
                    'userId' => $post['userId'],
                    'tags' => json_encode($post['tags']),
                    'reactions' => $post['reactions']
                ]);
            }
            $dummyService = new DummyJsonService();
            $commentsPosts[] = $dummyService->getCommentsByPost($post['id']);
        }

        $commentRepository = new CommentRepository();
        $commentRepository->importCommentsForPost($commentsPosts);
    }

    public function getLatestPostsWithComments(int $postsCount = 25, int $commentsCount = 3)
    {
        $posts = Post::latest()->take($postsCount)->get();

        $postIds = $posts->pluck('id');
        $comments = Comment::whereIn('post_id', $postIds)
            ->get()
            ->groupBy('post_id')
            ->map(function ($comments) use ($commentsCount) {
                return $comments->take($commentsCount);
            });

        $posts->each(function ($post) use ($comments) {
            $post->setRelation('comments', $comments->get($post->id) ?? collect());
        });

        return $posts;
    }

    public function countPosts()
    {
        $postsCount = Post::count();
        return $postsCount;
    }
}
