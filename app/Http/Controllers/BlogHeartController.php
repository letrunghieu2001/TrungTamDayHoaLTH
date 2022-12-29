<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class BlogHeartController extends Controller
{
    public function heart(Post $blog, User $user)
    {
        $userId = $user->id;
        $heart = $blog->hearts()->toggle($userId);
        $countPostHeart = $blog->hearts()->count();

        return response()->json([
            'heart'=> $heart,
            'countPostHeart' => $countPostHeart
        ]);
    }
}
