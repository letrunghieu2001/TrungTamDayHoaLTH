<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $blog)
    {
        $this->authorize('createComment', $blog);
        $input = $request->only('content');
        $input['post_id'] = $blog->id;
        $input['user_id'] =  Auth::user()->id;
        Comment::create($input);

        return back();
    }

    public function update(Request $request, Comment $comment, User $user, Post $blog)
    {
        $input = $request->editContent;
        Comment::where('id', $comment->id)->update([
            'content' => $input,
        ]);

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
