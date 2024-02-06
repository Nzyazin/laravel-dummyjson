<?php

namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface
{
    public function importComments($postId, array $comments);
}
