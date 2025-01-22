<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Article;
use DB;
use Carbon\Carbon;

class ArticleController extends Controller
{
    
    public function index(Request $request){
        $articles = Article::join('categories', 'categories.id', 'articles.category_id')
            ->join('users', 'users.id', 'articles.created_by_id')
            ->select(
                'articles.*',
                'categories.name as category_name',
                'users.name as creator'
            );

            if($request->category_id){
                $category_id = $request->category_id;
                $articles->where(function ($query) use ($category_id) {
                    $query->where('articles.category_id', $category_id);
                });
            }

            if($request->keyword){
                $keyword = $request->keyword;
                $articles->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', "%{$keyword}%");
                    $query->orWhere('users.name', 'like', "%{$keyword}%");
                    $query->orWhere('categories.name', 'like', "%{$keyword}%");
                    $query->orWhere('articles.short_description', 'like', "%{$keyword}%");
                    $query->orWhere('articles.description', 'like', "%{$keyword}%");
                });
            }
        $articles = $articles->paginate(5);
        $data['articles'] = $articles;
        $data['categories'] = Category::where('active', 1)->get();
        return view('admins.articles.index', $data);
    }


    public function create(){
        $data['categories'] = Category::where('active', 1)->get();
        return view('admins.articles.create', $data);
    }

    public function save(Request $request){
        $article = new Article();
        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->short_description = $request->short_description;
        $article->description = $request->description;
        $article->created_by_id = auth()->user()->id;
        if($request->hasFile('thumbnail')){
            $article->thumbnail = $request->file('thumbnail')->store('assets/images', 'custom');
        }
        if($article->save()){
            return redirect()->route('article.index')->with('success', 'Article added successfully.');
        }else{
            return redirect()->route('article.create')->with('error', 'Article not saved!');
        }
    }

    public function edit($id){
        $data['article'] = Article::find($id);
        $data['categories'] = Category::where('active', 1)->get();
        return view('admins.articles.edit', $data);
    }

    public function update(Request $request){
        $article = Article::find($request->id);
        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->short_description = $request->short_description;
        $article->description = $request->description;
        $article->active = $request->active;
        $article->is_publish = $request->is_publish;
        if($request->is_publish && $article->publish_date == NULL){
            $article->publish_date = Carbon::now()->format('Y-m-d');
        }
        if($request->hasFile('thumbnail')){
            $article->thumbnail = $request->file('thumbnail')->store('assets/images', 'custom');
        }
        if($article->save()){
            return redirect()->route('article.index')->with('success', 'Article updated successfully.');
        }else{
            return redirect()->back()->with('error', 'Article not updated!');
        }
    }
   

}
