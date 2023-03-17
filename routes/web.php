<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminLogoutController;
use App\Http\Controllers\admin\AdminRegisterController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\ShopController;
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
        Route::get("/attribute/{attribute:slug}", [AttributeController::class, 'edit'])->name("attribute.edit");
        Route::put("/attribute/{attribute}", [AttributeController::class, 'update'])->name("attribute.update");
        Route::delete("/attribute/{slug}/trash", [AttributeController::class, 'trash'])->name("attribute.trash");
        Route::delete("/attribute/{slug}/delete", [AttributeController::class, 'delete'])->name("attribute.delete");

        // Term
        Route::get("/term/{attribute}", [TermController::class, 'index'])->name("term.page");
        Route::post("/term", [TermController::class, 'save'])->name("term.save");
        Route::get("/term/{slug}/edit", [TermController::class, 'edit'])->name("term.edit");
        Route::put("/term/{term}", [TermController::class, 'update'])->name("term.update");
        Route::delete("/term/{slug}/trash", [TermController::class, 'trash'])->name("term.trash");
        Route::delete("/term/{slug}/delete", [TermController::class, 'delete'])->name("term.delete");

        // Media
        Route::get('/media', [MediaController::class, 'index'])->name('media');
        Route::get('/media/add-new', [MediaController::class, 'addNewPage'])->name('media.add-new');
        Route::post("/media/save", [MediaController::class, 'save'])->name("media.save");

        // Business
        Route::get("/business", [BusinessController::class, 'index'])->name("business.page");
        Route::post("/business", [BusinessController::class, 'save'])->name("business.save");
        Route::get("/business/{business:slug}", [BusinessController::class, 'edit'])->name("business.edit");
        Route::put("/business/{business}", [BusinessController::class, 'update'])->name("business.update");
        Route::delete("/business/{business:slug}/trash", [BusinessController::class, 'trash'])->name("business.trash");
        Route::delete("/business/{business:slug}/delete", [BusinessController::class, 'delete'])->name("business.delete");

        // Outlet
        Route::get("/outlet/{business}", [OutletController::class, 'index'])->name("outlet.page");
        Route::post("/outlet", [OutletController::class, 'save'])->name("outlet.save");
        Route::get("/outlet/{outlet:slug}/edit", [OutletController::class, 'edit'])->name("outlet.edit");
        Route::put("/outlet/{outlet}", [OutletController::class, 'update'])->name("outlet.update");
        Route::delete("/outlet/{outlet:slug}/trash", [OutletController::class, 'trash'])->name("outlet.trash");
        Route::delete("/outlet/{outlet:slug}/delete", [OutletController::class, 'delete'])->name("outlet.delete");

        // Shop
        Route::get("/shop/{outlet}", [ShopController::class, 'index'])->name("shop.page");
        Route::post("/shop", [ShopController::class, 'save'])->name("shop.save");
        Route::get("/shop/{shop:slug}/edit", [ShopController::class, 'edit'])->name("shop.edit");
        Route::put("/shop/{shop}", [ShopController::class, 'update'])->name("shop.update");
        Route::delete("/shop/{shop:slug}/trash", [ShopController::class, 'trash'])->name("shop.trash");
        Route::delete("/shop/{shop:slug}/delete", [ShopController::class, 'delete'])->name("shop.delete");

        // Counter
        Route::get("/counter/{shop}", [CounterController::class, 'index'])->name("counter.page");
        Route::post("/counter", [CounterController::class, 'save'])->name("counter.save");
        Route::get("/counter/{counter:slug}/edit", [CounterController::class, 'edit'])->name("counter.edit");
        Route::put("/counter/{counter}", [CounterController::class, 'update'])->name("counter.update");
        Route::delete("/counter/{counter:slug}/trash", [CounterController::class, 'trash'])->name("counter.trash");
        Route::delete("/counter/{counter:slug}/delete", [CounterController::class, 'delete'])->name("counter.delete");
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
