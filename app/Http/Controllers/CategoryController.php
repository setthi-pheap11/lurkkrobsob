<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use DB;
use DataTables;

class CategoryController extends Controller
{

    public function __construct() {
        // $this->middleware('checkUserType');
    }
    
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('categories')->where('active', 1)->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        // $delete = '<a href="'.route('category.delete', $row->id).'">Delete</a>' ;
                    $delete = '<button onclick="removeRow('.$row->id.', this)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>';
                    $edit = '<button onclick="editRow('.$row->id.', this)" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>';
                    // $detail = '<a href="'.route('admin.admin_user.detail', $row->id).'">Detail</a>' ;
                    // $btn = $delete
                    return $edit.' '.$delete;
                })
                
                ->rawColumns(['action'])
                ->make(true);
    }

        return view('admins.categories.index');
    }

    public function create(){
        return view('admins.categories.create');
    }

    public function save(Request $request){
        $cat = new Category();
        $cat->name = $request->name;
        /* upload file here 
            Your code!

        */
        if($cat->save()){
            return response()->json([
                'status' => 200,
                'data' => $cat,
                'sms' => 'Data saved successfull.'
            ]);
            // return redirect()->route('category.index')->with('success', 'Category added successfully.');
        }else{
            return response()->json([
                'status' => 500,
                'data' => null,
                'sms' => 'Data not saved!'
            ]);
            // return redirect()->route('category.create')->with('error', 'Category not saved!');

        }
    }

    public function edit($id){
        $data = Category::find($id);
        return response()->json([
            'status' => 200,
            'data' => $data,
            'sms' => 'Success.'
        ]);
    }

    public function update(Request $request){
        $cat = Category::find($request->id);
        $cat->name = $request->name;
        // $cat->active = $request->active;
        if($cat->save()){
            return response()->json([
                'status' => 200,
                'data' => $cat,
                'sms' => 'Data updated successfull.'
            ]);
            // return redirect()->route('category.index')->with('success', 'Category updated successfully.');
        }else{
            return response()->json([
                'status' => 500,
                'data' => null,
                'sms' => 'Data not saved!'
            ]);
            // return redirect()->route('category.create')->with('error', 'Category not updated!');
        }
    }

    public function delete($id){
        Category::where('id', $id)->delete();
        return response()->json([
            'status' => 200,
            'data' => null,
            'sms' => 'Category deleted successfully.'
        ]);
    }
   

}
