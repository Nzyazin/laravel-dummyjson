<?php

namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface
{
    public function importCommentsForPost(array $comments);
}
