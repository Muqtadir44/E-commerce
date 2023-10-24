<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DashboardController;
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
    });
    
});