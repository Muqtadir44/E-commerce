<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\category;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\CategoriesDataTable;


class CategoryController extends Controller
{

    public function all_categories(CategoriesDataTable $dataTable){
        return $dataTable->render('admin.category.all_categories');
    }
    // public function index(Request $request){
    //     $categories = category::latest();

    //     if (!empty($request->get('search'))) {
    //         $categories = $categories->where('name','like','%'.$request->get('search').'%');            
    //     }        
        
    //     $categories = category::latest()->paginate(10);
    //     // $data = category::query()->get();
    //     // return DataTables::of($data)->addIndexColumn()->make(true);
    //     // return DataTables::of(category::query())->make(true);
        
    //     return view('admin.category.all_categories',compact('categories'));
    // }

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

    public function edit(Request $request){
        $id = $request->id;
        $category = category::find($id);
        return response()->json($category);
    }

    public function update(Request $request){
         
        $category = category::find($request->category_id);
        $update_category = [
            'name'   => $request->category_name,
            'slug'   => $request->slug,
            'status' => $request->status
        ];
        $category->update($update_category);
        return response()->json([
            'status'  => true,
            'message' => 'Category Updated Successfully'
        ]);
    }

    public function delete(){

    }

}
