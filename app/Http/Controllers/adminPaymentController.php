<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosOrders as Orders;
use App\vestidosOrdersProducts as OrdersProducts;
use App\vestidosStatus as vestidosStatus;
use App\vestidosUsers as Users;
use App\vestidosCoupons as Coupons;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use App\vestidosCountries as Countries;
use Illuminate\Support\Facades\Input;
use App\vestidosUserAddresses as Addresses;
use App\vestidosProvinces as Provinces;
use App\vestidosDistricts as Districts;
use App\vestidosCorregimientos as Corregimientos;
use App\vestidosOrderCancelReasons as CancelReasons;
use Illuminate\Support\Facades\DB;
use App\vestidosShippingLists as ShippingLists;
use App\vestidosSizes as Sizes;
use App\vestidosColors as Colors;
use App\vestidosPaymentHistories as PaymentHistories;
use App\vestidosAddressTypes as AddressTypes;
use App\vestidosOrderAddresses as OrderAddresses;
use App\vestidosTaxInfos as Tax;
use App\vestidosPaymentTypes as PaymentTypes;
use App\vestidosMainConfigs as MainConfig;
use App\vestidosProductDeliveries as ProductDeliveries;
use Braintree;
use Mail;
use Illuminate\Support\Facades\Auth;
use Session;

