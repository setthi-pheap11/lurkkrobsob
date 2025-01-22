<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;
use DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    
    public function index(Request $request){
        $articles = Product::join('categories', 'categories.id', 'products.category_id')
            ->join('users', 'users.id', 'products.created_by_id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'users.name as creator'
            );

            if($request->category_id){
                $category_id = $request->category_id;
                $articles->where(function ($query) use ($category_id) {
                    $query->where('products.category_id', $category_id);
                });
            }

            if($request->keyword){
                $keyword = $request->keyword;
                $articles->where(function ($query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                    $query->orWhere('users.name', 'like', "%{$keyword}%");
                    $query->orWhere('categories.name', 'like', "%{$keyword}%");
                    $query->orWhere('products.short_description', 'like', "%{$keyword}%");
                    $query->orWhere('products.description', 'like', "%{$keyword}%");
                });
            }
        $articles = $articles->paginate(5);
        $data['products'] = $articles;
        $data['categories'] = Category::where('active', 1)->get();
        return view('admins.products.index', $data);
    }


    public function create(){
        $data['categories'] = Category::where('active', 1)->get();
        return view('admins.products.create', $data);
    }

    public function save(Request $request){
        $product = new Product();
        $product->name = $request->name;
        $product->purchase_price = $request->purchase_price;
        $product->sell_price = $request->sell_price;
        $product->category_id = $request->category_id;
        $product->descrtiption = $request->description;
        $product->created_by_id = auth()->user()->id;
        if($request->hasFile('thumbnail')){
            $product->thumbnail = $request->file('thumbnail')->store('assets/images', 'custom');
        }
        if($product->save()){
            return redirect()->route('product.index')->with('success', 'Product added successfully.');
        }else{
            return redirect()->route('product.create')->with('error', 'Product not saved!');
        }
    }

    public function edit($id){
        $data['product'] = Product::find($id);
        $data['categories'] = Category::where('active', 1)->get();
        return view('admins.products.edit', $data);
    }

    public function update(Request $request){
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->purchase_price = $request->purchase_price;
        $product->sell_price = $request->sell_price;
        $product->category_id = $request->category_id;
        $product->descrtiption = $request->description;
        $product->active = $request->active;
        if($request->hasFile('thumbnail')){
            $product->thumbnail = $request->file('thumbnail')->store('assets/images', 'custom');
        }
       
        if($product->save()){
            return redirect()->route('product.index')->with('success', 'product updated successfully.');
        }else{
            return redirect()->back()->with('error', 'product not updated!');
        }
    }
   

}
