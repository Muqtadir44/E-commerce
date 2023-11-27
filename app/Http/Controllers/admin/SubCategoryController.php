<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{

    public function index(){
        return view('admin.sub_category.listing');
    }
    public function listing(Request $request){
        $sub_category = SubCategory::query()->get();
        return DataTables::of($sub_category)
        ->addIndexColumn()
        ->make(true);
    }


    public function getCategories(){
        $categories = category::query()->get();
        return response()->json(['categories' => $categories]);
    }
    public function create(){
        $categories = category::orderBy('name','DESC')->get();
        $data['categories'] = $categories;
        return view('admin.sub_category.create',$data);
    }

    public function add(Request $request){
        // return dd($request);
        // return $request->all();
        $request->validate([
            'name'     => 'required',
            'category' => 'required'
        ]);

        $sub_category              = new SubCategory();
        $sub_category->category_id = $request->category;
        $sub_category->name        = $request->name;
        $sub_category->slug        = $request->slug;
        $sub_category->status      = $request->notes;
        $sub_category->save();

        return response()->json($sub_category);
    }

    public function get_sub_category(){

    }

    public function update(){

    }

    public function delete(){

    }
}
