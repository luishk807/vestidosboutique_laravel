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
    Route::get("/contact","contactController@index")->name("viewContactPage");
    Route::post("/contact","contactController@sendEmail")->name("sendEmail");
    Route::get("/product",function(){
        return view("product",['page_title'=>"Product"]);
    });
    Route::get("/cart",function(){
        return view("cart",['page_title'=>"Cart"]);
    });
    Route::get("/signin",'clientController@login')->name("signin");
    Route::post("/signin",'clientController@login')->name("login");
    // Client Section
    Route::get("/account/new",'clientController@newClient')->name("newclient");
    Route::post("/account/new",'clientController@newClient')->name("createclient");
    Route::get("/account/edit",'clientController@updateClient')->name("editclient");
    Route::post("/account/edit",'clientController@updateClient')->name("updateclient");
    //end of client
    Route::get('/home', 'HomeController@index')->name('home');
   // Route::middleware('auth')->group(function(){
        Route::get('/admin','adminHomeController@home');
        Route::get('/admin/brands/','adminBrandController@index')->name("brands");
        Route::get('/admin/brands/new','adminBrandController@newBrands')->name('new_brand');
        Route::post('/admin/brands/new','adminBrandController@newBrands')->name('create_brand');
        Route::get('/admin/brands/edit/{brand_id}','adminBrandController@editBrand')->name('edit_brand');
        Route::post('/admin/brands/edit/{brand_id}','adminBrandController@editBrand')->name('save_brand');
   // });
   // Auth::routes();
});
Route::get('/generate/password',function(){
    return bcrypt("123456789");
});




