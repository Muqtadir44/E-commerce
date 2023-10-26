<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\category;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories = category::latest();

        if (!empty($request->get('search'))) {
            $categories = $categories->where('name','like','%'.$request->get('search').'%');            
        }        
        
        $categories = category::latest()->paginate(10);
        
        return view('admin.category.all_categories',compact('categories'));
    }

    public function create(){
        // echo "create category page";
        return view('admin.category.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'   => 'required',
            'slug'   => 'required|unique:categories',
        ]);

        if ($validator->passes()) {

            $category = new category();

            $category -> name   = $request->name;
            $category -> slug   = $request->slug;
            $category -> status = $request->status;

            $category->save();

            // $request->session()->flash('success','Category Created Successfully');

            return response()->json([
                'status'  => true,
                'message' => 'Category Created Successfully'
            ]);
            
        }else{
            return  response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){

    }

}
