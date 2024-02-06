<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Post;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CommentRepository implements CommentRepositoryInterface
{
    public function importComments($postId, array $comments)
    {        
        
        foreach ($comments as $comment) {
            $existingComment = Comment::where('id', $comment['id'])->first();
            if (!$existingComment) {
                $validator = Validator::make($comment, [
                    'id' => 'required|numeric|unique:posts',
                    'body' => 'required|string',
                    'post_id' => 'required|numeric',
                    'user_id' => 'required|numeric'
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                Comment::create([
                    'id' => $comment['id'],
                    'body' => $comment['body'],
                    'post_id' => $comment['postId'],
                    'user_id' => $comment['user']['id']
                ]);
            }
            
        }
    }
}
