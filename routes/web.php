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
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get("/signin",'usersController@login')->name("signin");
    Route::post("/signin",'usersController@login')->name("login");
   // Route::middleware('auth')->group(function(){
        Route::get('/admin','adminHomeController@home')->name("admin");
        //Admin Color
        Route::get('/admin/colors/','colorsController@index')->name("admin_colors");
        Route::get('/admin/colors/confirm/{color_id}','colorsController@deleteColor')->name('confirm_color');
        Route::delete('/admin/colors/confirm/{color_id}','colorsController@destroy')->name('delete_color');
        Route::get('/admin/colors/new','colorsController@newColors')->name('new_color');
        Route::post('/admin/colors/new','colorsController@newColors')->name('create_color');
        Route::get('/admin/colors/edit/{color_id}','colorsController@editColor')->name('edit_color');
        Route::post('/admin/colors/edit/{color_id}','colorsController@editColor')->name('save_color');
        //Admin Brands
        Route::get('/admin/brands/','adminBrandController@index')->name("admin_brands");
        Route::get('/admin/brands/confirm/{brand_id}','adminBrandController@deleteBrand')->name('confirm_brand');
        Route::delete('/admin/brands/confirm/{brand_id}','adminBrandController@destroy')->name('delete_brand');
        Route::get('/admin/brands/new','adminBrandController@newBrands')->name('new_brand');
        Route::post('/admin/brands/new','adminBrandController@newBrands')->name('create_brand');
        Route::get('/admin/brands/edit/{brand_id}','adminBrandController@editBrand')->name('edit_brand');
        Route::post('/admin/brands/edit/{brand_id}','adminBrandController@editBrand')->name('save_brand');
        //Admin Category
        Route::get('/admin/categories/','categoriesController@index')->name("admin_categories");
        Route::get('/admin/categories/confirm/{category_id}','categoriesController@deletecategory')->name('confirm_category');
        Route::delete('/admin/categories/confirm/{category_id}','categoriesController@destroy')->name('delete_category');
        Route::get('/admin/categories/new','categoriesController@newcategories')->name('new_category');
        Route::post('/admin/categories/new','categoriesController@newcategories')->name('create_category');
        Route::get('/admin/categories/edit/{category_id}','categoriesController@editcategory')->name('edit_category');
        Route::post('/admin/categories/edit/{category_id}','categoriesController@editcategory')->name('save_category');
        //Users
        Route::get("/account/new",'usersController@newUser')->name("newuser");
        Route::post("/account/new",'usersController@newUser')->name("createuser");
        Route::get("/account/edit",'usersController@updateUser')->name("edituser");
        Route::post("/account/edit",'usersController@updateUser')->name("updateuser");
        //Admin Users
        Route::post("/admin/users",'adminUsersController@updateUser')->name("admin_users");
         //Admin Users Address
         Route::get('/admin/useraddress/','userAddressController@index')->name("admin_useraddress");
         Route::get('/admin/useraddress/confirm/{useraddress_id}','userAddressController@deleteUserAddress')->name('confirm_useraddress');
         Route::delete('/admin/useraddress/confirm/{useraddress_id}','userAddressController@destroy')->name('delete_useraddress');
         Route::get('/admin/useraddress/new','userAddressController@newUsersAddress')->name('new_useraddress');
         Route::post('/admin/useraddress/new','userAddressController@newUsersAddress')->name('create_useraddress');
         Route::get('/admin/useraddress/edit/{useraddress_id}','userAddressController@editUserAddress')->name('edit_useraddress');
         Route::post('/admin/useraddress/edit/{useraddress_id}','userAddressController@editUserAddress')->name('save_useraddress');
        //Admin Products
        Route::get('/admin/products/','productController@index')->name("admin_products");
        Route::get('/admin/products/confirm/{product_id}','productController@deleteProduct')->name('confirm_product');
        Route::delete('/admin/products/confirm/{product_id}','productController@destroy')->name('delete_product');
        Route::get('/admin/products/new','productController@newProducts')->name('new_product');
        Route::post('/admin/products/new','productController@newProducts')->name('create_product');
        Route::get('/admin/products/edit/{product_id}','productController@editProduct')->name('edit_product');
        Route::post('/admin/products/edit/{product_id}','productController@editProduct')->name('save_product');
        //Admin Orders
        Route::get('/admin/orders/','ordersController@index')->name("admin_orders");
        Route::get('/admin/orders/confirm/{order_id}','ordersController@deleteOrder')->name('confirm_order');
        Route::delete('/admin/orders/confirm/{order_id}','ordersController@destroy')->name('delete_order');
        Route::get('/admin/orders/new','ordersController@newOrders')->name('new_order');
        Route::post('/admin/orders/new','ordersController@newOrders')->name('create_order');
        Route::get('/admin/orders/edit/{order_id}','ordersController@editOrder')->name('edit_order');
        Route::post('/admin/orders/edit/{order_id}','ordersController@editOrder')->name('save_order');
         //Admin Vendor
         Route::get('/admin/vendors/','vendorsController@index')->name("admin_vendors");
         Route::get('/admin/vendors/confirm/{vendor_id}','vendorsController@deleteVendor')->name('confirm_vendor');
         Route::delete('/admin/vendors/confirm/{vendor_id}','vendorsController@destroy')->name('delete_vendor');
         Route::get('/admin/vendors/new','vendorsController@newVendors')->name('new_vendor');
         Route::post('/admin/vendors/new','vendorsController@newVendors')->name('create_vendor');
         Route::get('/admin/vendors/edit/{vendor_id}','vendorsController@editVendor')->name('edit_vendor');
         Route::post('/admin/vendors/edit/{vendor_id}','vendorsController@editVendor')->name('save_vendor');
   // });
   // Auth::routes();
});
Route::get('/generate/password',function(){
    return bcrypt("123456789");
});




