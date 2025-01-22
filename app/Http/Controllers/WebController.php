<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App;

class WebController extends Controller
{
    public function home(Request $request){
        
        $articles = DB::table('articles')
            ->join('categories', 'categories.id', 'articles.category_id')
            ->where('articles.active', 1)->where('is_publish', 1);
        if($request->keyword){
            $keyword = $request->keyword;
            $articles->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%");
                $query->orWhere('categories.name', 'like', "%{$keyword}%");
                $query->orWhere('articles.short_description', 'like', "%{$keyword}%");
                $query->orWhere('articles.description', 'like', "%{$keyword}%");
            });
        }
        $data['articles'] = $articles->paginate(4);
        return view('website.index', $data);
    }

    public function detail(Request $request, $id){
        $data['article'] = DB::table('articles')->find($id);
        return view('website.article_detail', $data);
    }

    public function articleByCategory(Request $request, $name, $id){
        $data['articles'] = DB::table('articles')
            ->where('active', 1)
            ->where('is_publish', 1)
            ->where('category_id', $id)
            ->paginate(4);
        $data['name'] = $name;
        return view('website.article_by_category', $data);
    }

    public function swthicLanguage($locale){
        App::setlocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
