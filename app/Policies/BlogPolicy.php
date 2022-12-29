<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    public function view(?User $user, Post $blog)
    {
        return $blog->status == 1;
    }

    public function update(User $user, Post $blog)
    {
        return $user->id == $blog->user_id;
    }

    public function updateStatus(User $user)
    {
        return $user->role_id == 1;
    }

    public function delete(User $user, Post $blog)
    {
        return $user->id == $blog->user_id ||
            $user->role_id == 1;
    }

    public function hasBlog(User $user, Post $blog)
    {
        return $user->id == $blog->user_id && $user->role_id != 1;
    }

    public function canComment(?User $user, Post $blog, Comment $comment)
    {
        return optional($user)->role_id == 1
            || optional($user)->id == $blog->user_id
            || optional($user)->id == $comment->user_id;
    }

    public function createComment(?User $user, Post $blog)
    {
        return $blog->status == 1;
    }

    public function canHeart(?User $user, Post $blog)
    {
        return $blog->status == 1;
    }
}
