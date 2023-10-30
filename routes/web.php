<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\TempImagesController;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->group(function(){
    
    Route::group(['middleware' => 'admin.guest'],function(){

        Route::get('/login',[AdminController::class,'admin_login'])->name('admin.login');
        Route::post('/authenticate',[AdminController::class,'authenticate'])->name('admin.authenticate');

    });

        Route::group(['middleware' => 'admin.auth'],function(){
            Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
            Route::get('/logout',[DashboardController::class,'logout'])->name('admin.logout');

            // ---Categories Route's ---
            
            Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');

            Route::post('/categories',[CategoryController::class,'store'])->name('categories.store');

            Route::post('/upload-temp-image',[TempImagesController::class,'create'])->name('temp-images.create');
            
            Route::get('/getslug',function(Request $request){
                $slug = '';
                if (!empty($request->title)) {
                    $slug = Str::slug($request->title);
                }
                return response()->json([
                    'status' => true,
                    'slug'   => $slug
                ]);

            })->name('getSlug');

            Route::get('/categories',[CategoryController::class,'all_categories'])->name('categories.index');
            // Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
            Route::get('/edit_category',[CategoryController::class,'edit'])->name('categories.edit');
            Route::post('/upate_category',[CategoryController::class,'update_category'])->name('categories.update');

            // ---Categories Route's End ---

    });
    
});