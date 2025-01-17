<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;


use Illuminate\Support\Facades\Auth;

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

Auth::routes();



// <!--==========================================  (HOME)  ========================================================================================================================-->


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [HomeController::class, 'index']);


// <!--==========================================  (Dashboard)  ============================================================================================================================-->

Route::get('/dashboard', [ChartController::class, 'index'])->middleware(['auth' , 'manager'])->name('dashboard');



// <!--==========================================  (Users)  ===============================================================================================================-->
Route::resource('users', UserController::class)->middleware(['auth' , 'manager']);




// <!--==========================================  (profile)  ===============================================================================================================-->
Route::get('/profile_dashboard', [UserController::class, 'show_profile_dash'])->name('profile_dash.show')->middleware(['auth' , 'role']);
Route::put('/profile_dash_edit', [UserController::class, 'update_profile_dash'])->name('profile_dash.update')->middleware(['auth' , 'role']);


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [UserController::class, 'update_profile'])->name('profile.update');
    Route::get('/order-details/{id}', [OrderController::class, 'getOrderDetails'])->name('order.details');
});




// <!--==========================================  (contacts)  ===============================================================================================================-->
Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index'); 
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show'); 
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy'); 
});


// Public routes
Route::get('/contact', [ContactController::class, 'landing'])->name('contact.landing');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');



// <!--==========================================  (Categories)  =================================================================================================================-->
Route::resource('categories', CategoryController::class)->middleware(['auth' , 'role']);





// <!--==========================================  (Sub Categories)  =================================================================================================================-->
Route::resource('subCategories', SubCategoryController::class)->middleware(['auth' , 'role']);




// <!--==========================================  (Products)  ===================================================================================================================-->
Route::resource('products', ProductController::class)->middleware(['auth' , 'role']);
Route::delete('/product_images/{product_image}', [productImageController::class, 'destroy'])->name('product_images.destroy')->middleware(['auth' , 'role']);
Route::get('/product_details/{id}',[ProductController::class, 'show_user_side'])->name("product_details");


// <!--==========================================  (Store)  ===================================================================================================================-->
Route::get('/subcategory/{id}', [ProductController::class, 'productsBySubCategory'])->name('products.bySubCategory');
Route::get('/category/{id}', [ProductController::class, 'productsByCategory'])->name('products.byCategory');
Route::get('/subcategory/{id}/filter', [ProductController::class, 'productsBySubCategory'])->name('products.filterSubCategory');
Route::get('/category/{id}/filter', [ProductController::class, 'productsByCategory'])->name('products.filterCategory');


// <!--==========================================  (Cart)  ===================================================================================================================-->
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/delete/{product_id}', [CartController::class, 'deleteCartItem'])->name('cart.delete');

Route::post('cart/clear', [CartController::class, 'clear'])->name('cart.clear');




// <!--==========================================  (Orders)  ===================================================================================================================-->
Route::middleware(['auth', 'role'])->group(function () {
    Route::Get('/order' ,[OrderController::class , 'index'])->name('order.index');
    Route::Get('/order/{order}' ,[OrderController::class , 'show'])->name('order.show');
    Route::get('/order/{order}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::put('/order/{order}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
});


// Public routes
Route::Get('/checkoutView', [OrderController::class, 'create'])->name('order.create');
Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');



// Route::get('/test', function () {
//     return view('dashboard.chart.chart');
// })->name('test');