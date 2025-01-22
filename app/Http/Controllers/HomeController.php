<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['user_count'] = DB::table('users')->where('active', 1)->count();
        $data['article_count'] = DB::table('articles')->where('active', 1)->count();
        $data['article_published_count'] = DB::table('articles')->where('active', 1)->where('is_publish', 1)->count();
        $data['artilce_in_categories'] = DB::table('categories')->leftJoin('articles', 'articles.category_id', 'categories.id')
            ->select(
                'categories.name as category_name',
                DB::raw('count(articles.id) as total_article')
            )->groupBy('categories.id')
            ->orderBy('total_article', 'desc')
            ->get();
        return view('home', $data);
    }
}
