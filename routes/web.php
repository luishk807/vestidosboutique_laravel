<?php

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
//     return view('welcome');
// });
Route::group(['middleware' => 'under-construction'], function () {
    // Route::get('/live-site', function() {
    //     echo 'content!';
    // });
    Route::get("/",function(){
        return view("home",['page_title'=>"Welcome Page"]);
    });
    Route::get("/about",function(){
        return view("about",['page_title'=>"About Us"]);
    });
    Route::get("/shop",function(){
        return view("/shop",['page_title'=>"Shop"]);
    });
    Route::get("/contact",function(){
        return view("contact",['page_title'=>"Contact Us"]);
    });
    Route::get("/product",function(){
        return view("product",['page_title'=>"Product"]);
    });
    Route::get("/cart",function(){
        return view("cart",['page_title'=>"Cart"]);
    });
    Route::get("/signin",function(){
        return view("/signin",['page_title'=>"Login"]);
    });
    Route::get('/home', 'HomeController@index')->name('home');
    Route::middleware('auth')->group(function(){
        Route::get('/admin','adminHomeController@home');
        Route::get('/admin/products','adminProductController@show')->name('products');
        Route::get('/admin/products/new','adminProductController@newProducts')->name('new_product');
        Route::post('/admin/products/new','adminProductController@createProducts');
    });
    Auth::routes();
});
// Route::get("/",function(){
//     return view("home");
// });
// Route::get("/about",function(){
//     return view("about");
// });
// Route::get("/shop",function(){
//     return view("/shop");
// });
// Route::get("/contact",function(){
//     return view("contact");
// });
// Route::get("/product",function(){
//     return view("product");
// });
Route::get('/generate/password',function(){
    return bcrypt("123456789");
});




