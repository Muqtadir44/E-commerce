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
        // $sub_category = SubCategory::query()->get();
        // return DataTables::of($sub_category)
        // ->addIndexColumn()
        // ->make(true);
    }
    public function create(){
        $categories = category::orderBy('name','DESC')->get();
        $data['categories'] = $categories;
        return view('admin.sub_category.create',$data);
    }


}
