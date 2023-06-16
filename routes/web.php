<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

//Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/tables', [App\Http\Controllers\HomeController::class, 'tables'])->name('tables');
Route::get('/add_table', [App\Http\Controllers\HomeController::class, 'add_table'])->name('add_table');

Route::get('/edit_table/{id}', [App\Http\Controllers\HomeController::class, 'edit_table'])->name('edit_table');

Route::get('/product', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::get('/add_product', [App\Http\Controllers\HomeController::class, 'add_product'])->name('add_product');

Route::get('/edit_product/{id}', [App\Http\Controllers\HomeController::class, 'edit_product'])->name('edit_product');


Route::get('/edit_restaurant/{id}', [App\Http\Controllers\HomeController::class, 'edit_restaurant'])->name('edit_restaurant');

Route::get('/currentorders', [App\Http\Controllers\HomeController::class, 'currentorders'])->name('currentorders');

Route::get('/addorder', [App\Http\Controllers\HomeController::class, 'addorder'])->name('addorder');

Route::get('/orders_billed', [App\Http\Controllers\HomeController::class, 'orders_billed'])->name('orders_billed');

Route::get('/orders_details/{id}', [App\Http\Controllers\HomeController::class, 'orders_details'])->name('orders_details');


Route::get('/restaurants', [App\Http\Controllers\HomeController::class, 'restaurants'])->name('restaurants');

Route::get('/category', [App\Http\Controllers\HomeController::class, 'category'])->name('category');

Route::get('/section', [App\Http\Controllers\HomeController::class, 'section'])->name('section');


Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
Route::get('/add_user', [App\Http\Controllers\HomeController::class, 'add_user'])->name('add_user');
Route::get('/edit_user/{id}', [App\Http\Controllers\HomeController::class, 'edit_user'])->name('edit_user');

Route::get('/customers', [App\Http\Controllers\HomeController::class, 'customers'])->name('customers');


//Customer Routes
Route::get('/customerlogin/{resid}/{id}', [App\Http\Controllers\CustomerController::class, 'customerlogin'])->name('customerlogin');

Route::post('/checkCustomerlogin', [App\Http\Controllers\CustomerController::class, 'checkCustomerlogin'])->name('checkCustomerlogin');


Route::get('/menu', [App\Http\Controllers\CustomerController::class, 'menu'])->name('menu');

Route::get('/cart', [App\Http\Controllers\CustomerController::class, 'cart'])->name('cart');

Route::get('/checkout', [App\Http\Controllers\CustomerController::class, 'checkout'])->name('checkout');

Route::get('/home', [App\Http\Controllers\CustomerController::class, 'home'])->name('home');
