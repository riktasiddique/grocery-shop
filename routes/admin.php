<?php

use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderProductController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WishListController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::get('check', function(){
    return 'checked';
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// DashboardController
Route::prefix('/')->middleware(['auth','is_block','is_admin'])->group(function () {

    Route::resource('/dashboard', DashboardController::class);
    // UserController
    Route::resource('/user', UserController::class);
    Route::get('/change-status/{user}', [UserController::class, 'changeStatus'])->name('user.change_status');
    Route::post('/change-role/{user}', [UserController::class, 'changeRole'])->name('user.change_role');
    // MainCategoriesController
    Route::resource('/main_category', MainCategoryController::class);
    // Route::put('/main_category/{main_category}', [MainCategoryController::class,'delete'])->name('delate');
    // SubCategoryController
    Route::resource('/sub-category', SubCategoryController::class);
    // ProductController
    Route::resource('/products', ProductController::class);
    // CartController
    Route::resource('cart', CartController::class);
    Route::post('add-cart/{product}', [CartController::class, 'addCart'])->name('product.cart');
    // WishList Controller
    Route::resource('wish-list', WishListController::class);
    Route::post('wish-listt/{product}', [WishListController::class, 'wishListStore'])->name('product.wish_list');
    // Shipping
    // Route::resource('shipping', ShippingConte)
    Route::resource('ordered_product', OrderProductController::class);
    // OrderStatus
    Route::get('order-status/{order}', [OrderController::class, 'orderStatus'])->name('order.status');
    Route::resource('order', OrderController::class);
});
