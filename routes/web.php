<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthController;
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
Route::middleware('auth.login')->group(function(){
    Route::prefix('')->group(function() {
        Route::post('', [AuthController::class, 'login'])->name('admin_login');
        Route::get('/', function () {
            return view('auth.login');
        })->name('login');
    });
});

Route::middleware('auth.admin')->group(function() {
    Route::prefix('/admin')->group(function() {
        Route::prefix('/user')->group(function() {
            Route::get('/', [UserController::class, 'index'])->name("user_list");
            Route::get('/create', [UserController::class, 'create'])->name("user_create");
            Route::post('/create', [UserController::class, 'store'])->name('user_store');
            Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('user_delete');
            Route::get('/{id}', [UserController::class, 'show'])->name('user_show');
            Route::post('/{id}', [UserController::class, 'update'])->name('user_update');
        });
        Route::get('logout', [AuthController::class, 'logout'])->name('user_logout');
    });


});
