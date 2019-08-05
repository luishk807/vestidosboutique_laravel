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

//Route::group(['middleware' => 'under-construction'], function () {
    // Route::get('/live-site', function() {
    //     echo 'content!';
    // });
    Route::get("/",'homeController@index')->name("home_page");
    Route::get("/about",'homeController@about')->name("about_page");
    Route::get("/shop/{type?}/{id?}",'userShopController@index')->name("shop_page");
    // Route::get("/shop_sort",'userShopController@sort_page')->name("shop_sort");
    Route::post("/shop_sort",'userShopController@sort_page_submit')->name("shop_sort_check");
    Route::get("/product/{product_id}",'homeController@product')->name("product_page");
    Route::post("/product/{product_id}",'userCartController@addToCart')->name("add_cart");
    Route::get("/contact","homeController@contact")->name("viewContactPage");
    Route::post("/contact","homeController@sendEmail")->name("sendEmail");
    Route::get("/terms-use","homeController@termsuse")->name("terms_use");
    Route::get("/privacy-use","homeController@privacyuse")->name("privacy_use");
    Route::get("/set_lang/{lang}",'homeController@setLocale')->name("set_language");

    Route::get("/cart",'userCartController@index')->name("cart_page");
    Route::prefix("checkout")->middleware("auth:vestidosUsers")->group(function(){
        Route::get("/checkout",'userPaymentController@showBilling')->name("checkout_checkout_page");
        Route::get("/payment/process",'userPaymentController@process')->name("checkout_payment_process");
        Route::get("/shipping",'userPaymentController@showShipping')->name("checkout_show_shipping");
        Route::post("/save_shipping",'userPaymentController@saveShipping')->name("checkout_save_shipping");
        Route::get("/billing",'userPaymentController@showBilling')->name("checkout_show_billing");
        Route::post("/save_billing",'userPaymentController@processPayment')->name("checkout_save_billing");
        Route::get("/orderconfirmed",'userPaymentController@showOrderReceived')->name("checkout_order_received");
    });


    Route::get("/signin",'homeController@signin')->name("login_page");
    Route::post("/signin",'homeController@login')->name("login_user");
    Route::get("/logout",'homeController@logout')->name("logout_user");

    //confirmation pages for redirections
    Route::get("/thankyou/account","userConfirmationController@accountCreationConfirm")->name("account_create_confirmed");
    Route::get("/thankyou/logout","userConfirmationController@logoutConfirm")->name("logout_confirmation");
    Route::get("/orderreceived","userConfirmationController@orderCreationCreated")->name("order_received_confirmation");
    Route::get("/resetpasswordsent","userConfirmationController@resetPasswordSent")->name("forgot_password_confirm_sent");
    Route::get("/account/activateconfirmation","userConfirmationController@accountActivationConfirmation")->name('user_account_activation_confirmed');
    Route::get("/account/resendactivateconfirmation","userConfirmationController@resendaccountActivationConfirmation")->name('user_account_activation_confirmed_resend');
    //Users
    Route::get("/account/new",'usersController@viewNewUser')->name("newuser");
    Route::post("/account/new",'usersController@newUser')->name("createuser");
    Route::get("/password/forgot",'usersController@ShowSendPasswordResetForm')->name('show_send_reset_password');
    Route::get("/account/activate/{token}",'usersController@activeUserAccount')->name('active_user_account');
    Route::get("/account/showresendactivation",'usersController@ShowResendActiveUserAccount')->name('show_resend_active_user_account');
    Route::post("/account/resendactivation",'usersController@ResendActiveUserAccount')->name('resend_active_user_account');
    Route::get("/confirmation",'usersController@ShowSendPasswordResetForm')->name('show_send_reset_password');
    Route::post("/password/forgot",'usersController@SendResetPasswordEmail')->name('send_reset_password_email');
    Route::get('/password/reset/show/{token}','usersController@showPasswordResetForm')->name('show_reset_password');
    Route::post('/password/reset/save','usersController@resetpassword')->name('reset_password');
    Route::prefix("account")->middleware("auth:vestidosUsers")->group(function(){
        Route::get("/",'usersController@index')->name("user_account");
        
        Route::get("/edit",'usersController@updateUser')->name("edituser");
        Route::post("/edit",'usersController@updateUser')->name("updateuser");

        Route::prefix("addresses")->group(function(){
            Route::get("/new",'userAddressController@newAddress')->name("newaddress");
            Route::post("/new",'userAddressController@newAddress')->name("createaddress");
            Route::get("/edit/{address_id}",'userAddressController@editAddress')->name("editaddress");
            Route::post("/edit/{address_id}",'userAddressController@editAddress')->name("updateaddress");
            Route::get('/confirm/{address_id}','userAddressController@deleteAddress')->name('confirmaddress');
            Route::delete('/confirm/{address_id}','userAddressController@deleteAddress')->name('deleteaddress');
        });

        Route::prefix("wishlists")->group(function(){
            Route::get("/",'userWishlistController@index')->name("user_wishlists");
            Route::get('/delete/{wishlist_id}','userWishlistController@deleteWishlist')->name('deletewishlist');
        });

        Route::prefix("reviews")->group(function(){
            Route::get("/",'userProductRateController@index')->name("user_review");
            Route::get('/new/{product_id}','userProductRateController@newReview')->name('user_new_review');
            Route::post('/create/{product_id}','userProductRateController@createReview')->name('user_create_review');
            Route::get('/edit/{review_id}','userProductRateController@editReview')->name('user_edit_review');
            Route::post('/save/{review_id}','userProductRateController@saveReview')->name('user_save_review');
        });

        Route::prefix("orders")->group(function(){
            Route::get("/",'userOrderController@index')->name("user_orders");
            Route::get("/view/{order_id}",'userOrderController@viewOrder')->name("view_order");
            Route::get('/confirm/{order_id}','userOrderController@showCancelIndex')->name('confirm_order_cancel');
            Route::post('/confirm/{order_id}','userOrderController@deleteOrder')->name('delete_order');
        });

    });
   // Route::middleware('auth')->group(function(){
        Route::get("/admin/login","adminHomeController@signin")->name("admin_show_login");
        Route::post("/admin/login","adminHomeController@login")->name("admin_login");
        Route::get("/admin/logout",'adminHomeController@logout')->name("admin_logout_user");

        Route::middleware('roleCheck')->group(function(){
            //Admin Account
            Route::prefix("admin")->group(function(){
                Route::get('/clear_cache',"adminHomeController@cacheClear")->name("cache_cleared");
                Route::get('/','adminHomeController@home')->name("admin");
                Route::prefix("account")->group(function(){
                    Route::get("/edit",'adminUsersController@showUpdateAdmin')->name("admin_editadmin");
                    Route::post("/edit",'adminUsersController@updateAdmin')->name("admin_updateadmin");
                });
                // Admin Main Configuration
                Route::get('/show_home_config','adminHomeConfigController@home')->name("admin_home_config");
                Route::post('/save_home_config','adminHomeConfigController@saveHomeConfig')->name("admin_home_config_save");
                 //Admin AdminProductType
                 Route::prefix("product_types")->group(function(){
                    Route::get('/','adminProductTypesController@index')->name("admin_product_types");
                    Route::get('/confirm/{product_type_id}','adminProductTypesController@deleteproduct_type')->name('confirm_product_type');
                    Route::delete('/confirm/{product_type_id}','adminProductTypesController@deleteproduct_type')->name('delete_product_type');
                    Route::get('/new','adminProductTypesController@newproduct_types')->name('new_product_type');
                    Route::post('/new','adminProductTypesController@newproduct_types')->name('create_product_type');
                    Route::get('/edit/{product_type_id}','adminProductTypesController@editproduct_type')->name('edit_product_type');
                    Route::post('/edit/{product_type_id}','adminProductTypesController@editproduct_type')->name('save_product_type');
                    Route::get('/import','adminProductTypesController@showImportProductType')->name('show_import_product_type');
                    Route::post('/import','adminProductTypesController@saveImportProductType')->name('save_import_product_type');
                     Route::post('/confirm_product_types','adminProductTypesController@deleteConfirmProductTypes')->name('confirm_delete_product_types');
                    Route::delete('/show_confirm_product_types','adminProductTypesController@deleteProductTypes')->name('delete_product_types');
                });
                //Admin Products
                Route::prefix("products")->group(function(){
                    Route::get('/','adminProductController@index')->name("admin_products");
                    Route::get('/confirm/{product_id}','adminProductController@deleteProduct')->name('confirm_product');
                    Route::delete('/confirm/{product_id}','adminProductController@deleteProduct')->name('delete_product');
                    Route::post('/confirm_products','adminProductController@deleteConfirmProducts')->name('confirm_delete_products');
                    Route::delete('/show_confirm_products','adminProductController@deleteProducts')->name('delete_products');
                    Route::get('/new','adminProductController@newProducts')->name('new_product');
                    Route::post('/create','adminProductController@createProduct')->name('create_product');
                    Route::get('/edit/{product_id}','adminProductController@editProduct')->name('edit_product');
                    Route::post('/save/{product_id}','adminProductController@saveProduct')->name('save_product');
                    Route::get('/import','adminProductController@showImportProduct')->name('show_import_product');
                    Route::post('/import','adminProductController@saveImportProduct')->name('save_import_product');
                    Route::get('/import_confirm','adminProductController@showConfirmImportProduct')->name('show_confirm_import_product');
                    Route::post('/import_confirm','adminProductController@saveConfirmImportProduct')->name('save_confirm_import_product');
                    //Admin Color
                    Route::prefix("restock")->group(function(){
                        Route::get('/','adminProductController@showRestock')->name("admin_restocks");
                        Route::get('/new','adminProductController@newRestock')->name("new_restock");
                        Route::post('/create','adminProductController@createRestock')->name("create_restock");
                        Route::get('/edit/{restock_id}','adminProductController@editRestock')->name("edit_restock");
                        Route::post('/save/{restock_id}','adminProductController@saveRestock')->name("save_restock");
                        Route::get('/confirm/{restock_id}','adminProductController@confirmRestock')->name("confirm_restock");
                        Route::delete('/delete/{restock_id}','adminProductController@deleteRestock')->name("delete_restock");
                        Route::post('/confirm_restocks','adminProductController@deleteConfirmRestocks')->name('confirm_delete_restocks');
                        Route::delete('/show_confirm_restocks','adminProductController@deleteRestocks')->name('delete_restocks');
                    });
                    //Admin Color
                    Route::prefix("colors")->group(function(){
                        Route::get('/{product_id}','adminColorController@index')->name("admin_colors");
                        Route::get('/confirm/{color_id}','adminColorController@deleteColor')->name('confirm_color');
                        Route::delete('/confirm/{color_id}','adminColorController@deleteColor')->name('delete_color');
                        Route::get('/new/{product_id}/{color_entries}','adminColorController@showNewColors')->name('new_color');
                        Route::post('/createColor','adminColorController@createColors')->name('create_color');
                        Route::get('/edit/{color_id}','adminColorController@editColor')->name('edit_color');
                        Route::post('/edit/{color_id}','adminColorController@editColor')->name('save_color');
                        Route::get('/import/{product_id}','adminColorController@showImportColor')->name('show_import_color');
                        Route::post('/import','adminColorController@saveImportColor')->name('save_import_color');
                        Route::post('/confirm_colors','adminColorController@deleteConfirmColors')->name('confirm_delete_colors');
                        Route::delete('/show_confirm_colors','adminColorController@deleteColors')->name('delete_colors');
                        Route::get('/new_color_entries/{product_id}','adminColorController@showColorEntries')->name('show_color_entries');
                        Route::post('/color_entries_confirm','adminColorController@colorEntriesConfirm')->name('create_color_entries');
                    });
                    //Admin Size
                    Route::prefix("sizes")->group(function(){
                        Route::get('/{product_id}','adminSizesController@index')->name("admin_sizes");
                        Route::get('/confirm/{size_id}','adminSizesController@deleteSize')->name('confirm_size');
                        Route::delete('/confirm/{size_id}','adminSizesController@deleteSize')->name('delete_size');
                        Route::get('/new/{product_id}/{size_entries}','adminSizesController@showNewSizes')->name('new_size');
                        Route::post('/createSize','adminSizesController@createSizes')->name('create_size');
                        Route::get('/edit/{size_id}','adminSizesController@editSize')->name('edit_size');
                        Route::post('/edit/{size_id}','adminSizesController@saveSize')->name('save_size');
                        Route::get('/import/{product_id}','adminSizesController@showImportSize')->name('show_import_size');
                        Route::post('/import','adminSizesController@saveImportSize')->name('save_import_size');
                        Route::post('/confirm_sizes','adminSizesController@deleteConfirmSizes')->name('confirm_delete_sizes');
                        Route::delete('/show_confirm_sizes','adminSizesController@deleteSizes')->name('delete_sizes');
                        Route::get('/new_size_entries/{product_id}','adminSizesController@showSizeEntries')->name('show_size_entries');
                        Route::post('/size_entries_confirm','adminSizesController@sizeEntriesConfirm')->name('create_size_entries');
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
                        Route::get('/import/{product_id}','adminProductImagesController@showImportImage')->name('show_import_image');
                        Route::post('/import','adminProductImagesController@saveImportImage')->name('save_import_image');
                        Route::post('/confirm_images','adminProductImagesController@deleteConfirmImages')->name('confirm_delete_images');
                        Route::delete('/show_confirm_images','adminProductImagesController@deleteImages')->name('delete_images');
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
                        Route::post('/confirm_rates','adminProductRatesController@deleteConfirmRates')->name('confirm_delete_rates');
                        Route::delete('/show_confirm_rates','adminProductRatesController@deleteRates')->name('delete_rates');
                    });
                });
            });

            Route::prefix("admin")->middleware("auth:vestidosAdmins")->group(function(){
                //Admin Main Sliders
                Route::prefix('home_config')->group(function(){
                    Route::prefix('main_sliders')->group(function(){
                        Route::get('/','adminConfigSectionMainSliders@index')->name('main_sliders_page');
                        Route::get('/new','adminConfigSectionMainSliders@newMainSlider')->name('new_main_slider');
                        Route::post('/new','adminConfigSectionMainSliders@newMainSlider')->name('create_main_slider');
                        Route::get('/edit/{main_slider_id}','adminConfigSectionMainSliders@editMainSlider')->name('edit_main_slider');
                        Route::post('/edit/{main_slider_id}','adminConfigSectionMainSliders@editMainSlider')->name('save_main_slider');
                        Route::get('/confirm/{main_slider_id}','adminConfigSectionMainSliders@deleteMainSlider')->name('confirm_main_slider');
                        Route::delete('/confirm/{main_slider_id}','adminConfigSectionMainSliders@deleteMainSlider')->name('delete_main_slider');
                    });
                    Route::prefix('top_dresses')->group(function(){
                        Route::get('/','adminProductController@showTopDress')->name('top_dresses_page');
                        Route::get('/new','adminProductController@newTopDress')->name('new_top_dress');
                        Route::post('/new','adminProductController@newTopDress')->name('create_top_dress');
                    });
                    Route::prefix('top_quinces')->group(function(){
                        Route::get('/','adminProductController@showTopQuince')->name('top_quinces_page');
                        Route::get('/new','adminProductController@newTopQuince')->name('new_top_quince');
                        Route::post('/new','adminProductController@saveTopQuince')->name('create_top_quince');
                    });
    
                    Route::prefix('shop_banner')->group(function(){
                        Route::get('/','adminConfigShopBannerController@index')->name('shop_banners_page');
                        Route::get('/new','adminConfigShopBannerController@newShopBanner')->name('new_shop_banner');
                        Route::post('/new','adminConfigShopBannerController@newShopBanner')->name('create_shop_banner');
                        Route::get('/edit/{shop_banner_id}','adminConfigShopBannerController@editShopBanner')->name('edit_shop_banner');
                        Route::post('/edit/{shop_banner_id}','adminConfigShopBannerController@editShopBanner')->name('save_shop_banner');
                        Route::get('/confirm/{shop_banner_id}','adminConfigShopBannerController@deleteShopBanner')->name('confirm_shop_banner');
                        Route::delete('/confirm/{shop_banner_id}','adminConfigShopBannerController@deleteShopBanner')->name('delete_shop_banner');
                    });

                    Route::prefix('tax')->group(function(){
                        Route::get('/','adminTaxController@index')->name('admin_taxes');
                        Route::get('/new','adminTaxController@newTax')->name('new_tax');
                        Route::post('/new','adminTaxController@createTax')->name('create_tax');
                        Route::get('/edit/{tax_id}','adminTaxController@editTax')->name('edit_tax');
                        Route::post('/edit/{tax_id}','adminTaxController@saveTax')->name('save_tax');
                        Route::get('/confirm/{tax_id}','adminTaxController@deleteTax')->name('confirm_delete_tax');
                        Route::delete('/confirm/{tax_id}','adminTaxController@deleteTax')->name('delete_tax');
                        Route::post('/confirm_taxes','adminTaxController@deleteConfirmTaxes')->name('confirm_delete_taxes');
                        Route::delete('/show_confirm_taxes','adminTaxController@deleteTaxes')->name('delete_taxes');
                    });
    
                    //Admin Payment TYpe
                    Route::prefix("payment_types")->group(function(){
                        Route::get('/','adminPaymentTypesController@index')->name("admin_payments");
                        Route::get('/new','adminPaymentTypesController@newPayments')->name('new_payment');
                        Route::post('/new','adminPaymentTypesController@createPayments')->name('create_payment');
                        Route::get('/edit/{payment_id}','adminPaymentTypesController@editPayment')->name('edit_payment');
                        Route::post('/edit/{payment_id}','adminPaymentTypesController@savePayment')->name('save_payment');
                        Route::get('/confirm/{payment_id}','adminPaymentTypesController@showDeletePayment')->name('confirm_payment');
                        Route::delete('/confirm/{payment_id}','adminPaymentTypesController@deletePayment')->name('delete_payment');
                        Route::post('/confirm_payment_types','adminPaymentTypesController@deleteConfirmPayments')->name('confirm_delete_payments');
                        Route::delete('/show_confirm_payment_types','adminPaymentTypesController@deletePayments')->name('delete_payments');
                    });
                    //Admin Shipping list
                    Route::prefix("shipping_lists")->group(function(){
                        Route::get('/','adminShippingListsController@index')->name("admin_shipping_lists");
                        Route::get('/new','adminShippingListsController@newShippingLists')->name('new_shipping_list');
                        Route::post('/new','adminShippingListsController@createShippingLists')->name('create_shipping_list');
                        Route::get('/edit/{shipping_list_id}','adminShippingListsController@editShippingList')->name('edit_shipping_list');
                        Route::post('/edit/{shipping_list_id}','adminShippingListsController@saveShippingList')->name('save_shipping_list');
                        Route::get('/confirm','adminShippingListsController@showDeleteShippingList')->name('confirm_shipping_list');
                        Route::delete('/confirm','adminShippingListsController@deleteShippingList')->name('delete_shipping_list');
                        Route::post('/confirm_shipping_lists','adminShippingListsController@deleteConfirmShippingLists')->name('confirm_delete_shipping_lists');
                        Route::delete('/show_confirm_shipping_lists','adminShippingListsController@deleteShippingLists')->name('delete_shipping_lists');
                    });
                });
                //Admin Brands
                Route::prefix('brands')->group(function () {
                    Route::get('/','adminBrandController@index')->name("admin_brands");
                    Route::get('/confirm/{brand_id}','adminBrandController@deleteBrand')->name('confirm_brand');
                    Route::delete('/confirm/{brand_id}','adminBrandController@deleteBrand')->name('delete_brand');
                    Route::get('/new','adminBrandController@newBrands')->name('new_brand');
                    Route::post('/new','adminBrandController@newBrands')->name('create_brand');
                    Route::get('/edit/{brand_id}','adminBrandController@editBrand')->name('edit_brand');
                    Route::post('/edit/{brand_id}','adminBrandController@editBrand')->name('save_brand');
                    Route::get('/import','adminBrandController@showImportBrand')->name('show_import_brands');
                    Route::post('/import','adminBrandController@saveImportBrand')->name('save_import_brands');
                    Route::post('/confirm_brands','adminBrandController@deleteConfirmBrands')->name('confirm_delete_brands');
                    Route::delete('/show_confirm_brands','adminBrandController@deleteBrands')->name('delete_brands');
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
                    Route::get('/import','adminDressStylesController@showImportDressStyle')->name('show_import_dressstyle');
                    Route::post('/import','adminDressStylesController@saveImportDressStyle')->name('save_import_dressstyle');
                    Route::post('/confirm_dressstyles','adminDressStylesController@deleteConfirmDressStyles')->name('confirm_delete_dressstyles');
                    Route::delete('/show_confirm_dressstyles','adminDressStylesController@deleteDressStyles')->name('delete_dressstyles');
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
                    Route::get('/import','categoriesController@showImportCategory')->name('show_import_category');
                    Route::post('/import','categoriesController@saveImportCategory')->name('save_import_category');
                    Route::post('/confirm_categories','categoriesController@deleteConfirmCategories')->name('confirm_delete_categories');
                    Route::delete('/show_confirm_categories','categoriesController@deleteCategories')->name('delete_categories');
                });
                //Admin Event
                Route::prefix("events")->group(function(){
                    Route::get('/','adminEventsController@index')->name("admin_events");
                    Route::get('/confirm/{event_id}','adminEventsController@deleteevent')->name('confirm_event');
                    Route::delete('/confirm/{event_id}','adminEventsController@deleteevent')->name('delete_event');
                    Route::get('/new','adminEventsController@newevents')->name('new_event');
                    Route::post('/new','adminEventsController@newevents')->name('create_event');
                    Route::get('/edit/{event_id}','adminEventsController@editevent')->name('edit_event');
                    Route::post('/edit/{event_id}','adminEventsController@editevent')->name('save_event');
                    Route::get('/import','adminEventsController@showImportEvent')->name('show_import_event');
                    Route::post('/import','adminEventsController@saveImportEvent')->name('save_import_event');
                    Route::post('/confirm_events','adminEventsController@deleteConfirmEvents')->name('confirm_delete_events');
                    Route::delete('/show_confirm_events','adminEventsController@deleteEvents')->name('delete_events');
                    Route::get('/add_event_menu','adminEventsController@showEventMenu')->name('show_event_menu');
                    Route::post('/add_event_menu','adminEventsController@saveEventMenu')->name('save_event_menu');
                });
                //Admin AdminProductType
                Route::prefix("product_types")->group(function(){
                    Route::get('/','adminProductTypesController@index')->name("admin_product_types");
                    Route::get('/confirm/{product_type_id}','adminProductTypesController@deleteproduct_type')->name('confirm_product_type');
                    Route::delete('/confirm/{product_type_id}','adminProductTypesController@deleteproduct_type')->name('delete_product_type');
                    Route::get('/new','adminProductTypesController@newproduct_types')->name('new_product_type');
                    Route::post('/new','adminProductTypesController@newproduct_types')->name('create_product_type');
                    Route::get('/edit/{product_type_id}','adminProductTypesController@editproduct_type')->name('edit_product_type');
                    Route::post('/edit/{product_type_id}','adminProductTypesController@editproduct_type')->name('save_product_type');
                    Route::get('/import','adminProductTypesController@showImportProductType')->name('show_import_product_type');
                    Route::post('/import','adminProductTypesController@saveImportProductType')->name('save_import_product_type');
                     Route::post('/confirm_product_types','adminProductTypesController@deleteConfirmProductTypes')->name('confirm_delete_product_types');
                    Route::delete('/show_confirm_product_types','adminProductTypesController@deleteProductTypes')->name('delete_product_types');
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
                    Route::get('/import','adminClosureController@showImportClosure')->name('show_import_closure');
                    Route::post('/import','adminClosureController@saveImportClosure')->name('save_import_closure');
                    Route::post('/confirm_closures','adminClosureController@deleteConfirmClosures')->name('confirm_delete_closures');
                    Route::delete('/show_confirm_closures','adminClosureController@deleteClosures')->name('delete_closures');
                });
                //Admin Lengths
                Route::prefix("lengths")->group(function(){
                    Route::get('/','adminLengthController@index')->name("admin_lengths");
                    Route::get('/confirm/{length_id}','adminLengthController@deleteLength')->name('confirm_length');
                    Route::delete('/confirm/{length_id}','adminLengthController@deleteLength')->name('delete_length');
                    Route::get('/new','adminLengthController@newLengths')->name('new_length');
                    Route::post('/new','adminLengthController@newLengths')->name('create_length');
                    Route::get('/edit/{length_id}','adminLengthController@editLength')->name('edit_length');
                    Route::post('/edit/{length_id}','adminLengthController@editLength')->name('save_length');
                    Route::get('/import','adminLengthController@showImportLength')->name('show_import_length');
                    Route::post('/import','adminLengthController@saveImportLength')->name('save_import_length');
                    Route::post('/confirm_lengths','adminLengthController@deleteConfirmLengths')->name('confirm_delete_lengths');
                    Route::delete('/show_confirm_lengths','adminLengthController@deleteLengths')->name('delete_lengths');
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
                    Route::get('/import','adminFabricController@showImportFabric')->name('show_import_fabrics');
                    Route::post('/import','adminFabricController@saveImportFabric')->name('save_import_fabrics');
                    Route::post('/confirm_fabrics','adminFabricController@deleteConfirmFabrics')->name('confirm_delete_fabrics');
                    Route::delete('/show_confirm_fabrics','adminFabricController@deleteFabrics')->name('delete_fabrics');
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
                    Route::get('/import','adminNecklineController@showImportNeckline')->name('show_import_neckline');
                    Route::post('/import','adminNecklineController@saveImportNeckline')->name('save_import_neckline');
                    Route::post('/confirm_necklines','adminNecklineController@deleteConfirmNecklines')->name('confirm_delete_necklines');
                    Route::delete('/show_confirm_necklines','adminNecklineController@deleteNecklines')->name('delete_necklines');
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
                    Route::get('/import','vendorsController@showImportVendor')->name('show_import_vendor');
                    Route::post('/import','vendorsController@saveImportVendor')->name('save_import_vendor');
                    Route::get('/import_confirm','vendorsController@showImportVendor_confirm')->name('show_import_vendor_confirm');
                    Route::post('/import_confirm','vendorsController@saveImportVendor_confirm')->name('save_import_vendor_confirm');
                    Route::post('/confirm_vendors','vendorsController@deleteConfirmVendors')->name('confirm_delete_vendors');
                    Route::delete('/show_confirm_vendors','vendorsController@deleteVendors')->name('delete_vendors');
                });
                //Admin Users
                Route::prefix("users")->group(function(){
                    Route::get("/",'adminUsersController@index')->name("admin_users");
                    Route::get("/new",'adminUsersController@showNewUserForm')->name("admin_newuser");
                    Route::post("/new",'adminUsersController@createUserForm')->name("admin_createuser");
                    Route::get("/edit/{user_id}",'adminUsersController@showUpdateUser')->name("admin_edituser");
                    Route::post("/edit/{user_id}",'adminUsersController@updateUser')->name("admin_updateuser");
                    Route::get('/confirm/{user_id}','adminUsersController@deleteUser')->name('confirm_adminuser');
                    Route::delete('/confirm/{user_id}','adminUsersController@deleteUser')->name('delete_adminuser');
                    Route::get('/import','adminUsersController@showImportUser')->name('show_import_adminuser');
                    Route::post('/import','adminUsersController@saveImportUser')->name('save_import_adminuser');
                    Route::post('/confirm_users','adminUsersController@deleteConfirmUsers')->name('confirm_delete_users');
                    Route::delete('/show_confirm_users','adminUsersController@deleteUsers')->name('delete_users');
                    Route::prefix("addresses")->group(function(){
                        Route::get("/{user_id}",'adminUsersController@userAddress')->name("admin_address");
                        Route::get("/new/{user_id}",'adminUsersAddressController@newAddress')->name("admin_newaddress");
                        Route::post("/new/{user_id}",'adminUsersAddressController@newAddress')->name("admin_createaddress");
                        Route::get("/edit/{address_id}",'adminUsersAddressController@editAddress')->name("admin_editaddress");
                        Route::post("/edit/{address_id}",'adminUsersAddressController@editAddress')->name("admin_updateaddress");
                        Route::get('/confirm/{address_id}','adminUsersAddressController@deleteAddress')->name('confirm_adminaddress');
                        Route::delete('/confirm/{address_id}','adminUsersAddressController@deleteAddress')->name('delete_adminaddress');
                        Route::post('/confirm_addresses','adminUsersAddressController@deleteConfirmAddresses')->name('confirm_delete_addresses');
                        Route::delete('/show_confirm_addresses','adminUsersAddressController@deleteAddresses')->name('delete_addresses');
                    });
                });
    
                //Admin Orders
                Route::prefix("orders")->group(function(){
                    Route::get('/','ordersController@index')->name("admin_orders");
                    Route::get('/confirm/{order_id}','ordersController@confirmCancel')->name('admin_confirm_order');
                    Route::delete('/confirm/{order_id}','ordersController@cancelOrder')->name('admin_cancel_order');
                    Route::get('/confirm_delete/{order_id}','ordersController@confirmDelete')->name('admin_confirm_delete_order');
                    Route::delete('/confirm_delete/{order_id}','ordersController@deleteOrder')->name('admin_delete_order');
                    Route::get('/new','ordersController@newOrders')->name('admin_new_order');
                    Route::post('/new','ordersController@createOrder')->name('admin_create_order');
                    Route::get('/edit/{order_id}','ordersController@editOrder')->name('admin_edit_order');
                    Route::post('/edit/{order_id}','ordersController@saveOrder')->name('admin_save_order');
                    Route::post('/confirm_orders','ordersController@deleteConfirmOrders')->name('confirm_delete_orders');
                    Route::delete('/show_confirm_orders','ordersController@deleteOrders')->name('delete_orders');
                    Route::prefix("products")->group(function(){
                        Route::get('/new','ordersProductsController@newOrderProducts')->name('admin_new_order_products');
                        Route::post('/new','ordersProductsController@createOrderProducts')->name('admin_create_order_products');
                        Route::get('/edit/{order_product_id}','ordersProductsController@editOrderProduct')->name('admin_edit_order_products');
                        Route::post('/edit/{order_product_id}','ordersProductsController@saveOrderProduct')->name('admin_save_order_products');
                        Route::get('/confirm/{order_product_id}','ordersProductsController@confirmDeleteOrderProduct')->name('admin_confirm_order_products');
                        Route::delete('/confirm/{order_product_id}','ordersProductsController@deleteOrderProduct')->name('admin_delete_order_products');
                        Route::get('/{order_id}','ordersProductsController@index')->name("admin_order_products");
                    });
                    Route::prefix("address")->group(function(){
                        Route::get('/new','ordersController@showOrderAddress')->name('admin_show_new_order_address');
                        Route::post('/new','ordersController@createOrderAddress')->name('admin_create_new_order_address');
                        Route::get('/edit/{order_id}/{address_type_id}','ordersController@editOrderAddress')->name('admin_edit_order_address');
                        Route::post('/edit','ordersController@saveOrderAddress')->name('admin_save_order_address');
                    });
                    Route::prefix("payment")->group(function(){
                        Route::get('/checkout','ordersController@showAdminOrderCheckout')->name('admin_show_checkout');
                        Route::post('/checkout','ordersController@processAdminOrderCheckout')->name('admin_process_checkout');
                        Route::get('/payment/{order_id}','ordersController@showAdminOrderPayment')->name('admin_show_order_payment');
                        Route::post('/process_payment/{order_id}','ordersController@orderAdminProcessPayment')->name('admin_process_order_payment');
                    });
                });
            });
        });


        //API
        Route::get("api/saveWishlist",'userWishlistController@addWishlist');
        Route::get("api/updateCart",'userCartController@cart_save');
        Route::get("api/deleteCart",'userCartController@cart_delete');
        Route::get('api/getAddress','ordersController@getAddressDropdown');
        Route::get('api/getProduct','ordersController@getProductDropdown');
        Route::get("api/loadStates",'homeController@loadStatesDrop');
        Route::get("api/loadDistricts",'homeController@loadDistrictsDrop');
        Route::get("api/loadCorregimientos",'homeController@loadCorregimientosDrop');
        Route::get("api/loadColors",'homeController@loadColor');
        Route::get("api/loadSizes",'homeController@loadColorSizes');
        Route::get("api/loadProdQuantity",'homeController@loadProdQuantity');
        Route::get("api/loadProdQuantityArray",'homeController@loadProdQuantityData');
        Route::get("api/loadSizeInfo",'homeController@loadSizeInfo');
        Route::get("api/searchProductList",'adminProductController@searchProductByName')->name("search_product_by_name");
   // });
   Auth::routes();
//});
Route::get('/generate/password',function(){
    return bcrypt("123456789");
});




