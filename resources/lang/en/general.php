<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Basic General Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used general text
    |
    */
    'form'=>[
        'name' => 'Name',
        'nickname'=> 'NickName',
        'first_name'=>"First Name",
        'middle_name'=>"Middle Name",
        'last_name'=>"Last Name",
        'email'=>"Email",
        'telephone'=>"Phone Number",
        'whatssap'=>"Whatsapp",
        'address'=>"Address | Addresses",
        'city'=>"City",
        'state'=>"State",
        'country'=>"Country",
        'province'=>"Province",
        'district'=>"District",
        'corregimiento'=>"Corregimiento",
        'zip'=>"Postal Code",
        'password'=>'Password',
        'question'=>"Question",
        'retype_password'=>"Re-Type Password",
        'gender'=>"Gender",
        'dob'=>"Date of Birth",
        'language'=>"Language | Languages",
        'select_country'=>"Select Country",
        'select_gender'=>"Select Your Gender",
        'select_language'=>"Select Language | Select Languages",
        'no_email_match'=>"No match found under that email",
        'save_password_error'=>"ERROR: the password could not be updated, try again later.",
    ],
    'payment_info'=>[
        'card'=>'Number',
        'type'=>'Card',
        'status'=>"Status",
        'date'=>"Date",
        "payment_type"=>"Type of Payment"
    ],
    //PAGE HEADER
    'page_header'=>[
        'address_type'=>"Address Types",
        'select_address_type'=>"Select Address Type",
        'shipping_address'=>"Shipping Address",
        'billing_address'=>"Billing Address",
        'choose_delivery'=>'Choose Delivery Method',
        'optimized_search'=>"Optimize Search",
        'payment_method'=>"Payment Method",
        'order_summary'=>"Order Summary",
        'opening_hours'=>"Opening Hours",
        'choose_billing_payment'=>"Choose Billing and Payment Method",
        'provide_billing_payment'=>'Please Provide Billing and Payment Method',
        'select_shipping'=>'Select Shipping Address',
        'provide_shipping'=>'Provide Shipping Address',
        'edit_account'=>"Edit Account",
        'new_account'=>"New Account",
        'review_name'=>'Review for :name',
        'welcome' => 'Welcome, :name',
        'welcome_page'=>"Welcome Page",
        'delete_order'=>"Delete Order",
        'cancel_order'=>"Cancel Order",
        'order_detail'=>"Order Detail",
        'top_dresses'=>"Top Dresses",
        'top_quince'=>"Top Quinceañera Dresses",
        'payment'=>"Payment",
        'confirmation'=>"Confirmation",
        'account_created'=>'Account Created',
        'account_not_created_friendly'=>'Ops!, Something unexpected happened while creating your account, please try again later',
        'account_not_created'=>"Ops! Account Not Created",
        'ops'=>"Ops!",
        'logout'=>"Logout Page",
        'order_received'=>"Order Received",
        'error_page'=>"Error Page",
        'terms_use'=>"Terms of Use",
        'privacy_use'=>"Privacy Terms",
    ],
    'payment_section' =>[
        'payment_completed'=>'Payment successfully completed',
        'payment_updated'=>'payment updated',
        'unable_delete'=>'Unable to Delete Payment',
        'success_deleted'=>'Payment Successfully Deleted',
        'confirm_cancellation'=>'Confirm Payment Cancellation',
        'confirm_cancellations'=>'Confirm payments for deletion',
        'delete_cancellations'=>'Payments Deleted successfully.',
    ],
    'order_section' =>[
        'order_updated'=>'order updated',
        'payment_success'=>'Payment was successfully processed!',
        'order_received'=>'Order Received',
        'order_completed'=>'Order is Completed',
        'order_success_created'=>'Success: Your order has been created',
        'order_success_created_none'=>'Order Successfully Created',
        'order_success_received'=>'Success: Your order has been received',
        'order_success_deleted'=>'Order Successfully Deleted',
        'received_to_process'=>"Thank you for your order! we are processing your order, once your order is updated you will notify you right away!.",
        'unable_delete'=>'Unable to Delete Order',
        'cancel_request'=>'Order Cancellation Request Sent',
        'new_order'=>'New Order',
        'edit_order'=>"Edit Order",
        'new_order_address'=>'New Order | Address',
        'new_order_checkout'=>"New Order | Checkout",
        'new_order_products'=>"New Order | Add Products",
        'edit_order_address'=>"Edit Order :name Address",
        'address_saved'=>'Address successfully saved',
        'confirm_cancellation'=>'Confirm Order Cancellation',
        'process_order'=>"Process Order Payment",
        'cancel_success'=>"Order Successfully Cancelled",
        'delete_name'=>'Delete Product :name From Orders',
        'order_address'=>"Order Address",
        'agree_terms_use'=>'I agree to the terms and conditions',
        'to_user'=>[
            'received'=>'Hello :name, thank you for your order',
            'cancel_confirmation'=>'Hello :name, your cancellation confirmation',
            'updated'=>'Hello :name, your order has been updated',
            'cancel'=>'Hello :name, your order is cancelled',
        ],
        'to_admin'=>[
            'received'=>"Hello Admin, new order received from :name",
            'cancel_confirmation'=>'Hello Admin, new order cancellation from :name',
        ],
    ],
    'user_section'=>[
        'profile_review_title'=>'Your review is very important to us!.  Let everyone know about your experience!',
        'profile_review_created'=>'Thank you for your review! Your review is very important to us!.',
        'profile_review_saved'=>'Your review is saved! once your review is approved, it will be displayed.',
        'profile_review_deleted'=>'Your review is deleted!',
        'register_text'=>'Create an account to enjoy the online facility. You can save your profile with your address, track orders, save favorites and much more.',
        'profile_order_title'=>'In this section you can see the status of your order and follow it up.',
        'profile_main_title'=>'Your personal information',
        'profile_wishlist_title'=>'Save your favorites in this section for future purchases',
        'profile_wishlist_action'=>'Action',
        'profile_wishlist_desc'=>'Description',
        'profile_order_cancel'=>'In this section you can cancel your order',
        'profile_order_cancel_title2'=>'Are you sure want to cancel order :name',
        'profile_order_cancel_title3'=>'Please choose reason for cancellation',
        'profile_order_amount_due'=>'Amount Due',
        'profile_order_amount_paid'=>'Amount Paid',
        'registration_complete'=>'Hello :name, your account registration is completed.',
        'create_address'=>'Create Address',
        'profile_edit_title'=>"Edit your personal information and password.",
        'profile_address_add_title'=>"Add your address for billing and shipping use.",
        'profile_address_delete_title'=>"Confirmed you wish to delete this address.",
        'profile_address_delete_title2'=>"are you sure want to delete billing.",
        'profile_address_edit_title'=>"Edit your addresses for billing and shipping use.",
        'edit_address_simple'=>"Edit Address",
        'edit_address'=>"Edit Address :name",
        'delete_address'=>'Delete Address',
        'account_created'=>"Your account is successfully created",
        'account_created_confirm'=>"Your account is successfully created.  An email has been sent to your email for activation.  Please follow instructions to successfully activate your account.",
        'account_not_created'=>'An unexpected issue ocurred, please try again later',
        'account_active_title'=>"Account Activation Confirmation",
        'account_active_message'=>'Congratulations, you account is successfully activated!',
        'invalid_token'=>"Token required not found",
        'invalid_save'=>"ERROR: unable to activate account",
        'activation_required'=>"Your account requires activation in order to continue",
        'resend_activation_title'=>"Resend Activation Link",
        'resend_activation_message'=>"Please type your email address to resend you your activation link.",
        'resend_activation_title_resend'=>"Activation Link Resent",
        'resend_activation_message_resend'=>"An email has been sent to your email for activation.  Please follow instructions to successfully activate your account.",
        'to_user'=>[
            'thank_you'=>'Hello :name, thank you for your email',
            'update'=>":name, your account has been updated",
            'activate'=>":name, activate your account now",
        ],
        'to_admin'=>[
            'thank_you'=>'New Email From :name Received',
        ],
    ],
    'address_section'=>[
        'invalid'=>"Dirección inválida",
    ],
    //CART TITLES
    'cart_title'=>[
        'select_pick_up_speed'=>"Select Pick Up Speed",
        'shipping'=>"Shipping",
        'billing'=>"Billing",
        'confirmation'=>"Confirmation",
        'subtotal'=>"Subtotal",
        'grand_total'=>"Grand Total",
        'total'=>"Total | Totals",
        'quantity'=>"Quantity | Quantities",
        'qty'=>"Qty",
        'sell_by'=>"By",
        'total_price'=>"Total Price",
        'item'=>"Item | Items",
        'product'=>"Product | Products",
        'order'=>"Order | Orders",
        'order_total'=>"Order Total",
        'shipping_handling'=>"Shipping Handling",
        'estimated_tax'=>"Tax",
        'total_price'=>"Total Price",
        'order_total'=>"Total",
        'grand_total'=>"Grand Total",
        'subtotal'=>"Subtotal",
        'total'=>"Total | Totals",
        'item_removed'=>":name Removed",
        'item_updated'=>"Item Updated",
        'item_added'=>"Item Added",
        'cart_updated'=>"Cart Updated",
        'cart_error'=>"Ops!, Something Happened!",
        'min_payment'=>"Minimum payment of 50% is required to proceed",
        'discount_applied'=>"Discount applied",
        'discount_apply'=>"Enter Promotion Code",
        'discount_restriction'=>"Please note only one code can be applied per order",
        'discount_restriction_applied'=>"Only one code can be applied per order",
        'discount_not_found'=>"The promo code entered has expired or has not been recognised, please check your spelling and try again",
    ],
    'rate_title'=>[
        'your_rate'=>"Your Rate",
        'headline'=>"Headline",
        'edit_rate'=>"Edit Rate",
        'delete_rate'=>"Delete Rate",
        'remove_rate'=>"Remove Rate",
        'comment'=>"Your Comment",
        'product_review_title'=>"Product Review For: :name",
        
    ],
    'access_section'=>[
        'denied'=>"Access Denied.",
        'invalid_access'=>"Invalid Access",
    ],
    // 404
    'no_found'=>[
        'message'=>"Ooops, something goes wrong",
    ],
     //DATES
    'dates_title'=>[
        'date_ordered'=>"Order Placed",
        'delivered_date'=>'Delivered Date',
        'cancelled_date'=>"Cancelled Date",
        'shipped_date'=>"Shipped Date",
        'returned_date'=>'Returned Date',
    ],

     //PRODUCT TITLE
     'product_title'=>[
        'price'=>"Price",
        'select_color'=>"Select Colors",
        'select_size'=>"Select Size",
        'detail'=>"Detail",
        'description'=>"Description",
        'tax'=>"Tax",
        'in_stock'=>"In Stock",
        'in_stock_number'=>"Only :name Left!",
        'out_stock'=>"Out of Stock",
        'model_id'=>"Product ID",
        'new'=>"New",
        'style'=>"Style",
        'select_style'=>"Select style",
        'unit_price'=>"Unit Price",
        'size'=>"Size | Sizes",
        'color'=>"Color | Colors",
        'missing_size_color'=>"Missing Size or Colors definition for :name",
        'select_product'=>'You must select a product',
        'product_name'=>"Product: :name",
        'color_entries'=>'How many colors will you be entering',
        'size_entries'=>'How many sizes will you be entering',
        'pre_order'=>"Reserve your dress when it's available!",
        'per_order'=>'Per Order',
    ],

     //MENSAJES
     'empty_msg'=>[
        'wishlist'=>"Your Wishlists is Empty",
        'cart'=>"Your Cart is Empty",
        'order'=>"No Orders Found",
     ],

     //Weekdates
     'weekdays'=>[
        'monday'=>"Monday",
        'tuesday'=>"Tuesday",
        'wednesday'=>"Wednesday",
        'thursday'=>"Thursday",
        'friday'=>"Friday",
        'saturday'=>"Saturday",
        'sunday'=>"Sunday",
     ],

     'forgot_password'=>[
        'title'=>"Forgot Password?",
        'title_2'=>'Request to reset your password',
        'send_title'=>'Hello :name, your password reset email',
        'confirm_title'=>"Email for password reset request sent!",
        'confirm_msg'=>"Your email request to reset your access password is sent, please follow instruction in email to reset your passwordrequest sent!.",
        'reset_title'=>"Type your new password",
        'invalid_token'=>'Reset token either expired or no valid',
        'reset_confirm_email'=>"Hello :name",
         'reset_confirm_message'=>"Your password has been successfully updated",
    ],
     'also_loved'=>"People Also Loved",
     'got_question'=>"Got Questions? Call Us",
     'payment_final_step_msg'=>"This is the final step for your order",
     'optimized_search'=>"Optimized Search",
     'vendor'=>"Seller",
     'removed'=>"Removed",
     'unable_save'=>"Unable to Save",
     'thank_you'=>"Thank You",
     'success_email'=>"Your email was sent",
     'failed_email'=>'Unable to send email',
     'hello'=>"Hello",
     'attn'=>"Sincerely",
     'contact_line_1'=>"We are here to serve you, contact us:",
     'chosen'=>"Thank you for choosing us.",
     'excel_error'=>[
        'color_missing'=>"Product model :name is missing color name in the excel file, please provide a color and try again.",
        'size_missing'=>"A size for color :name for :index must be defined",
     ],
     'under_main_title'=>'Under Construction',
     'under_main_text'=>'Ops! We are sorry! We are working on this part of the page. Please come back later',
     'all_right_reserved'=>'All rights reserved',
];