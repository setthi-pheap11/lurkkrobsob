<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use DB;
use App;

class ApiController //extends Controller
{
    public function index(Request $req){
        $keys = (array)['ab','cd','bd'];
        if(in_array($req->api_key, $keys)){
            $articles = DB::table('articles as a')
                ->join('categories as c', 'c.id', 'a.category_id')
                ->where('a.active', 1)
                ->where('is_publish', 1)
                ->select('a.*', 'c.name as category_name'); // Select necessary columns

            // Add keyword search if provided
            if ($req->keyword) {
                $keyword = $req->keyword;
                $articles->where(function ($query) use ($keyword) {
                    $query->where('a.title', 'like', "%{$keyword}%")
                        ->orWhere('c.name', 'like', "%{$keyword}%")
                        ->orWhere('a.short_description', 'like', "%{$keyword}%")
                        ->orWhere('a.description', 'like', "%{$keyword}%");
                });
            }

            // Execute the query and get the results
            $articlesData = $articles->paginate(2); // Fetch the results

            // Prepare the response data
            $data = [
                'status' => 200,
                'error_message' => '', // Fixed typo
                'data' => $articlesData // Assign the fetched data
            ];

            // Return the JSON response
            return json_encode($data);
        }else{
            return 'Invalid API keys';
        }
        
    }

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
