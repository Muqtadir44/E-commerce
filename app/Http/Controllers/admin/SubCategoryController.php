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
        ->addColumn('action',function($data){
            return '<a type="button" name="edit" data-route="' . route("sub-categories.get", $data->id) . '" id="get_sub_category" class="edit-btn btn btn-sm text-primary">
                       <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                           <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                       </svg>
                   </a>
                   <a class="btn btn-sm text-danger" data-route = "' . route("sub-categories.delete", $data->id) . '" id="delete_sub_category">
                       <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                           <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                           </svg>
                   </a>
                   ';
       })
        ->editColumn('status',function($data){
           if ($data->status == 'Active') {
              return ' <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                       </svg>';
           }else{
               return '<svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                       </svg>';
           }
        })
        ->editColumn('created_at',function($data){
           $date = date_create($data->created_at);
           return date_format($date,"d M-Y");
        })
        ->editColumn('updated_at',function($data){
           $date = date_create($data->updated_at);
           return date_format($date,"d M-Y");
        })
        ->rawColumns(['status','action','created_at','updated_at'])
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
