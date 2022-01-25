<?php

namespace App\Repositories\Post;

use App\Models\Eloquent\Post;
use App\Services\Domain\Exception\AccessDeniedException;
use App\Services\Domain\Exception\NotFoundException;
use Exception;

class PostEloquentRepository implements PostRepository
{
    public function store($postEntity)
    {
        $postEntity = Post::insert([
            'title' => $postEntity->title,
            'description' => $postEntity->comment,
            'created_user_id' => $postEntity->createdUserId,
            'updated_user_id' => $postEntity->createdUserId,
            'created_at' => $postEntity->createdAt,
            'updated_at' => $postEntity->createdAt
        ]);

        return $postEntity;
    }

    public function getPostById($postId)
    {
        $post = Post::where('id', $postId)->where('deleted_at', null)->first();

        if ($post === null) {
            throw new NotFoundException(__('domain.post_not_found'));
        }

        return $post;
    }

    public function list($user)
    {
        $posts = null;
        switch ($user->type) {
            case "0":
                $posts = $this->adminLevelPosts();
                break;
            default:
                $posts = $this->userLevelPosts($user->id);
        }

        if ($posts === null) {
            throw new NotFoundException(__('domain.post_not_found'));
        }

        return $posts->map(function ($post) {
            return $post->toArray();
        });
    }

    public function update($postEntity, $postId)
    {
        $post = $this->getPostById($postId);

        if (\Auth::user()->type != "0" && $post->created_user_id != \Auth::id()) {
            throw new AccessDeniedException(__('domain.accessDenied'), 403);
        }

        $post->title = $postEntity->title;
        $post->description = $postEntity->comment;
        $post->status = $postEntity->status;
        $post->updated_user_id = $postEntity->updatedUserId;
        $post->updated_at = $postEntity->updatedAt;
        $post->save();

        return $post;
    }

    public function delete($postEntity, $postId)
    {
        $post = $this->getPostById($postId);

        if (\Auth::user()->type != "0" && $post->created_user_id != \Auth::id()) {
            throw new AccessDeniedException(__('domain.accessDenied'), 403);
        }

        $post->deleted_user_id = $postEntity->deletedUserId;
        $post->deleted_at = $postEntity->deletedAt;
        $post->save();

        return $post;
    }

    public function getTitle()
    {
        return Post::get('title');
    }

    public function adminLevelPosts()
    {
        return Post::with('user')->where([
            ['deleted_at', '=', null]
        ])->get();
    }

    public function userLevelPosts(int $userId)
    {
        return Post::with('user')->where([
            ['deleted_at', '=', null],
            ['created_user_id', '=', $userId]
        ])->get();
    }
}
