<?php

namespace App\Http\Controllers;

use App\Models\ChemistryClass;
use App\Models\News;
use App\Models\Post;
use App\Models\StudentsInClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $news = News::latest()->take(9)->get();
        $posts = Post::join('post_hearts', 'posts.id', '=', 'post_hearts.post_id')->select('posts.*', DB::raw('count(post_hearts.id) as total_hearts'))
            ->groupBy('posts.id')
            ->orderByDesc('total_hearts')
            ->inRandomOrder()->take(4)
            ->get();
        $teachers = User::where('role_id', 2)->inRandomOrder()->take(4)->get();
        return view('home.index', compact('news', 'posts', 'teachers'));
    }

    public function dashboard()
    {
        $classes = ChemistryClass::all();
        $salary[0] = 0;
        foreach ($classes as $class) {
            $countStudent = StudentsInClass::where('class_id', $class->id)->count();
            if (Auth::user()->role_id == 1) {
                $salary[$class->id] = $class->price_per_student * $countStudent * 60 / 100;
            };
            if (Auth::user()->role_id == 2) {
                $salary[$class->id] = $class->price_per_student * $countStudent * 40 / 100;
            };
        }

        $money = array_sum($salary);
        return view('pages.dashboard', compact('money'));
    }

    public function periodicTableIUPAC()
    {
        return view('home.periodic-table.indexIUPAC');
    }

    public function periodicTableLATIN()
    {
        return view('home.periodic-table.indexLATIN');
    }

    public function chemicalBalance()
    {
        return view('home.chemical-balance.index');
    }
}