class adminPaymentController extends Controller
{
    //
    public function __construct(Addresses $addresses, Products $products, Users $users, vestidosStatus $vestidosStatus, Orders $orders,OrdersProducts $order_products,CancelReasons $cancel_reasons,ShippingLists $shippingLists, Countries $countries,Sizes $sizes,Colors $colors,PaymentHistories $payment_histories,AddressTypes $address_types,Tax $tax,OrderAddresses $orderaddresses,Provinces $provinces, Districts $districts, Corregimientos $corregimientos,PaymentTypes $paymentTypes, MainConfig $main_config, Coupons $coupons, ProductDeliveries $product_deliveries){
        $this->statuses=$vestidosStatus;
        $this->orders=$orders;
        $this->order_products=$order_products;
        $this->users=$users;
        $this->countries = $countries;
        $this->provinces=$provinces;
        $this->districts=$districts;
        $this->product_deliveries = $product_deliveries->where("status","1")->orderBy("main",'desc')->get();
        $this->corregimientos=$corregimientos;
        $this->payment_types = $paymentTypes;
        $this->payment_histories = $payment_histories;
        $this->shipping_lists = $shippingLists;
        $this->cancel_reasons=$cancel_reasons;
        $this->products=$products;
        $this->addresses=$addresses;
        $this->colors=$colors;
        $this->order_addresses = $orderaddresses;
        $this->sizes=$sizes;
        $this->coupons = $coupons;
        $this->tax_info = $tax->first();
        $this->address_types = $address_types;
        $this->main_config = $main_config->first();
        $this->sender_info = [
            "name"=>env("MAIL_FROM_NAME"),
            "email"=>env("MAIL_FROM_ORDER"),
        ];
    }
    public function index($order_id){
        $data=[];
        $data["main_items"]=$this->payment_histories->where('order_id',$order_id)->orderBy('created_at','desc')->paginate(10);
        $data["order_id"]=$order_id;
        $data["page_submenus"]=[
            [
                "url"=>route('admin_show_order_payment',['order_id'=>$order_id]),
                "name"=>"Back to Previous"
            ],
        ];
        $data["delete_menu"] =route('confirm_admin_delete_order_payments');
        $data["page_title"]=__('header.payment_title');
        return view("admin/orders/payments/home",$data);
    }
    public function showAdminOrderCheckout(){
        $data=[];
        if(Session::has("vestidos_admin_shop")){
            $data = Session::get("vestidos_admin_shop");
            $user = $this->users->find($data["user_id"]);
        }else{
            return redirect()->route('admin_orders')->with("error",__('general.access_section.invalid_access'));
        }
        $discount_app = null;
        if(Session::has("discount_apply")){
            $discount_app = $data["order_total"] - ($data["order_total"] * Session::get("discount_apply")["discount"] / 100);
            $data["grand_total"] = ($data["order_total"] + $data["order_shipping"] + $data["order_tax"]) - $discount_app;
            Session::forget("vestidos_admin_shop");
            Session::put("vestidos_admin_shop",$data);
        }
        $data["discount_app"]= $discount_app;
        $data["product_deliveries"]=$this->product_deliveries;
        $data["payment_types"]=$this->payment_types->where("status",1)->get();
        $data["page_title"]=__('general.order_section.new_order_checkout');
         return view("admin/orders/payments/checkout",$data);
        //dd($data);
    }
    public function showAdminOrderPayment($order_id){
        $data=[];
        $order = $this->orders->find($order_id);
        $data["order"]=$this->orders->find($order_id);
        $data["payment_types"]=$this->payment_types->all();

        $payment_made = $this->payment_histories->where("order_id",$order_id)->sum("total");
        $data["amount_due"]=($order->order_total - $order->order_discount + $order->order_tax) - $payment_made;
        $data["page_submenus"]=[
            [
                "url"=>route('admin_edit_order',['order_id'=>$order_id]),
                "name"=>"Back to Previous"
            ],
            [
                "url"=>route('admin_order_payments',['order_id'=>$order_id]),
                "name"=>"[".$order->paymentHistories()->count()."] View Payment History"
            ]
        ];
        $data["page_title"]=__('general.order_section.process_order')." ".$order->order_number;
        return view("admin/orders/payments/new",$data);
    }
    public function orderAdminProcessPayment(Request $request,$order_id){

        $this->validate($request,[
            'order_total' => "required"
        ]);
        $save_db=false;
        $grand_total = $request->input("order_total");
        $order=$this->orders->find($order_id);
        $today = carbon::now();
        $user_id = Auth::id();
        $payment_method = $request->input("payment_type")[0];
        $is_credit = $request->input("is_credit_card");
        $sendNotification = $request->input("sendNotification");
        $new_payment=[];
        $new_payment["order_id"]=$order->id;
        $new_payment["user_id"]=$user_id;
        $new_payment["total"]=floatval($grand_total);
        $new_payment["ip"]=$request->ip();
        $new_payment["created_at"]=$today;
        if($is_credit == "yes"){
            $nonce = $request->input('nonce', false);
            $status = Braintree_Transaction::sale([
                'amount' => $grand_total,
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);
            if($status->success){
                //SAVE PAYMENT HISTORIES
                $new_payment["transaction_id"]=$status->transaction->id;
                $new_payment["payment_method"]=$status->transaction->paymentInstrumentType;
                $new_payment["credit_card_type"]=$status->transaction->creditCard["cardType"];
                $new_payment["credit_card_number"]=$status->transaction->creditCard["last4"];
                $new_payment["payment_status"]=$status->transaction->processorResponseText;
                $save_db = true;
                // todo
                // send email
            }
            $error_msg = $status->message;

        }else{
            //SAVE PAYMENT HISTORIES
            $payment_type = $this->payment_types->find($payment_method);
            if($payment_type->count()){
                $new_payment["payment_method"]=$payment_type->name;
            }
            $save_db = true;
            // todo
            // send email
        }
        if($save_db){
            $payment_history = PaymentHistories::create($new_payment);
            if(!empty($payment_history->id)){
                $order->updated_at=$today;
                $order->save();
                if($sendNotification && $this->sender_info["email"] && $this->sender_info["name"]){
                    //send email to client
                    $order_detail = $this->sendEmail($order->id,$payment_history->id);
                    Mail::send('emails.orderpayment_received',["order_detail"=>$order_detail],function($message) use($order_detail){
                        $message->from($this->sender_info["email"],$this->sender_info["name"]);
                        $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                        $subject = __('emails.order_payment_update.line_email_title',['name'=>$client_name]);
                        $message->to($order_detail["user"]["email"],$client_name)->subject($subject);
                    });
                }
                return redirect()->route('admin_edit_order',["order_id"=>$order_id])->with("success",__('general.payment_section.payment_completed'));
            }
            $error_msg = "Error saving payment history";
        }

        return redirect()->back()->withErrors([
            "required"=>$error_msg
        ]);
    }
    public function processAdminOrderCheckout(Request $request){

        $grand_total = $request->input("order_total");
        if(Session::has("vestidos_admin_shop")){
            $cart = Session::get("vestidos_admin_shop");
            $user = $this->users->find($cart["user_id"]);
            $user_id=$user->id;
        }else{
            return redirect()->route('admin_orders')->with("error",__('general.access_section.invalid_access'));
        }
        $nonce = $request->input('nonce', false);
        $today = carbon::now();
        $todayf = $today->format("dmY");
        $random = rand(0,99);
        
        $total = $cart["order_total"];
        if(Session::has("discount_apply")){
            $discount_app = $total - ($total * (Session::get("discount_apply")["discount"] / 100));
            $data["coupon_id"] = Session::get("discount_apply")["id"];
            $data["order_discount"] = $discount_app;
        }
        $order_number = "VES-".$todayf.$user_id.$random;

        $is_credit_card = $request->input("payment_type") == 4 ? true : false;
        $data["payment_type"]=$request->input("payment_type");
        if($this->main_config->allow_delivery_time && $request->input("product_delivery")){
            $delivery = $this->product_deliveries->find($request->input("product_delivery"));
            $data["delivery_speed_id"]=$delivery->id;
            $data["delivery_speed_cost"]=$delivery->total;
            $data["delivery_speed_name"]=$delivery->name;
            $data["delivery_speed_description"]=$delivery->description;
        }
        $data["status"]=$is_credit_card ? 9 : 12;
        if($is_credit_card){
            $status = Braintree_Transaction::sale([
                'amount' => $grand_total,
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);
            if(!$status->success){
                return redirect()->back()->withErrors([
                    "required"=>$status->message
                ]);
            }
        }

            $data["user_id"]=$cart["user_id"];
            $data["order_number"]=$order_number;
            $data["purchase_date"]=$today;
            $data["order_total"]=$cart["order_total"];
            $data["order_tax"]=$cart["order_tax"];
            $data["grand_total"]=$grand_total;
            $data["ip"] = $request->ip();
            $data["created_at"]=carbon::now();
            // $data["products"]=$cart_p;
            foreach($cart["products"] as $product){
                $check_size = $this->sizes->find($product["size_id"]);
                $check_product = $this->products->find($product["id"]);
                $check_color =  $this->colors->find($product["color_id"]);
                // if($check_size->stock < 1){
                //     return redirect()->back()->withErrors([
                //         "required"=>$check_product->products_name." ".$check_color->name." / ".$check_size->name." is out of stock"
                //     ]);
                // }
            }
        //dd($data);
            $order = Orders::create($data);
            //save addresese
            if($this->main_config->allow_shipping){
                $shipping_list = $cart["shipping_list"];
                $order->order_shipping_type = $shipping_list->id;
                $data_shipping["name"]=$cart["shipping_name"];
                $data_shipping["address_1"]=$cart["shipping_address_1"];
                $data_shipping["address_2"]=$cart["shipping_address_2"];
                $data_shipping["province_id"]=$cart["shipping_province_id"];
                $data_shipping["district_id"]=$cart["shipping_district_id"];
                $data_shipping["corregimiento_id"]=$cart["shipping_corregimiento_id"];
                $data_shipping["country_id"]=$cart["shipping_country"];
                $data_shipping["zip_code"]=$cart["shipping_zip_code"];
                $data_shipping["phone_number_1"]=$cart["shipping_phone_number_1"];
                $data_shipping["phone_number_2"]=$cart["shipping_phone_number_2"];
                $data_shipping["email"]=$cart["shipping_email"];
                $data_shipping["address_type"]=1;
                $order->order_shipping = $cart["order_shipping"];
                $data_shipping["order_id"]=$order->id;
                $this->order_addresses->insert($data_shipping);
            }
            if($this->main_config->allow_billing){
                $data_billing["name"]=$cart["billing_name"];
                $data_billing["address_1"]=$cart["billing_address_1"];
                $data_billing["address_2"]=$cart["billing_address_2"];
                $data_billing["province_id"]=$cart["billing_province_id"];
                $data_billing["district_id"]=$cart["billing_district_id"];
                $data_billing["corregimiento_id"]=$cart["billing_corregimiento_id"];
                $data_billing["country_id"]=$cart["billing_country"];
                $data_billing["zip_code"]=$cart["billing_zip_code"];
                $data_billing["phone_number_1"]=$cart["billing_phone_number_1"];
                $data_billing["phone_number_2"]=$cart["billing_phone_number_2"];
                $data_billing["email"]=$cart["billing_email"];
                $data_billing["address_type"]=2;
                $data_billing["order_id"]=$order->id;
                $this->order_addresses->insert($data_billing);
            }
            if($is_credit_card){
                if($status->success){
                    //SAVE PAYMENT HISTORIES
                    $new_payment=[];
                    $new_payment["order_id"]=$order->id;
                    $new_payment["total"]=$grand_total;
                    $new_payment["user_id"]=$order->user_id;
                    $new_payment["transaction_id"]=$status->transaction->id;
                    $new_payment["payment_method"]=$status->transaction->paymentInstrumentType;
                    $new_payment["credit_card_type"]=$status->transaction->creditCard["cardType"];
                    $new_payment["credit_card_number"]=$status->transaction->creditCard["last4"];
                    $new_payment["payment_status"]=$status->transaction->processorResponseText;
                    $new_payment["ip"]=$request->ip();
                    $new_payment["created_at"]=carbon::now();
                    $this->payment_histories->insert($new_payment);
                }
            }
            //save to products
            $new_product=[];
            $data_products_email=[];
            foreach($cart["products"] as $product){
                $new_product["product_id"]=$product["id"];
                $new_product["order_id"]=$order->id;
                $new_product["quantity"]=$product["quantity"];
                $new_product["total"]=$product["total"];
                $new_product["color_id"]=$product["color_id"];
                $new_product["size_id"]=$product["size_id"];
                $new_product["status"]=9;
                $new_product["created_at"]=$today;

                $this->order_products->insert($new_product);

                 //decrease stock number
                 $size_dec = $this->sizes->find($new_product["size_id"]);
                if($size_dec->stock>0){
                    $newstock_quant = $product["quantity"];
                    $newstock = $size_dec->stock - $newstock_quant;
                    $size_dec->stock = $newstock;
                    $size_dec->save();
                }
            }
             //send email to user
            $order_detail = $this->sendEmail($order->id);
           //  send email to client
             Mail::send('emails.orderreceived',["order_detail"=>$order_detail],function($message) use($order_detail){
                 $message->from($this->sender_info["email"],$this->sender_info["name"]);
                 $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                 $subject = __('general.order_section.to_user.received',['name'=>$client_name]);
                 $message->to($order_detail["user"]["email"],$client_name)->subject($subject);
             });
             Session::forget("vestidos_admin_shop");
             Session::forget("discount_apply");
            return redirect()->route('admin_orders')->with("success",__('general.order_section.order_success_created_none'));

    }
    public function confirmDelete($payment_id){
        $data=[];
        $data["payment"]=$this->payment_histories->find($payment_id);
        $data["page_title"]=__('general.payment_section.confirm_cancellation');
        return view("admin/orders/payments/confirm",$data);
    }
    public function deletePayment($payment_id,Request $request){
        $data=[];
        $payment = $this->payment_histories->find($payment_id);
        $order_detail = $this->sendEmail($payment->order_id,$payment_id);
        if($payment->delete()){
            //send email to client
            Mail::send('emails.orderpayment_cancelled',["order_detail"=>$order_detail],function($message) use($order_detail){
                $message->from($this->sender_info["email"],$this->sender_info["name"]);
                $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                $subject = __('emails.order_payment_removed.line_email_title',['name'=>$client_name]);
                $message->to($order_detail["user"]["email"],$client_name)->subject($subject);
            });
            return redirect()->route("admin_order_payments",['order_id'=>$payment->order_id])->with('success',__('general.payment_section.success_deleted'));
        }
        return redirect()->route("admin_order_payments",['order_id'=>$payment->order_id])->with('error',__('general.payment_section.unable_delete'));
    }
    public function deleteConfirmPayments(Request $request){
        $payment_ids = $request["payment_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "payment_ids"=>"required",
        ],$custom_message);
        $payments = $this->payment_histories->getPaymentsByIds($payment_ids);
        $data["confirm_type"] = "name";
        $data["confirm_show_warning"]=true;
        $data["confirm_return"] = route("admin_order_payments",['order_id'=>$payments[0]->col_5]);
        $data["confirm_name"] = "Payments";
        $data["confirm_data"] = $payments;
        $data["confirm_delete_url"]=route('delete_admin_order_payments');
        $data["page_title"]=__('general.payment_section.confirm_cancellations');
       return view("admin/confirm_delete",$data);
    }
    public function sendEmail($order_id,$payment_id=null){
        $order=$this->orders->find($order_id);
        $user_id = $order->user_id;
        $today = carbon::now();
        foreach($order->products as $product){
            $product_detail = $this->products->find($product->getProduct->id);
            $size_detail = $this->sizes->find($product->size_id);
            $color_detail = $this->colors->find($product->color_id);
            $data_products_email[] = array(
                "quantity"=>$product->quantity,
                "total"=>$product->total,
                "color"=>$color_detail->name,
                "size"=>$size_detail->name,
                "name"=>$product_detail->products_name,
                "total"=>$size_detail->total_sale,
                "model"=>$product_detail->product_model,
                "img"=>$product_detail->images()->first()->img_url,
                "id"=>$product_detail->id
            );
        }

        $order_shipping = $order->getOrderShippingAddress();
        $order_billing = $order->getOrderBillingAddress();

        $order_tax = $order->order_tax;
        
        $subtotal = $order->order_total - $order->order_discount;

        $grand_total = ($order->order_total + $order->order_shipping + $order_tax + $order->delivery_speed_cost) - $order->order_discount;


        $order_detail=[
            "user"=>$this->users->find($user_id),
            "order"=>array(                        
                "order_number"=>$order->order_number,
                "purchase_date"=>$today,
                "products"=>$data_products_email,
                "order_total"=>$order->order_total,
                "order_tax"=>$order_tax,
                "discount_app"=>$order->order_discount,
                "status"=>$order->getStatusName->name,
                "subtotal"=>$subtotal,
                "grand_total"=>$grand_total,
                "shipping_total"=>$order->order_shipping,
                "allow_shipping"=>$this->main_config->allow_shipping ? "true" : "false",
                "allow_billing"=>$this->main_config->allow_billing ? "true" : "false",
                "order_grand_total"=>$order->order_total + $order->order_tax + $order->order_shipping,
                "allow_delivery_speed"=>$this->main_config->allow_delivery_time ? "true" : "false",
                "delivery_speed_name"=>null,
                "delivery_speed_total"=>null,
                "delivery_speed_description"=>null,
                "shipping_name"=>null,
                "shipping_address_1"=>null,
                "shipping_address_2"=>null,
                "shipping_province"=>null,
                "shipping_district"=>null,
                "shipping_corregimiento"=>null,
                "shipping_country"=>null,
                "shipping_zip_code"=>null,
                "shipping_phone_number_1"=>null,
                "shipping_phone_number_2"=>null,
                "shipping_email"=>null,
                "billing_name"=>null,
                "billing_address_1"=>null,
                "billing_address_2"=>null,
                "billing_province"=>null,
                "billing_district"=>null,
                "billing_corregimiento"=>null,
                "billing_country"=>null,
                "billing_zip_code"=>null,
                "billing_phone_number_1"=>null,
                "billing_phone_number_2"=>null,
                "billing_email"=>null,
            )
        ];
        
        if($this->main_config->allow_shipping){
            $order_detail["order"]["shipping_name"]=$order_shipping[0]->name;
            $order_detail["order"]["shipping_address_1"]=$order_shipping[0]->address_1;
            $order_detail["order"]["shipping_address_2"]=$order_shipping[0]->address_2;
            $order_detail["order"]["shipping_province"]=$order_shipping[0]->province_name;
            $order_detail["order"]["shipping_district"]=$order_shipping[0]->district_name;
            $order_detail["order"]["shipping_corregimiento"]=$order_shipping[0]->corregimiento_name;
            $order_detail["order"]["shipping_country"]=$order_shipping[0]->country_name;
            $order_detail["order"]["shipping_zip_code"]=$order_shipping[0]->zip_code;
            $order_detail["order"]["shipping_phone_number_1"]=$order_shipping[0]->phone_number_1;
            $order_detail["order"]["shipping_phone_number_2"]=$order_shipping[0]->phone_number_2;
            $order_detail["order"]["shipping_email"]=$order_shipping[0]->email;
        }
        if($this->main_config->allow_billing){               
            $order_detail["order"]["billing_name"]=$order_billing[0]->name;
            $order_detail["order"]["billing_address_1"]=$order_billing[0]->address_1;
            $order_detail["order"]["billing_address_2"]=$order_billing[0]->address_2;
            $order_detail["order"]["billing_province"]=$order_billing[0]->province_name;
            $order_detail["order"]["billing_district"]=$order_billing[0]->district_name;
            $order_detail["order"]["billing_corregimiento"]=$order_billing[0]->corregimiento_name;
            $order_detail["order"]["billing_country"]=$order_billing[0]->country_name;
            $order_detail["order"]["billing_zip_code"]=$order_billing[0]->zip_code;
            $order_detail["order"]["billing_phone_number_1"]=$order_billing[0]->phone_number_1;
            $order_detail["order"]["billing_phone_number_2"]=$order_billing[0]->phone_number_2;
            $order_detail["order"]["billing_email"]=$order_billing[0]->email;
        }
        if($this->main_config->allow_delivery_time){
            $order_detail["order"]["delivery_speed_name"]=$order->delivery_speed_name;
            $order_detail["order"]["delivery_speed_total"]=$order->delivery_speed_total;
            $order_detail["order"]["delivery_speed_description"]=$order->delivery_speed_description;
        }
        if($payment_id){
            $payment = $this->payment_histories->find($payment_id);
            $payments_paid = $this->payment_histories->where("order_id",$order_id)->sum("total");
            $order_detail["payment"]["total_paid"] = $payments_paid;
            $order_detail["payment"]["payment_method"] = $payment["payment_method"];
            $order_detail["payment"]["total"] = $payment["total"];
            $order_detail["payment"]["payment_status"] = $payment["payment_status"];
            $order_detail["payment"]["created_at"] = date('m-d-Y', strtotime($payment["created_at"]));
        }
       return $order_detail;
    }
    public function deletePayments(Request $request){
        $this->validate($request,[
            "item_ids"=>"required",
        ],[
            'required'=>"Please select a item to delete"
        ]);
        $payment_ids = $request["item_ids"];
        $payment_ids_found = $this->payment_histories->getPaymentsByIds($payment_ids);
        $order_id = $payment_ids_found[0]->col_5;
        $order_detail = $this->sendEmail($order_id);
        $order_detail["payments"]=$payment_ids_found;
        foreach($payment_ids as $payment){
            $payment = $this->payment_histories->find($payment);
            $payment->delete();
        }
        Mail::send('emails.orderpayment_cancelled',["order_detail"=>$order_detail],function($message) use($order_detail){
            $message->from($this->sender_info["email"],$this->sender_info["name"]);
            $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
            $subject = __('emails.order_payment_removed.line_email_title',['name'=>$client_name]);
            $message->to($order_detail["user"]["email"],$client_name)->subject($subject);
        });
        return redirect()->route("admin_orders")->with('success',__('general.payment_section.delete_cancellations'));
    }

    public function applyDiscount(){
        $coupon_code=Input::get('data');
        $discount = [];
        $coupon = $this->coupons->where("code","=",$coupon_code)->where("exp_date",">",carbon::today())->limit(1)->get();
        if(count($coupon)){
            // dd($coupon[0]->code);
           if(Session::has("discount_apply")){
                return response()->json(["status"=>false,"msg"=>__('general.cart_title.discount_restriction_applied')]);
           }
           $discount = [
            "id"=>$coupon[0]->id,
            "code"=>$coupon[0]->code,
            "discount"=>$coupon[0]->discount,
            "description"=>$coupon[0]->description,
            "short_desc"=>$coupon[0]->short_desc,
            "exp_date"=>$coupon[0]->exp_date,
            "status"=>true,
            "msg"=>"",
           ];
           Session::forget("discount_apply");
           Session::put("discount_apply",
           $discount
           );
        }else{
            $discount = ["status"=>false,"msg"=>__('general.cart_title.discount_not_found')];
        }
        return response()->json($discount);
    }
    public function removeDiscount(){
        $result = [
            "result"=>false
        ];
        if(Session::has("discount_apply")){
            Session::forget("discount_apply");
            $result["result"]=true;
        }
        return response()->json($result);
    }
}
