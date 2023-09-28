<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;

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
    Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
});

// Route::get('admin/login', [AdminLoginController::class, 'index']);