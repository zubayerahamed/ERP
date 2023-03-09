<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminLogoutController;
use App\Http\Controllers\admin\AdminRegisterController;
use App\Http\Controllers\admin\CategoryController;
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

/* 
|---------------------
| Admin routes - Start
|---------------------
*/

Route::prefix('admin')->group(function () {

    // Admin Registration
    Route::get('/register', [AdminRegisterController::class, 'adminRegisterPage'])->name('admin.register.form');
    Route::post('/register', [AdminRegisterController::class, 'doRegistration'])->name('admin.register');

    // Admin Login
    Route::get("/login", [AdminLoginController::class, 'adminLoginPage'])->name('admin.login.form');
    Route::post("/login", [AdminLoginController::class, 'doLogin'])->name('admin.login');

    // Admin middleware groups
    Route::middleware('admin')->group(function () {
        // Admin logout
        Route::get("/logout", [AdminLogoutController::class, 'doLogout'])->name('admin.logout');

        // Admin dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Category
        Route::get("/category", [CategoryController::class, 'index'])->name("category.page");
    });
});



/* 
|---------------------
| Front-end routes - Start
|---------------------
*/
Route::get('/', function () {
    return view('home');
});
