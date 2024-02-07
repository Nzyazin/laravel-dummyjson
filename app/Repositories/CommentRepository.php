<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Post;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CommentRepository implements CommentRepositoryInterface
{
    public function importCommentsForPost(array $comments)
    {
        $errors = [];
        foreach ($comments as $commentsForPost) {
            foreach ($commentsForPost['comments'] as $comment) {
                $existingComment = Comment::where('id', $comment['id'])->first();
                if (!$existingComment) {
                    $validator = Validator::make($comment, [
                        'id' => 'required|numeric|unique:comments',
                        'body' => 'required|string',
                        'postId' => 'required|numeric',
                        'user' => 'required|array'
                    ]);

                    if ($validator->fails()) {
                        $errors[] = $validator->errors();
                        dd($errors);
                    }

                    Comment::create([
                        'id' => $comment['id'],
                        'body' => $comment['body'],
                        'postId' => $comment['postId'],
                        'user' => json_encode($comment['user'])
                    ]);
                }
            }
        }
        if (!empty($errors)) {
            return response()->json(['errors' => $errors], 422);
        }
    }
}
