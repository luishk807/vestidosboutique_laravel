<?php

use Illuminate\Http\Request;

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
Route::get("/saveWishlist",'userWishlistController@addWishlist');
Route::get("/updateCart",'userCartController@cart_save');
Route::get("/deleteCart",'userCartController@cart_delete');
Route::get('/getAddress','ordersController@getAddressDropdown');
Route::get('/getProduct','ordersController@getProductDropdown');
Route::get("/loadStates",'homeController@loadStatesDrop');
Route::get("/loadDistricts",'homeController@loadDistrictsDrop');
Route::get("/loadCorregimientos",'homeController@loadCorregimientosDrop');
Route::get("/loadColors",'homeController@loadColor');
Route::get("/loadSizes",'homeController@loadColorSizes');
Route::get("/loadProdQuantity",'homeController@loadProdQuantity');
Route::get("/loadProdQuantityArray",'homeController@loadProdQuantityData');
Route::get("/loadSizeInfo",'homeController@loadSizeInfo');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
