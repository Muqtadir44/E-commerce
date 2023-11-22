<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Yajra\DataTables;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function listing(){
        
        return view('admin.sub_category.listing');
    }
    public function create(){
        $categories = category::orderBy('name','DESC')->get();
        $data['categories'] = $categories;
        return view('admin.sub_category.create',$data);
    }


}
