<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\HomeController;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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

Route::prefix('admin')->group(function () {
    Route::middleware(['admin.guest'])->group(function () {
        Route::get('login',[AdminLoginController::class,'index'])->name('admin.login');
        Route::post('authenticte',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
        
    });
    
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('dashboard',[HomeController::class,'index'])->name('admin.dashboard');
        Route::get('logout',[HomeController::class,'logout'])->name('admin.logout');
        
        Route::resource('category',CategoryController::class);

        //get-slug
        Route::get('/getSlug',function(Request $request){
            $slug = '';
            if(!empty($request->title)){
                $slug = Str::slug($request->title);
            }
            
            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);

        })->name('admin.getSlug');
    });
});

// Route::get('admin/login', [AdminLoginController::class, 'index']);