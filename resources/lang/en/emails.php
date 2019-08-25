<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Email template Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for email templates
    |
    */
   'orders'=>[
        'date_ordered'=>"Order Placed",
        'delivered_date'=>'Delivered Date',
        'cancelled_date'=>"Cancelled Date",
        'shipped_date'=>"Shipped Date",
        'returned_date'=>'Returned Date',
    ],

    'password_reset'=>[
        'line_hello'=>"Hello :name",
        'line_1'=>'You have requested a reset password request email.',
        'line_2'=>"Please click the link bellow to begin:",
        'line_3'=>"Reset Password",
        'line_4'=>'Returned Date',
    ],

    'user_registry'=>[
        'line_hello'=>"Hello :name",
        'line_1'=>"Welcome to Vestidos Boutique.",
        'line_2'=>"Your Account registration has been submitted!",
        'line_3'=>"To active your account, please click the link below for verification",
        'line_4'=>"Active Account",
        'line_5'=>"To log in when visiting our site just click on:",
        'line_6'=>"Email",
    ],
    'user_registry_resend'=>[
        'line_hello'=>"Hello :name",
        'line_1'=>"Welcome to Vestidos Boutique.",
        'line_2'=>"To active your account, please click the link below for verification!",
        'line_3'=>"Active Account",
        'line_4'=>"To log in when visiting our site just click on:",
        'line_7'=>"Email",
    ],

    'order_admin'=>[
        'line_hello'=>"Hello Admin",
        'line_1'=>'A new order placed :date by :name and has been received.',
        'line_2'=>"Order Number:",
        'line_3'=>"Billing Address",
        'line_4'=>'Shipping Address',
        'line_5'=>'Item Purchased',
        'line_6'=>'Item',
        'line_7'=>'Quant',
        'line_8'=>'Total',
        'line_9'=>'Size',
        'line_10'=>'Color',
        'line_11'=>'Subtotal',
        'line_12'=>'Tax',
        'line_13'=>'Shipping',
        'line_14'=>'Total',
        'line_15'=>'Discount',
        'line_16'=>'Grandtotal',
    ],

    'order_user_cancel'=>[
        'line_hello'=>"Hello :name",
        'line_1'=>'This email is to confirm your order has been successfully cancelled. The amount of :total',
        'line_2'=>"Order Number:",
        'line_3'=>'Shipping Address',
        'line_4'=>"Billing Address",
        'line_5'=>'Item Purchased',
        'line_6'=>'Item',
        'line_7'=>'Quant',
        'line_8'=>'Total',
        'line_9'=>'Size',
        'line_10'=>'Color',
        'line_11'=>'Subtotal',
        'line_12'=>'Tax',
        'line_13'=>'Shipping',
        'line_14'=>'Total',
        'line_15'=>'Discount',
        'line_16'=>'Grandtotal',
    ],

    'order_user_received'=>[
        'line_hello'=>"Hello :name",
        'line_1'=>'Thank you for shopping with us.  Your order placed :date has been received. We will send you a confirmation when your item ships.',
        'line_2'=>"Order Number:",
        'line_3'=>'Shipping Address',
        'line_4'=>"Billing Address",
        'line_5'=>'Item Purchased',
        'line_6'=>'Item',
        'line_7'=>'Quant',
        'line_8'=>'Total',
        'line_9'=>'Size',
        'line_10'=>'Color',
        'line_11'=>'Subtotal',
        'line_12'=>'Tax',
        'line_13'=>'Shipping',
        'line_14'=>'Total',
        'line_15'=>'Discount',
        'line_16'=>'Grandtotal',
    ],

    'order_user_update'=>[
        'line_hello'=>"Hello :name",
        'line_1'=>'This email is to notify you of an order update.',
        'line_2'=>"Order Number:",
        'line_3'=>'Shipping Address',
        'line_4'=>"Billing Address",
        'line_5'=>'Item Purchased',
        'line_6'=>'Item',
        'line_7'=>'Quant',
        'line_8'=>'Total',
        'line_9'=>'Size',
        'line_10'=>'Color',
        'line_11'=>'Subtotal',
        'line_12'=>'Tax',
        'line_13'=>'Shipping',
        'line_14'=>'Total',
        'line_15'=>'Discount',
        'line_16'=>'Grandtotal',
    ],

    'order_payment_update'=>[
        'line_email_title'=>'Hello :name, your payment has been received',
        'line_hello'=>"Hello :name",
        'line_1'=>'This email is to notify you of your payment update for your order',
        'line_2'=>"Order Number:",
        'line_3'=>'Method',
        'line_4'=>"Amount",
        'line_5'=>"Statue",
        'line_6'=>"Date",
        'line_7'=>'Item Purchased',
        'line_8'=>'Item',
        'line_9'=>'Quant',
        'line_10'=>'Total',
        'line_11'=>'Size',
        'line_12'=>'Color',
        'line_13'=>'Subtotal',
        'line_14'=>'Tax',
        'line_15'=>'Shipping',
        'line_16'=>'Total',
        'line_17'=>'Discount',
        'line_18'=>'Grandtotal',
        'line_19'=>'Total Paid',
        'line_20'=>'Amount Due',
    ],

    'order_payment_removed'=>[
        'line_email_title'=>'Hello :name, your payment is cancelled',
        'line_hello'=>"Hello :name",
        'line_1'=>'This email is to notify you that the following payment(s) was cancelled.',
        'line_2'=>"Order Number:",
        'line_3'=>'Method',
        'line_4'=>"Amount",
        'line_5'=>"Statue",
        'line_6'=>"Date",
        'line_7'=>'Item Purchased',
        'line_8'=>'Item',
        'line_9'=>'Quant',
        'line_10'=>'Total',
        'line_11'=>'Size',
        'line_12'=>'Color',
        'line_13'=>'Subtotal',
        'line_14'=>'Tax',
        'line_15'=>'Shipping',
        'line_16'=>'Total',
        'line_17'=>'Discount',
        'line_18'=>'Grandtotal',
        'line_19'=>'Total Paid',
        'line_20'=>'Amount Due',
    ],

    'order_cancel_request'=>[
        'line_hello'=>"Hello :name",
        'line_1'=>'Your request for order cancellation is sent. Please allow 48 hours to complete the process.',
        'line_2'=>"We will determine if the cancellation is allowed.  We will send you another email for confirmation.",
        'line_3'=>"Order Number:",
        'line_4'=>'Shipping Address',
        'line_5'=>'Billing Address',
        'line_6'=>'Item Purchased',
        'line_7'=>'Item',
        'line_8'=>'Quant',
        'line_9'=>'Total',
        'line_10'=>'Size',
        'line_11'=>'Color',
        'line_12'=>'Subtotal',
        'line_13'=>'Tax',
        'line_14'=>'Shipping',
        'line_15'=>'Total',
        'line_16'=>'Discount',
        'line_17'=>'Grandtotal',
    ],

    'order_cancel_admin'=>[
        'line_1'=>'Hello Admin',
        'line_2'=>"A new request for order cancellation is received.",
        'line_3'=>"Order Number:",
        'line_4'=>'Shipping Address',
        'line_5'=>'Billing Address',
        'line_6'=>'Item Purchased',
        'line_7'=>'Item',
        'line_8'=>'Quant',
        'line_9'=>'Total',
        'line_10'=>'Size',
        'line_11'=>'Color',
        'line_12'=>'Subtotal',
        'line_13'=>'Tax',
        'line_14'=>'Shipping',
        'line_15'=>'Total',
        'line_16'=>'Discount',
        'line_17'=>'Grandtotal',
    ],
    
    'new_email_admin'=>[
        'line_1'=>'New Email Received',
        'line_2'=>"Name:",
        'line_3'=>"Email:",
        'line_4'=>'Phone:',
        'line_5'=>'Country:',
        'line_6'=>'Message:',
    ],

    'admin_user_update'=>[
        'line_hello'=>'Hello :name',
        'line_1'=>"To log in when visiting our site just click on:",
    ],

    'order_admin_received'=>[
        'line_hello'=>"Hello :name",
        'line_1'=>'Welcome to Vestidos Boutique.',
        'line_2'=>"Your :type Account registration has created!",
        'line_3'=>"To log in when visiting our site just click on:",
        'line_4'=>'Email',
    ],

];
