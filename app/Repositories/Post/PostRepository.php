<?php

namespace App\Repositories\Post;

interface PostRepository
{
    public function store($postEntity);

    public function list($currentLogInUser);

    public function getPostById($postId);

    public function update($postEntity, $postId);

    public function delete($postEntity, $postId);

    public function getTitle();

    public function adminLevelPosts();

    public function userLevelPosts(int $userId);
}