<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('sendotp', [App\Http\Controllers\ApiController::class, 'sendotp'])->name('sendotp');

Route::post('verifyotp', [App\Http\Controllers\ApiController::class, 'verifyotp'])->name('verifyotp');

Route::post('get_seller_details', [App\Http\Controllers\ApiController::class, 'get_seller_details'])->name('get_seller_details');

Route::post('save_seller_details', [App\Http\Controllers\ApiController::class, 'save_seller_details'])->name('save_seller_details');

Route::post('list_table', [App\Http\Controllers\ApiController::class, 'list_table'])->name('list_table');

Route::post('save_table', [App\Http\Controllers\ApiController::class, 'save_table'])->name('save_table');

Route::post('get_table', [App\Http\Controllers\ApiController::class, 'get_table'])->name('get_table');

Route::post('delete_table', [App\Http\Controllers\ApiController::class, 'delete_table'])->name('delete_table');

Route::post('update_table', [App\Http\Controllers\ApiController::class, 'update_table'])->name('update_table');

Route::post('list_product', [App\Http\Controllers\ApiController::class, 'list_product'])->name('list_product');

Route::post('save_product', [App\Http\Controllers\ApiController::class, 'save_product'])->name('save_product');

Route::post('get_product', [App\Http\Controllers\ApiController::class, 'get_product'])->name('get_product');

Route::post('delete_product', [App\Http\Controllers\ApiController::class, 'delete_product'])->name('delete_product');

Route::post('update_product', [App\Http\Controllers\ApiController::class, 'update_product'])->name('update_product');

Route::post('list_order', [App\Http\Controllers\ApiController::class, 'list_order'])->name('list_order');

Route::post('order_details', [App\Http\Controllers\ApiController::class, 'order_details'])->name('order_details');

Route::post('order_item_status', [App\Http\Controllers\ApiController::class, 'order_item_status'])->name('order_item_status');

Route::post('seller_list', [App\Http\Controllers\ApiController::class, 'seller_list'])->name('seller_list');

Route::post('country_list', [App\Http\Controllers\ApiController::class, 'country_list'])->name('country_list');
Route::post('state_list', [App\Http\Controllers\ApiController::class, 'state_list'])->name('state_list');
Route::post('city_list', [App\Http\Controllers\ApiController::class, 'city_list'])->name('city_list');
Route::post('currency_list', [App\Http\Controllers\ApiController::class, 'currency_list'])->name('currency_list');

Route::post('list_seller', [App\Http\Controllers\ApiController::class, 'list_seller'])->name('list_seller');
Route::post('delete_seller', [App\Http\Controllers\ApiController::class, 'delete_seller'])->name('delete_seller');
Route::post('update_seller_status', [App\Http\Controllers\ApiController::class, 'update_seller_status'])->name('update_seller_status');

Route::post('approve_order', [App\Http\Controllers\ApiController::class, 'approve_order'])->name('approve_order');

Route::post('reject_order', [App\Http\Controllers\ApiController::class, 'reject_order'])->name('reject_order');

Route::get('approve_order_email/{id}', [App\Http\Controllers\ApiController::class, 'approve_order_email'])->name('approve_order_email');

Route::get('reject_order_email/{id}', [App\Http\Controllers\ApiController::class, 'reject_order_email'])->name('reject_order_email');


Route::post('list_users', [App\Http\Controllers\ApiController::class, 'list_users'])->name('list_users');

Route::post('getroles', [App\Http\Controllers\ApiController::class, 'getroles'])->name('getroles');

Route::post('save_user', [App\Http\Controllers\ApiController::class, 'save_user'])->name('save_user');

Route::post('update_user', [App\Http\Controllers\ApiController::class, 'update_user'])->name('update_user');

Route::post('get_user', [App\Http\Controllers\ApiController::class, 'get_user'])->name('get_user');

Route::post('get_currency', [App\Http\Controllers\ApiController::class, 'get_currency'])->name('get_currency');

Route::post('dashboard_count', [App\Http\Controllers\ApiController::class, 'dashboard_count'])->name('dashboard_count');

Route::post('top_seller', [App\Http\Controllers\ApiController::class, 'top_seller'])->name('top_seller');



Route::post('list_category', [App\Http\Controllers\ApiController::class, 'list_category'])->name('list_category');

Route::post('save_category', [App\Http\Controllers\ApiController::class, 'save_category'])->name('save_category');

Route::post('get_category', [App\Http\Controllers\ApiController::class, 'get_category'])->name('get_category');

Route::post('delete_category', [App\Http\Controllers\ApiController::class, 'delete_category'])->name('delete_category');

Route::post('update_category', [App\Http\Controllers\ApiController::class, 'update_category'])->name('update_category');

Route::post('list_section', [App\Http\Controllers\ApiController::class, 'list_section'])->name('list_section');

Route::post('save_section', [App\Http\Controllers\ApiController::class, 'save_section'])->name('save_section');

Route::post('get_section', [App\Http\Controllers\ApiController::class, 'get_section'])->name('get_section');

Route::post('delete_section', [App\Http\Controllers\ApiController::class, 'delete_section'])->name('delete_section');

Route::post('update_section', [App\Http\Controllers\ApiController::class, 'update_section'])->name('update_section');


Route::post('list_currentorder', [App\Http\Controllers\ApiController::class, 'list_currentorder'])->name('list_currentorder');

Route::post('list_billorder', [App\Http\Controllers\ApiController::class, 'list_billorder'])->name('list_billorder');

Route::post('list_customer', [App\Http\Controllers\ApiController::class, 'list_customer'])->name('list_customer');

Route::post('get_orderstatus', [App\Http\Controllers\ApiController::class, 'get_orderstatus'])->name('get_orderstatus');

Route::post('update_orderstatus', [App\Http\Controllers\ApiController::class, 'update_orderstatus'])->name('update_orderstatus');

Route::post('menufilter', [App\Http\Controllers\ApiController::class, 'menufilter'])->name('menufilter');

//Customer APIS
Route::post('menu', [App\Http\Controllers\ApiController::class, 'menu'])->name('menu');

Route::post('addcart', [App\Http\Controllers\ApiController::class, 'addcart'])->name('addcart');

Route::post('getcart', [App\Http\Controllers\ApiController::class, 'getcart'])->name('getcart');

Route::post('getcartCount', [App\Http\Controllers\ApiController::class, 'getcartCount'])->name('getcartCount');

Route::post('updatecart', [App\Http\Controllers\ApiController::class, 'updatecart'])->name('updatecart');

Route::post('deletecart', [App\Http\Controllers\ApiController::class, 'deletecart'])->name('deletecart');

Route::post('customer_register', [App\Http\Controllers\ApiController::class, 'customer_register'])->name('customer_register');

Route::post('customer_login', [App\Http\Controllers\ApiController::class, 'customer_login'])->name('customer_login');

Route::post('customerotp', [App\Http\Controllers\ApiController::class, 'customerotp'])->name('customerotp');

Route::post('generatebill', [App\Http\Controllers\ApiController::class, 'generatebill'])->name('generatebill');

