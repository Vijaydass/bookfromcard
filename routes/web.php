<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/',[HomeController::class,'index'])->name('home');
// Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/own-cms', function () {
    return view('admin.login');
});
Route::post('own-cms',[AdminController::class,'login'])->name('admin.login');

Route::get('own-cms/logout', function () {
    session()->forget('ADMIN_LOGIN');
    session()->forget('ADMIN_ID');
    session()->flash('error','logout successfully');
    return redirect('own-cms');
    });

// Auth::routes();
Route::group(['middleware'=>'admin_auth'],function(){
    Route::get('/own-cms/dashboard',[AdminController::class,'dashboard']);

    // Banks 
    Route::get('/own-cms/banks',[BankController::class,'index']);
    Route::post('/own-cms/bank/add',[BankController::class,'store'])->name('bank.insert');
    Route::get('/own-cms/bank/add', function () { return view('admin.bank.add');});
    Route::get('own-cms/bank/edit/{id}',[BankController::class,'edit_bank']);
    Route::post('own-cms/bank/update',[BankController::class,'update'])->name('upadte_bank.update');
    Route::get('own-cms/bank/delete/{id}',[BankController::class,'delete']);

    //Profile
    Route::get('/own-cms/profile',[AdminController::class,'profile']);
    Route::post('/own-cms/profile',[AdminController::class,'profile_update'])->name('profile_update');
    Route::post('/own-cms/change_password',[AdminController::class,'change_password'])->name('password_change');

    //Store
    Route::get('/own-cms/stores',[StoreController::class,'index']);
    Route::get('/own-cms/store/add', function () { return view('admin.store.add');});
    Route::post('/own-cms/store/add',[StoreController::class,'store'])->name('store.insert');
    Route::get('own-cms/store/edit/{id}',[StoreController::class,'edit_store']);
    Route::post('own-cms/store/update',[StoreController::class,'update'])->name('upadte_store.update');
    Route::get('own-cms/store/delete/{id}',[StoreController::class,'delete']);

    //Slider
    Route::get('/own-cms/sliders',[SliderController::class,'index']);
    Route::get('/own-cms/slider/add', function () { return view('admin.slider.add');});
    Route::post('/own-cms/slider/add',[SliderController::class,'store'])->name('slider.insert');
    Route::get('own-cms/slider/edit/{id}',[SliderController::class,'edit_store']);
    Route::post('own-cms/slider/update',[SliderController::class,'update'])->name('upadte_slider.update');
    Route::get('own-cms/slider/delete/{id}',[SliderController::class,'delete']);

    //Address
    Route::get('/own-cms/address',[ProductController::class,'address_index']);
    Route::get('/own-cms/address/add', function () { return view('admin.address.add_address');});
    Route::post('/own-cms/address/add',[ProductController::class,'store_address'])->name('address.insert');
    Route::get('own-cms/address/edit/{id}',[ProductController::class,'edit_address']);
    Route::post('own-cms/address/update',[ProductController::class,'update_address'])->name('upadte_address.update');
    Route::get('own-cms/address/delete/{id}',[ProductController::class,'delete_address']);

    //Products
    Route::get('/own-cms/products',[ProductController::class,'index']);
    Route::get('/own-cms/product/add',[ProductController::class,'create']);
    Route::post('/own-cms/product/add',[ProductController::class,'store'])->name('product.insert');
    Route::get('own-cms/product/edit/{id}',[ProductController::class,'edit']);
    Route::post('own-cms/product/update',[ProductController::class,'update'])->name('upadte_product.update');
    Route::get('own-cms/product/delete/{id}',[ProductController::class,'delete']);

    //Users
    Route::get('/own-cms/users',[AdminController::class,'user_list']);
    Route::get('/own-cms/users/order/{id}',[ProductController::class,'users_order_list']);
    Route::get('/own-cms/users/delete/{id}',[AdminController::class,'user_delete']);
    // Route::get('/own-cms/orders_user/{id}',[AdminController::class,'user_delete']);
    Route::get('/own-cms/orders',[ProductController::class,'order_list']);
    Route::get('/own-cms/orders/show/{id}',[ProductController::class,'order_view']);
});


Route::group(['middleware'=>'guest'],function(){    
    // Route::get('login',[AuthController::class,'index'])->name('login');
    Route::post('login',[AuthController::class,'login'])->name('login');
    // Route::post('login',[AuthController::class,'login'])->name('login')->middleware('throttle:2,1');
    Route::get('register/{referal_code?}',[AuthController::class,'register_view'])->name('register');
    Route::get('forget-password',function () { return view('forget_password');});
    Route::post('forget-password-otp',[AuthController::class,'password_forget_otp'])->name('password.otp_send');
    Route::post('forget-password-reset',[AuthController::class,'password_forget_reset'])->name('password.reset');
    Route::post('register',[AuthController::class,'register'])->name('register');
    Route::post('verifyemail',[AuthController::class,'verifyemail'])->name('verifyemail');
    Route::post('otp_resend',[AuthController::class,'otp_resend'])->name('otp_resend');
});

Route::group(['middleware'=>'auth'],function(){    
    Route::get('profile',[AuthController::class,'profile'])->name('profile');
    Route::get('user-orders',[AuthController::class,'user_orders']);
    Route::get('user-order/{id}',[AuthController::class,'user_single_order']);
    Route::post('single_order_update',[AuthController::class,'single_order_update'])->name('single_order_update.order');
    Route::get('refer_earn',[AuthController::class,'refer_earn']);
    Route::get('referral_user',[AuthController::class,'referral_user']);
    Route::post('profile',[AuthController::class,'profile_update'])->name('profile_update.user');
    Route::get('fullfill-order/{id}',[ProductController::class,'fullfill_order_view']);
    Route::post('fullfill-order',[ProductController::class,'fullfill_order'])->name('fullfill_order.store');
    Route::get('logout',[AuthController::class,'logout'])->name('user.logout');
});



Route::get('/cache', function () {
    Artisan::call('cache:clear');
});
Route::get('/link', function () {
    Artisan::call('storage:link');
});