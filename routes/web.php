<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminLogoutController;
use App\Http\Controllers\admin\AdminRegisterController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\TermController;
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
        Route::post("/category", [CategoryController::class, 'save'])->name("category.save");
        Route::get("/category/{slug}", [CategoryController::class, 'edit'])->name("category.edit");
        Route::put("/category/{category}", [CategoryController::class, 'update'])->name("category.update");
        Route::delete("/category/{slug}", [CategoryController::class, 'delete'])->name("category.delete");
        Route::post('/category/image/{category}', [CategoryController::class, 'updateImage'])->name('category.image');

        // Product
        Route::get("/products", [ProductController::class, 'index'])->name("product.list");
        Route::get("/product/add-new", [ProductController::class, 'addNewPage'])->name("product.add-new");
        Route::post("/product/save", [ProductController::class, 'save'])->name("product.save");
        Route::get("/product/{product}/edit", [ProductController::class, 'edit'])->name("product.edit");
        Route::put("/product/{product}/update", [ProductController::class, 'update'])->name("product.update");
        Route::delete("/product/{product}/trash", [ProductController::class, 'trash'])->name("product.trash");
        Route::delete("/product/{product}/delete", [ProductController::class, 'delete'])->name("product.delete");

        // Attribute
        Route::get("/attribute", [AttributeController::class, 'index'])->name("attribute.page");
        Route::post("/attribute", [AttributeController::class, 'save'])->name("attribute.save");
        Route::get("/attribute/{slug}", [AttributeController::class, 'edit'])->name("attribute.edit");
        Route::put("/attribute/{attribute}", [AttributeController::class, 'update'])->name("attribute.update");
        Route::delete("/attribute/{slug}/trash", [AttributeController::class, 'trash'])->name("attribute.trash");
        Route::delete("/attribute/{slug}/delete", [AttributeController::class, 'delete'])->name("attribute.delete");
    
        // Term
        Route::get("/term/{attribute}", [TermController::class, 'index'])->name("term.page");
        Route::post("/term", [TermController::class, 'save'])->name("term.save");
        Route::get("/term/{slug}", [TermController::class, 'edit'])->name("term.edit");
        Route::put("/term/{term}", [TermController::class, 'update'])->name("term.update");
        Route::delete("/term/{slug}/trash", [TermController::class, 'trash'])->name("term.trash");
        Route::delete("/term/{slug}/delete", [TermController::class, 'delete'])->name("term.delete");
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
