<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyBlogController extends Controller
{
    public function indexActive(Request $request)
    {
        $query = Post::query()->where('user_id', Auth::user()->id)->where('status', 1)->with('category', 'user');

        if ($request->has('q')) {
            $q = trim($request->input('q'));
            $query->where(function ($query) use ($q) {
                $query->where('title', 'LIKE', "%" . $q . "%");
            });
        }

        $blogs = $query->latest()->paginate(9);

        return view('pages.my-blog.index-active', compact('blogs'));
    }

    public function indexInactive(Request $request)
    {
        $query = Post::query()->where('user_id', Auth::user()->id)->where('status', 0)->with('category', 'user');

        if ($request->has('q')) {
            $q = trim($request->input('q'));
            $query->where(function ($query) use ($q) {
                $query->where('title', 'LIKE', "%" . $q . "%");
            });
        }

        $blogs = $query->latest()->paginate(9);

        return view('pages.my-blog.index-inactive', compact('blogs'));
    }

    public function create()
    {
        $categories = PostCategory::all();
        return view('pages.my-blog.create', compact('categories'));
    }

    public function store(CreatePostRequest $request)
    {
        $content = $request->content;
        $dom = new \DomDocument();
        @$dom->loadHtml('<?xml encoding="utf-8" ?>' .$content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if (strpos($data, ';') === false) {
                continue;
            }
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);

            $image_name = "/upload/" . time() . $item . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }
        $content = $dom->saveHTML();
        if (Auth::user()->role_id == 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        $post = Post::create([
            'title' => $request->title,
            'content' => $content,
            'status' => $status,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id
        ]);

        if (Auth::user()->role_id == 1) {
            return redirect()->route('myblog.active')->with('succes', 'Tạo mới bài đăng thành công');
        } else {
            return redirect()->route('myblog.inactive')->with('succes', 'Tạo mới bài đăng thành công. Bạn vui lòng chờ quản trị viên duyệt bài');
        }
    }

    public function edit(Post $blog)
    {
        $this->authorize('update', $blog);
        $categories = PostCategory::all();
        return view('pages.my-blog.edit', compact('categories', 'blog'));
    }

    public function update(UpdatePostRequest $request, Post $blog)
    {
        $this->authorize('update', $blog);
        $content = $request->content;
        $dom = new \DomDocument();
        @$dom->loadHtml('<?xml encoding="utf-8" ?>' .$content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if (strpos($data, ';') === false) {
                continue;
            }
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);

            $image_name = "/upload/" . time() . $item . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }
        $content = $dom->saveHTML();
        if (Auth::user()->role_id == 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        $post = Post::findOrFail($blog->id)->update([
            'title' => $request->title,
            'content' => $content,
            'status' => $status,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id
        ]);

        if (Auth::user()->role_id == 1) {
            return redirect()->route('myblog.active')->with('succes', 'Sửa bài đăng thành công');
        } else {
            return redirect()->route('myblog.inactive')->with('succes', 'Sửa bài đăng thành công. Bạn vui lòng chờ quản trị viên duyệt bài');
        }
    }

    public function destroy(Post $blog)
    {
        $this->authorize('delete', $blog);
        $blog->delete();
        return back()->with('succes', 'Bài viết trên đã bị ẩn');
    }

    public function deleteBlog()
    {
        $blogs = Post::onlyTrashed()->where('user_id', Auth::user()->id)->with('category', 'user')->latest()->paginate(9);
        return view('pages.my-blog.delete-blog', compact('blogs'));
    }

    public function restore($blog)
    {
        Post::onlyTrashed()->where('user_id', Auth::user()->id)->where('id', $blog)->restore();
        return back()->with('succes', 'Bài viết trên đã được khôi phục');
    }

    public function restoreAll()
    {
        Post::onlyTrashed()->where('user_id', Auth::user()->id)->restore();
        return back()->with('succes', 'Toàn bộ Bài viết đã được khôi phục');
    }

    public function forceDelete($blog)
    {
        Post::onlyTrashed()->where('user_id', Auth::user()->id)->where('id', $blog)->forceDelete();
        return back()->with('succes', 'Bài viết trên đã bị xóa hoàn toàn khỏi hệ thống');
    }
}
