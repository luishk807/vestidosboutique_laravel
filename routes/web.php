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
//Route::group(['middleware' => 'under-construction'], function () {
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
    Route::get("/signin",'userLoginController@index')->name("login_page");
    Route::post("/signin",'userLoginController@login')->name("login_user");
    Route::get("/logout",'userLoginController@logout')->name("logout_user");
    //Users
    Route::get("/account/new",'usersController@newUser')->name("newuser");
    Route::post("/account/new",'usersController@newUser')->name("createuser");
    Route::prefix("account")->group(function(){
        Route::get("/{user_id}",'usersController@index')->name("user_account");
        
        Route::get("/edit/{user_id}",'usersController@updateUser')->name("edituser");
        Route::post("/edit/{user_id}",'usersController@updateUser')->name("updateuser");

        Route::prefix("addresses")->group(function(){
            Route::get("/new/{user_id}",'userAddressController@newAddress')->name("newaddress");
            Route::post("/new/{user_id}",'userAddressController@newAddress')->name("createaddress");
            Route::get("/edit/{address_id}",'userAddressController@editAddress')->name("editaddress");
            Route::post("/edit/{address_id}",'userAddressController@editAddress')->name("updateaddress");
            Route::get('/confirm/{address_id}','userAddressController@deleteAddress')->name('confirmaddress');
            Route::delete('/confirm/{address_id}','userAddressController@deleteAddress')->name('deleteaddress');
        });

        Route::prefix("wishlists")->group(function(){
            Route::get("/{user_id}",'userwishlistController@index')->name("user_wishlists");
            Route::get("/view/{wishlist_id}",'userwishlistController@viewwishlist')->name("view_wishlist");
            Route::get('/confirm/{wishlist_id}','userwishlistController@deletewishlist')->name('confirmwishlist');
            Route::delete('/confirm/{wishlist_id}','userwishlistController@deletewishlist')->name('deletewishlist');
        });

        Route::prefix("orders")->group(function(){
            Route::get("/{user_id}",'userOrderController@index')->name("user_orders");
            Route::get("/view/{order_id}",'userOrderController@viewOrder')->name("view_order");
            Route::get('/confirm/{order_id}','userOrderController@deleteOrder')->name('confirmorder');
            Route::delete('/confirm/{order_id}','userOrderController@deleteOrder')->name('deleteorder');
        });

    });
   // Route::middleware('auth')->group(function(){
        Route::prefix("admin")->group(function(){
            Route::get("/login","adminUserLoginController@index")->name("admin_show_login");
            Route::post("/login","adminUserLoginController@login")->name("admin_login");
            Route::get("/logout",'adminUserLoginController@logout')->name("admin_logout_user");

            Route::get('/','adminHomeController@home')->name("admin");

            //Admin Brands
            Route::prefix('brands')->group(function () {
                Route::get('/','adminBrandController@index')->name("admin_brands");
                Route::get('/confirm/{brand_id}','adminBrandController@deleteBrand')->name('confirm_brand');
                Route::delete('/confirm/{brand_id}','adminBrandController@deleteBrand')->name('delete_brand');
                Route::get('/new','adminBrandController@newBrands')->name('new_brand');
                Route::post('/new','adminBrandController@newBrands')->name('create_brand');
                Route::get('/edit/{brand_id}','adminBrandController@editBrand')->name('edit_brand');
                Route::post('/edit/{brand_id}','adminBrandController@editBrand')->name('save_brand');
            });
            //Admin Dress Types
            Route::prefix("dress_type")->group(function(){
                Route::get('/','adminDressTypesController@index')->name("admin_dresstypes");
                Route::get('/confirm/{dresstype_id}','adminDressTypesController@deleteDressType')->name('confirm_dresstype');
                Route::delete('/confirm/{dresstype_id}','adminDressTypesController@deleteDressType')->name('delete_dresstype');
                Route::get('/new','adminDressTypesController@newDressTypes')->name('new_dresstype');
                Route::post('/new','adminDressTypesController@newDressTypes')->name('create_dresstype');
                Route::get('/edit/{dresstype_id}','adminDressTypesController@editDressType')->name('edit_dresstype');
                Route::post('/edit/{dresstype_id}','adminDressTypesController@editDressType')->name('save_dresstype');
            });
            //Admin Dress Style
            Route::prefix("dress_style")->group(function(){
                Route::get('/','adminDressStylesController@index')->name("admin_dressstyles");
                Route::get('/confirm/{dressstyle_id}','adminDressStylesController@deleteDressStyle')->name('confirm_dressstyle');
                Route::delete('/confirm/{dressstyle_id}','adminDressStylesController@deleteDressStyle')->name('delete_dressstyle');
                Route::get('/new','adminDressStylesController@newDressStyles')->name('new_dressstyle');
                Route::post('/new','adminDressStylesController@newDressStyles')->name('create_dressstyle');
                Route::get('/edit/{dressstyle_id}','adminDressStylesController@editDressStyle')->name('edit_dressstyle');
                Route::post('/edit/{dressstyle_id}','adminDressStylesController@editDressStyle')->name('save_dressstyle');
            });
            //Admin Category
            Route::prefix("categories")->group(function(){
                Route::get('/','categoriesController@index')->name("admin_category");
                Route::get('/confirm/{category_id}','categoriesController@deletecategory')->name('confirm_category');
                Route::delete('/confirm/{category_id}','categoriesController@deletecategory')->name('delete_category');
                Route::get('/new','categoriesController@newcategories')->name('new_category');
                Route::post('/new','categoriesController@newcategories')->name('create_category');
                Route::get('/edit/{category_id}','categoriesController@editcategory')->name('edit_category');
                Route::post('/edit/{category_id}','categoriesController@editcategory')->name('save_category');
            });
            //Admin Closures
            Route::prefix("closures")->group(function(){
                Route::get('/','adminClosureController@index')->name("admin_closures");
                Route::get('/confirm/{closure_id}','adminClosureController@deleteClosure')->name('confirm_closure');
                Route::delete('/confirm/{closure_id}','adminClosureController@deleteClosure')->name('delete_closure');
                Route::get('/new','adminClosureController@newClosures')->name('new_closure');
                Route::post('/new','adminClosureController@newClosures')->name('create_closure');
                Route::get('/edit/{closure_id}','adminClosureController@editClosure')->name('edit_closure');
                Route::post('/edit/{closure_id}','adminClosureController@editClosure')->name('save_closure');
            });
            //Admin fit
            Route::prefix("fits")->group(function(){
                Route::get('/','adminFitController@index')->name("admin_fits");
                Route::get('/confirm/{fit_id}','adminFitController@deleteFit')->name('confirm_fit');
                Route::delete('/confirm/{fit_id}','adminFitController@deleteFit')->name('delete_fit');
                Route::get('/new','adminFitController@newFits')->name('new_fit');
                Route::post('/new','adminFitController@newFits')->name('create_fit');
                Route::get('/edit/{fit_id}','adminFitController@editFit')->name('edit_fit');
                Route::post('/edit/{fit_id}','adminFitController@editFit')->name('save_fit');
            });
            
             //Admin Fabric
             Route::prefix("fabrics")->group(function(){
                Route::get('/','adminFabricController@index')->name("admin_fabrics");
                Route::get('/confirm/{fabric_id}','adminFabricController@deleteFabric')->name('confirm_fabric');
                Route::delete('/confirm/{fabric_id}','adminFabricController@deleteFabric')->name('delete_fabric');
                Route::get('/new','adminFabricController@newFabric')->name('new_fabric');
                Route::post('/new','adminFabricController@newFabric')->name('create_fabric');
                Route::get('/edit/{fabric_id}','adminFabricController@editFabric')->name('edit_fabric');
                Route::post('/edit/{fabric_id}','adminFabricController@editFabric')->name('save_fabric');
            });
             //Admin Neckline
             Route::prefix("necklines")->group(function(){
                Route::get('/','adminNecklineController@index')->name("admin_necklines");
                Route::get('/confirm/{neckline_id}','adminNecklineController@deleteNeckline')->name('confirm_neckline');
                Route::delete('/confirm/{neckline_id}','adminNecklineController@deleteNeckline')->name('delete_neckline');
                Route::get('/new','adminNecklineController@newNeckline')->name('new_neckline');
                Route::post('/new','adminNecklineController@newNeckline')->name('create_neckline');
                Route::get('/edit/{neckline_id}','adminNecklineController@editNeckline')->name('edit_neckline');
                Route::post('/edit/{neckline_id}','adminNecklineController@editNeckline')->name('save_neckline');
            });
             //Admin Waistline
             Route::prefix("waistlines")->group(function(){
                Route::get('/','adminWaistlineController@index')->name("admin_waistlines");
                Route::get('/confirm/{waistline_id}','adminWaistlineController@deleteWaistline')->name('confirm_waistline');
                Route::delete('/confirm/{waistline_id}','adminWaistlineController@deleteWaistline')->name('delete_waistline');
                Route::get('/new','adminWaistlineController@newWaistline')->name('new_waistline');
                Route::post('/new','adminWaistlineController@newWaistline')->name('create_waistline');
                Route::get('/edit/{waistline_id}','adminWaistlineController@editWaistline')->name('edit_waistline');
                Route::post('/edit/{waistline_id}','adminWaistlineController@editWaistline')->name('save_waistline');
            });
            // //Admin Products
            Route::prefix("products")->group(function(){
                Route::get('/','adminProductController@index')->name("admin_products");
                Route::get('/confirm/{product_id}','adminProductController@deleteProduct')->name('confirm_product');
                Route::delete('/confirm/{product_id}','adminProductController@deleteProduct')->name('delete_product');
                Route::get('/new','adminProductController@newProducts')->name('new_product');
                Route::post('/new','adminProductController@newProducts')->name('create_product');
                Route::get('/edit/{product_id}','adminProductController@editProduct')->name('edit_product');
                Route::post('/edit/{product_id}','adminProductController@editProduct')->name('save_product');
                //Admin Color
                Route::prefix("colors")->group(function(){
                    Route::get('/{product_id}','adminColorController@index')->name("admin_colors");
                    Route::get('/confirm/{color_id}','adminColorController@deleteColor')->name('confirm_color');
                    Route::delete('/confirm/{color_id}','adminColorController@deleteColor')->name('delete_color');
                    Route::get('/new/{product_id}','adminColorController@newColors')->name('new_color');
                    Route::post('/new/{product_id}','adminColorController@newColors')->name('create_color');
                    Route::get('/edit/{color_id}','adminColorController@editColor')->name('edit_color');
                    Route::post('/edit/{color_id}','adminColorController@editColor')->name('save_color');
                });
                //Admin Size
                Route::prefix("sizes")->group(function(){
                    Route::get('/{product_id}','adminSizesController@index')->name("admin_sizes");
                    Route::get('/confirm/{size_id}','adminSizesController@deleteSize')->name('confirm_size');
                    Route::delete('/confirm/{size_id}','adminSizesController@deleteSize')->name('delete_size');
                    Route::get('/new/{product_id}','adminSizesController@newSizes')->name('new_size');
                    Route::post('/new/{product_id}','adminSizesController@newSizes')->name('create_size');
                    Route::get('/edit/{size_id}','adminSizesController@editSize')->name('edit_size');
                    Route::post('/edit/{size_id}','adminSizesController@editSize')->name('save_size');
                });
                //Admin Image
                Route::prefix("images")->group(function(){
                    Route::get('/{product_id}','adminProductImagesController@index')->name("admin_images");
                    Route::get('/confirm/{image_id}','adminProductImagesController@deleteImage')->name('confirm_image');
                    Route::delete('/confirm/{image_id}','adminProductImagesController@deleteImage')->name('delete_image');
                    Route::get('/new/{product_id}','adminProductImagesController@newImages')->name('new_image');
                    Route::post('/new/{product_id}','adminProductImagesController@newImages')->name('create_image');
                    Route::get('/edit/{image_id}','adminProductImagesController@editImage')->name('edit_image');
                    Route::post('/edit/{image_id}','adminProductImagesController@editImage')->name('save_image');
                });
                //Admin Rate
                Route::prefix("rates")->group(function(){
                    Route::get('/{product_id}','adminProductRatesController@index')->name("admin_rates");
                    Route::get('/confirm/{rate_id}','adminProductRatesController@deleteRate')->name('confirm_rate');
                    Route::delete('/confirm/{rate_id}','adminProductRatesController@deleteRate')->name('delete_rate');
                    Route::get('/new/{product_id}','adminProductRatesController@newRates')->name('new_rate');
                    Route::post('/new/{product_id}','adminProductRatesController@newRates')->name('create_rate');
                    Route::get('/edit/{rate_id}','adminProductRatesController@editRate')->name('edit_rate');
                    Route::post('/edit/{rate_id}','adminProductRatesController@editRate')->name('save_rate');
                });
            });
            //Admin Vendor
            Route::prefix("vendors")->group(function(){
                Route::get('/','vendorsController@index')->name("admin_vendors");
                Route::get('/new','vendorsController@newVendors')->name('new_vendor');
                Route::post('/new','vendorsController@newVendors')->name('create_vendor');
                Route::get('/edit/{vendor_id}','vendorsController@editVendor')->name('edit_vendor');
                Route::post('/edit/{vendor_id}','vendorsController@editVendor')->name('save_vendor');
                Route::get('/confirm/{vendor_id}','vendorsController@deleteVendor')->name('confirm_vendor');
                Route::delete('/confirm/{vendor_id}','vendorsController@deleteVendor')->name('delete_vendor');
            });
            //Admin Users
            Route::prefix("users")->group(function(){
                Route::get("/",'adminUsersController@index')->name("admin_users");
                Route::get("/new",'adminUsersController@newUser')->name("admin_newuser");
                Route::post("/new",'adminUsersController@newUser')->name("admin_createuser");
                Route::get("/edit/{user_id}",'adminUsersController@updateUser')->name("admin_edituser");
                Route::post("/edit/{user_id}",'adminUsersController@updateUser')->name("admin_updateuser");
                Route::get('/confirm/{user_id}','adminUsersController@deleteUser')->name('confirm_adminuser');
                Route::delete('/confirm/{user_id}','adminUsersController@deleteUser')->name('delete_adminuser');
                Route::prefix("addresses")->group(function(){
                    Route::get("/{user_id}",'adminUsersController@userAddress')->name("admin_address");
                    Route::get("/new/{user_id}",'adminUsersAddressController@newAddress')->name("admin_newaddress");
                    Route::post("/new/{user_id}",'adminUsersAddressController@newAddress')->name("admin_createaddress");
                    Route::get("/edit/{address_id}",'adminUsersAddressController@editAddress')->name("admin_editaddress");
                    Route::post("/edit/{address_id}",'adminUsersAddressController@editAddress')->name("admin_updateaddress");
                    Route::get('/confirm/{address_id}','adminUsersAddressController@deleteAddress')->name('confirm_adminaddress');
                    Route::delete('/confirm/{address_id}','adminUsersAddressController@deleteAddress')->name('delete_adminaddress');
                });
            });

            //Admin Orders
            Route::prefix("orders")->group(function(){
                Route::get('/','ordersController@index')->name("admin_orders");
                Route::get('/confirm/{order_id}','ordersController@deleteOrder')->name('confirm_order');
                Route::delete('/confirm/{order_id}','ordersController@deleteOrder')->name('delete_order');
                Route::get('/new','ordersController@newOrders')->name('new_order');
                Route::post('/new','ordersController@newOrders')->name('create_order');
                Route::get('/edit/{order_id}','ordersController@editOrder')->name('edit_order');
                Route::post('/edit/{order_id}','ordersController@editOrder')->name('save_order');
                Route::prefix("products")->group(function(){
                    Route::get('/{order_id}','ordersProductsController@index')->name("admin_order_products");
                    Route::get('/new/{order_id}','ordersProductsController@newOrderProducts')->name('new_order_products');
                    Route::post('/new/{order_id}','ordersProductsController@newOrderProducts')->name('create_order_products');
                    Route::get('/edit/{order_product_id}','ordersProductsController@editOrderProduct')->name('edit_order_products');
                    Route::post('/edit/{order_product_id}','ordersProductsController@editOrderProduct')->name('save_order_products');
                    Route::get('/confirm/{order_product_id}','ordersProductsController@deleteOrderProduct')->name('confirm_order_products');
                    Route::delete('/confirm/{order_product_id}','ordersProductsController@deleteOrderProduct')->name('delete_order_products');
                });
            });
        });
        

        //API
        Route::get('api/getAddress','ordersController@getAddressDropdown');
        Route::get('api/getProduct','ordersController@getProductDropdown');
        
        //  //Admin Users Address
        //  Route::get('/admin/useraddress/','userAddressController@index')->name("admin_useraddress");
        //  Route::get('/admin/useraddress/confirm/{useraddress_id}','userAddressController@deleteUserAddress')->name('confirm_useraddress');
        //  Route::delete('/admin/useraddress/confirm/{useraddress_id}','userAddressController@destroy')->name('delete_useraddress');
        //  Route::get('/admin/useraddress/new','userAddressController@newUsersAddress')->name('new_useraddress');
        //  Route::post('/admin/useraddress/new','userAddressController@newUsersAddress')->name('create_useraddress');
        //  Route::get('/admin/useraddress/edit/{useraddress_id}','userAddressController@editUserAddress')->name('edit_useraddress');
        //  Route::post('/admin/useraddress/edit/{useraddress_id}','userAddressController@editUserAddress')->name('save_useraddress');
        

   // });
   Auth::routes();
//});
Route::get('/generate/password',function(){
    return bcrypt("123456789");
});




