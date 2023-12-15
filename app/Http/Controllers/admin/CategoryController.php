<?php

namespace App\Http\Controllers\admin;

// use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\category;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\CategoriesDataTable;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Image;



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
        // return dd($request->all());
        $validator = Validator::make($request->all(),[
            'name'   => 'required',
            'slug'   => 'required|unique:categories',
        ]);

        if ($validator->passes()) {

            $category = new category();

            $category -> name   = $request->name;
            $category -> slug   = $request->slug;
            $category -> status = $request->status;


            //Saving Image
            if (!empty($request->image_id)) {
                $tempImage     = TempImage::find($request->image_id);
                $ImageName  = $tempImage->name;
                // $extArray      = explode('.',$tempImage);
                // $ext           = last($extArray);

                // $sPath = public_path().'/temp/'.$tempImage->name;
                $sPath = public_path().'/uploads/category/'.$ImageName;
                $dPath = public_path().'/uploads/category/thumb/'.$ImageName;
                // File::copy($sPath,$dPath);
                $img = Image::make($sPath);
                // $img->resize(450, 600);
                $img->fit(450, 600, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($dPath);
                $category-> image = $ImageName;
            }


            $category->save();
            $request->session()->flash('success','Category Created Successfully');

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
        if (empty($category)) {
            return response()->json([
                'status'   => false,
                'notFound' => true,
                'message'  => 'Category Not Found'
            ]);
        }

         $validator = Validator::make($request->all(),[
            'name'   => 'required',
            'slug'   => 'required|unique:categories,slug,'.$request->category_id.'',
        ]);

        if ($validator->passes()) {

            $category -> name   = $request->name;
            $category -> slug   = $request->slug;
            $category -> status = $request->status;

            $oldImage = $category->image;
            //Saving Image
            if (!empty($request->image_id)) {
                $tempImage     = TempImage::find($request->image_id);
                $ImageName  = $tempImage->name;

                $sPath = public_path().'/uploads/category/'.$ImageName;
                $dPath = public_path().'/uploads/category/thumb/'.$ImageName;

                $img = Image::make($sPath);
                $img->fit(450, 600, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($dPath);
                $category-> image = $ImageName;
            }

            $category->save();

            //Delete Old Image
            File::delete(public_path().'/uploads/category/'.$oldImage);
            File::delete(public_path().'/uploads/category/thumb/'.$oldImage);
            $request->session()->flash('success','Category Updated Successfully');

            return response()->json([
                'status'  => true,
                'message' => 'Category Updated Successfully'
            ]);

        }else{
            return  response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function delete($category_id,Request $request){
        // echo $request->id;
        $category = category::find($category_id);
        if (!empty($category->image)) {
            File::delete(public_path().'/uploads/category/'.$category->image);
            File::delete(public_path().'/uploads/category/thumb/'.$category->image);
        }
        $category->delete();

        $request->session()->flash('success','Category Deleted Successfully');
        return response()->json([
            'status'  => true,
            'message' => 'Category Deleted Successfully'
        ]);

    }

}
