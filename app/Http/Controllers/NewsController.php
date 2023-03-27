<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query()->with('user');

        $news = $query->latest()->paginate(9);

        return view('home.news.index', compact('news'));
    }

    public function show(News $new)
    {
        return view('home.news.show', compact('new'));
    }

    public function management(Request $request)
    {
        $query = News::query()->with('user');

        if ($request->has('q')) {
            $q = trim($request->input('q'));
            $query->where(function ($query) use ($q) {
                $query->where('title', 'LIKE', "%" . $q . "%");
            });
        }

        $news = $query->latest()->paginate(9);

        return view('pages.news-management.index', compact('news'));
    }

    public function create()
    {
        return view('pages.news-management.create');
    }

    public function store(CreateNewsRequest $request)
    {
        $content = $request->content;
        $dom = new \DomDocument();
        $dom->loadHtml('<?xml encoding="utf-8" ?>' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
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

        $post = News::create([
            'title' => $request->title,
            'content' => $content,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('news.management')->with('succes', 'Tạo mới tin tức thành công');
    }

    public function edit(News $new)
    {
        $this->authorize('update', $new);
        return view('pages.news-management.edit', compact('new'));
    }

    public function update(UpdateNewsRequest $request, News $new)
    {
        $this->authorize('update', $new);
        $content = $request->content;
        libxml_use_internal_errors(true);
        $dom = new \DomDocument();
        $dom->loadHtml('<?xml encoding="utf-8" ?>' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | libxml_use_internal_errors(true));
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
        $new = News::findOrFail($new->id)->update([
            'title' => $request->title,
            'content' => $content,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('news.management')->with('succes', 'Sửa tin thành công');
    }

    public function destroy(News $new)
    {
        $new->delete();
        return back()->with('succes', 'Bài viết trên đã bị ẩn');
    }

    public function deleteNew()
    {
        $news = News::onlyTrashed()->with('user')->latest()->paginate(9);
        return view('pages.news-management.delete-news', compact('news'));
    }

    public function restore($new)
    {
        News::onlyTrashed()->where('id', $new)->restore();
        return back()->with('succes', 'Tin tức trên đã được khôi phục');
    }

    public function restoreAll()
    {
        News::onlyTrashed()->restore();
        return back()->with('succes', 'Toàn bộ Tin tức đã được khôi phục');
    }

    public function forceDelete($new)
    {
        News::onlyTrashed()->where('id', $new)->forceDelete();
        return back()->with('succes', 'Tin tức trên đã bị xóa hoàn toàn khỏi hệ thống');
    }
}
