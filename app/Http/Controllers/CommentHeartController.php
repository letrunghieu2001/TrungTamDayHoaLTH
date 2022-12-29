<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentHeartController extends Controller
{
    public function heart(Comment $comment, User $user)
    {
        $userId = $user->id;
        $heart = $comment->hearts()->toggle($userId);
        $countCommentHeart = $comment->hearts()->count();

        return response()->json([
            'heart' => $heart,
            'countCommentHeart' => $countCommentHeart
        ]);
    }
}
