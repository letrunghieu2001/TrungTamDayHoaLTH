<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query()->where('status', 1)->with('category', 'user');

        if ($request->has('q')) {
            $q = trim($request->input('q'));
            $query->where(function ($query) use ($q) {
                $query->where('title', 'LIKE', "%" . $q . "%");
            });
        }

        $blogs = $query->latest()->paginate(9);

        return view('home.blog.index', compact('blogs'));
    }

    public function show(Post $blog)
    {
        $this->authorize('view', $blog);
        $relatedBlogs = Post::where('category_id', $blog->category_id)->where('status', 1)->whereNotIn('id', [$blog->id])->inRandomOrder()
            ->limit(4)->get();
        $isPostHeart = null;
        if (Auth::check()) {
            $isPostHeart =  $blog->hearts()->where('user_id', Auth::user()->id)->first();
        }
        $countPostHeart = $blog->hearts()->count();
        $comments = Comment::query()->where('post_id', $blog->id)->with('user')->get();
        if (count($comments) > 0) {
            foreach ($comments as $comment) {
                if (!Auth::check()) {
                    $isCommentReported = null;
                    $isCommentHeart = null;
                    $countCommentHeart[$comment->id] =  $comment->hearts()->count();
                } else {
                    $isCommentReported[$comment->id] = DB::table('report_comments')->where('user_created_id', Auth::user()->id)->where('comment_id', $comment->id)->first();
                    $isCommentHeart[$comment->id] = $comment->hearts()->where('user_id', Auth::user()->id)->first();
                    $countCommentHeart[$comment->id] =  $comment->hearts()->count();
                }
            }
        } else {
            $isCommentReported = null;
            $isCommentHeart = null;
            $countCommentHeart = null;
        }
        return view('home.blog.show', compact('blog', 'relatedBlogs', 'isPostHeart', 'countPostHeart', 'comments', 'isCommentHeart', 'countCommentHeart', 'isCommentReported'));
    }

    public function indexActive(Request $request)
    {
        $query = Post::query()->where('status', 1)->with('category', 'user');

        if ($request->has('q')) {
            $q = trim($request->input('q'));
            $query->where(function ($query) use ($q) {
                $query->where('title', 'LIKE', "%" . $q . "%");
            });
        }

        $blogs = $query->latest()->paginate(9);

        return view('pages.blog-management.index-active', compact('blogs'));
    }

    public function indexInactive(Request $request)
    {
        $query = Post::query()->where('status', 0)->with('category', 'user');

        if ($request->has('q')) {
            $q = trim($request->input('q'));
            $query->where(function ($query) use ($q) {
                $query->where('title', 'LIKE', "%" . $q . "%");
            });
        }

        $blogs = $query->latest()->paginate(9);

        return view('pages.blog-management.index-inactive', compact('blogs'));
    }

    public function showCheckApproved(Post $blog)
    {
        return view('pages.blog-management.show-check-approved', compact('blog'));
    }

    public function updateStatus(Post $blog)
    {
        if ($blog->status == 0) {
            Post::where('id', $blog->id)->update([
                'status' => 1,
            ]);
        }
        if ($blog->status == 1) {
            Post::where('id', $blog->id)->update([
                'status' => 0,
            ]);
        }
        return back()->with('succes', 'Bài đăng đã thay đổi trạng thái thành công');
    }

    public function destroy(Post $blog)
    {
        $blog->delete();
        return back()->with('succes', 'Bài viết trên đã bị ẩn');
    }

    public function deleteBlog()
    {
        $blogs = Post::onlyTrashed()->with('category', 'user')->latest()->paginate(9);
        return view('pages.blog-management.delete-blog', compact('blogs'));
    }

    public function restore($blog)
    {
        Post::onlyTrashed()->where('id', $blog)->restore();
        return back()->with('succes', 'Bài viết trên đã được khôi phục');
    }

    public function restoreAll()
    {
        Post::onlyTrashed()->restore();
        return back()->with('succes', 'Toàn bộ Bài viết đã được khôi phục');
    }

    public function forceDelete($blog)
    {
        Post::onlyTrashed()->where('id', $blog)->forceDelete();
        return back()->with('succes', 'Bài viết trên đã bị xóa hoàn toàn khỏi hệ thống');
    }
}
