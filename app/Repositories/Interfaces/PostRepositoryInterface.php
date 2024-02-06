<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function importPosts(array $posts);

    public function getLatestPostsWithComments(int $postsCount = 25, int $commentsCount = 3);

    public function countPosts();
}
