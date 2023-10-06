<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;

if(App::environment('development')){
    URL::forceScheme('https');
}
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
// User
Route::get('/', [HomeProductController::class, 'product']);
Route::get('/product_details/{product_id}', [HomeProductController::class, 'product_details']);
Route::get('/contact', [ContactController::class, 'contact']);
Route::get('/user_login', [HomeController::class, 'show_user_login']);
Route::get('/user_profile', [HomeController::class, 'show_user_profile']);
Route::get('/user_change_password', [HomeController::class, 'user_change_password']);
Route::post('/checklogin_user', [HomeController::class, 'checkLogin_user']);
Route::get('/logout_user', [HomeController::class, 'logout_user']);
Route::get('/user_register', [HomeController::class, 'show_user_register']);
Route::post('/save_user_register', [HomeController::class, 'save_user_register']);
Route::get('/list_receipt', [HomeController::class, 'listReceipt']);
Route::post('/change_password', [HomeController::class, 'changePassword']);
Route::get('/forget_password', [HomeController::class, 'show_forget_password']);
Route::post('/get_new_password', [HomeController::class, 'get_new_password']);
// Admin
Route::get('/admin_login', [AdminController::class, 'show_admin_login']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/checklogin', [AdminController::class, 'checklogin']);
Route::get('/print_warranty/{code}', [AdminController::class, 'print_warranty_pdf']);
Route::get('/print_receipt/{code}', [AdminController::class, 'print_receipt_pdf']);

//Receipt
Route::get('/admin_receipt', [AdminController::class, 'list_admin_receipt']);
Route::get('/edit_receipt/{receipt_id}', [AdminController::class, 'admin_editReceipt']);
Route::post('/update_receipt/{receipt_id}', [AdminController::class, 'admin_updateReceipt']);
Route::get('/delete_receipt/{receipt_id}', [AdminController::class, 'admin_deleteReceipt']);
Route::get('/cancel_receipt/{receipt_id}', [AdminController::class, 'cancel_receipt']);
Route::get('/confirm_receipt/{receipt_id}', [AdminController::class, 'confirm_receipt']);

//Warranty
Route::get('/show_warranty/{receipt_id}', [AdminController::class, 'show_warranty']);
Route::post('/save_warranty', [AdminController::class, 'add_warranty']);
Route::get('/list_warranty', [AdminController::class, 'list_warranty']);
Route::get('/edit_warranty/{warranty_id}', [AdminController::class, 'edit_warranty']);
Route::post('/update_warranty/{warranty_id}', [AdminController::class, 'update_warranty']);
Route::get('/delete_warranty/{warranty_id}', [AdminController::class, 'delete_warranty']);
Route::get('/user_warranty', [HomeController::class, 'show_user_warranty']);


//Category
Route::get('/add_category', [CategoryController::class, 'addCategory']);
Route::get('/list_category', [CategoryController::class, 'listCategory']);
Route::post('/save_category', [CategoryController::class, 'saveCategory']);
Route::get('/active_category/{category_id}', [CategoryController::class, 'activeCategory']);
Route::get('/unactive_category/{category_id}', [CategoryController::class, 'unactiveCategory']);
Route::get('/edit_category/{category_id}', [CategoryController::class, 'editCategory']);
Route::post('/update_category/{category_id}', [CategoryController::class, 'updateCategory']);
Route::get('/delete_category/{category_id}', [CategoryController::class, 'deleteCategory']);

//Brand
Route::get('/add_brand', [BrandController::class, 'addBrand']);
Route::get('/list_brand', [BrandController::class, 'listBrand']);
Route::post('/save_brand', [BrandController::class, 'saveBrand']);
Route::get('/active_brand/{brand_id}', [BrandController::class, 'activeBrand']);
Route::get('/unactive_brand/{brand_id}', [BrandController::class, 'unactiveBrand']);
Route::get('/edit_brand/{brand_id}', [BrandController::class, 'editBrand']);
Route::post('/update_brand/{brand_id}', [BrandController::class, 'updateBrand']);
Route::get('/delete_brand/{brand_id}', [BrandController::class, 'deleteBrand']);

//Product
Route::get('/add_product', [ProductController::class, 'addProduct']);
Route::get('/list_product', [ProductController::class, 'listProduct']);
Route::post('/save_product', [ProductController::class, 'saveProduct']);
Route::get('/active_product/{product_id}', [ProductController::class, 'activeProduct']);
Route::get('/unactive_product/{product_id}', [ProductController::class, 'unactiveProduct']);
Route::get('/edit_product/{product_id}', [ProductController::class, 'editProduct']);
Route::post('/update_product/{product_id}', [ProductController::class, 'updateProduct']);
Route::get('/delete_product/{product_id}', [ProductController::class, 'deleteProduct']);
Route::get('/search', [ProductController::class,'search']) -> name('search');

//Cart
Route::post('/add_cart', [CartController::class, 'addCart']);
Route::get('/show_cart', [CartController::class, 'showCart']);
Route::post('/update_cart', [CartController::class, 'updateCart']);
Route::get('/delete_cart/{session_id}', [CartController::class, 'deleteCart']);
Route::get('/delete_all_cart', [CartController::class, 'deleteAllCart']);
Route::post('/select_delivery_cart', [CartController::class, 'selectDeliveryCart']);
Route::post('/calculate_delivery', [CartController::class, 'calculateDelivery']);

//Checkout
Route::get('/show_checkout/{customer_id}', [CartController::class, 'showCheckout']);
Route::post('/save_receipt', [CartController::class, 'savereceipt']);
Route::get('/search-receipt', [AdminController::class, 'searchReceipt']);

//Admin_Customer
Route::get('/add_user', [AdminController::class, 'addUser']);
Route::post('/save_user', [AdminController::class, 'saveUser']);
Route::get('/list_user', [AdminController::class, 'listUser']);
Route::get('/edit_user/{customer_id}', [AdminController::class, 'editUser']);
Route::post('/update_user/{customer_id}', [AdminController::class, 'updateUser']);
Route::get('/delete_user/{customer_id}', [AdminController::class, 'deleteUser']);



