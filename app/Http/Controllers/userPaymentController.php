<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosUsers as Users;
use App\Exceptions\Handler;
use Carbon\Carbon as carbon;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosCountries as Countries;
use App\vestidosProvinces as Provinces;
use App\vestidosDistricts as Districts;
use App\vestidosCorregimientos as Corregimientos;
use App\vestidosGenders as Genders;
use App\vestidosLanguages as Languages;
use App\vestidosAddressTypes as AddressTypes;
use App\vestidosUserAddresses as Addresses;
use App\vestidosTaxInfos as Tax;
use App\vestidosShippingLists as ShippingLists;
use App\vestidosOrdersProducts as OrderProducts;
use App\vestidosOrders as Orders;
use App\vestidosOrderAddresses as OrderAddresses;
use App\vestidosColors as Colors;
use App\vestidosSizes as Sizes;
use App\vestidosProducts as Products;
use App\vestidosPaymentHistories as PaymentHistories;
use App\vestidosPaymentTypes as PaymentTypes;
use App\vestidosMainConfigs as MainConfig;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use Mail;
use Braintree_Transaction;
use Auth;

class userPaymentController extends Controller
{
    //
    public function __construct(AddressTypes $addresstypes, Addresses $addresses, Genders $genders, Languages $languages, Users $users, Countries $countries,Brands $brands, Categories $categories, Tax $tax,ShippingLists $shippingLists, OrderProducts $order_products, Orders $orders, Products $products, Colors $colors, Sizes $sizes, PaymentHistories $payment_histories, Provinces $provinces, Districts $districts, Corregimientos $corregimientos,OrderAddresses $orderaddresses,PaymentTypes $paymentTypes, MainConfig $main_config){
        $this->main_config = $main_config->first();
        $this->country=$countries;
        $this->users = $users;
        $this->order_products = $order_products;
        $this->genders=$genders;
        $this->orders = $orders;
        $this->order_addresses = $orderaddresses;
        $this->languages=$languages;
        $this->addresses=$addresses;
        $this->brands=$brands;
        $this->colors = $colors;
        $this->payment_types = $paymentTypes;
        $this->sizes = $sizes;
        $this->products=$products;
        $this->categories = $categories;
        $this->addresstypes = $addresstypes;
        $this->payment_histories = $payment_histories;
        $this->shipping_lists = $shippingLists;
        $this->provinces=$provinces;
        $this->districts=$districts;
        $this->corregimientos=$corregimientos;
        $this->tax_info = $tax->first();
    }
    public function showShipping(){
        if(empty(Session::has("vestidos_shop"))){
            return redirect()->route("home_page");
        }
        $data=[];
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["checkout_menu_prev_link"]="";
        $has_address = $user->getAddresses->first() ? true : false; 

        $data["page_title"] = $has_address ? __('general.page_header.select_shipping') :__('general.page_header.provide_shipping') ;
        $data["provinces"]=$this->provinces->all();

        $data["checkout_menus"]=$this->getCheckoutMenu();
        $data["tax_info"]=$this->tax_info;
        $data["checkout_header_key"]=__('general.cart_title.shipping');
        $data["checkout_btn_name"]=__('buttons.proceed_billing');
        $data["shipping_lists"]=$this->shipping_lists->all();
        return view("/checkout/shipping",$data);
    }
    public function saveShipping(Request $request){
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $has_address = $user->getAddresses->first() ? true : false; 
        $rule=[];
        $data=[];
        $province_required=$request->input('province_required');
        if($has_address){
            $this->validate($request,[
                "shipping_address"=>"required",
                "shipping_method"=>"required"
            ]);
            $shipping = $this->addresses->find($request->input("shipping_address"));
            $shipping_name = $shipping->first_name;
            if(!empty($shipping->middle_name)){
                $shipping_name .= " ".$shipping->middle_name;
            }
            $shipping_name .= " ".$shipping->last_name;
            $cart_data = array(
                "shipping_name"=>$shipping_name,
                "shipping_address_1"=>$shipping->address_1,
                "shipping_address_2"=>$shipping->address_2,
                "shipping_district"=>$shipping->getDistrict->name,
                "shipping_district_id"=>$shipping->district_id,
                "shipping_corregimiento"=>$shipping->getCorregimiento->name,
                "shipping_corregimiento_id"=>$shipping->corregimiento_id,
                "shipping_province_id"=>$shipping->province_id,
                "shipping_province"=>$shipping->getProvince->name,
                "shipping_country_id"=>$shipping->country_id,
                "shipping_country"=>$shipping->getCountry->countryCode,
                "shipping_zip_code"=>$shipping->zip_code,
                "shipping_phone_number_1"=>$shipping->phone_number_1,
                "shipping_phone_number_2"=>$shipping->phone_number_2,
                "shipping_email"=>$shipping->email,
                "shipping_method"=>$request->input("shipping_method")
            );
        }
        else{
            $this->validate($request,[
                "shipping_name"=>"required",
                "shipping_address_1"=>"required",
                "country"=>"required",
                "province"=>"required",
                "district"=>"required",
                "corregimiento"=>"required",
                "zip_code"=>"required",
                "shipping_phone_number_1"=>"required",
                "shipping_email"=>"required",
                "shipping_method"=>"required",
            ]);
            $shipping_province = $this->provinces->find($request->input("province"));
            $shipping_district=$this->districts->find($request->input("district"));
            $shipping_corregimiento=$this->corregimientos->find($request->input("corregimiento"));
            $shipping_country=$this->country->find($request->input("country"));

            $data["province"] = $shipping_province->name;
            $data["province_id"] = $shipping_province->id;
            $data["district"]= $shipping_district->name;
            $data["district_id"]= $shipping_district->id;
            $data["country"]=$shipping_country->countryCode;
            $data["country_id"]=$shipping_country->id;
            $data["shipping_name"]=$request->input("shipping_name");
            $data["shipping_address_1"]=$request->input("shipping_address_1");
            $data["shipping_address_2"]=$request->input("shipping_address_2");
            $data["zip_code"]=$request->input("zip_code");
            $data["shipping_phone_number_1"]=$request->input("shipping_phone_number_1");
            $data["shipping_phone_number_2"]=$request->input("shipping_phone_number_1");
            $data["shipping_email"]=$request->input("shipping_email");

            $cart_data = array(
                "shipping_name"=>$request->input("shipping_name"),
                "shipping_address_1"=>$request->input("shipping_address_1"),
                "shipping_address_2"=>$request->input("shipping_address_2"),
                "shipping_district"=>$shipping_district->name,
                "shipping_district_id"=>$shipping_district->id,
                "shipping_corregimiento"=>$shipping_corregimiento->name,
                "shipping_corregimiento_id"=>$shipping_corregimiento->id,
                "shipping_province_id"=>$shipping_province->id,
                "shipping_province"=>$shipping_province->name,
                "shipping_country_id"=>$shipping_country->id,
                "shipping_country"=>$shipping_country->countryCode,
                "shipping_zip_code"=>$request->input("zip_code"),
                "shipping_phone_number_1"=>$request->input("shipping_phone_number_1"),
                "shipping_phone_number_2"=>$request->input("shipping_phone_number_2"),
                "shipping_email"=>$request->input("shipping_email"),
                "shipping_method"=>$request->input("shipping_method")
            );
        }
       // dd($cart_data);
         $request->session()->put("cart_session",$cart_data);
        return redirect()->route("checkout_show_billing")->with($data);
    }
    public function getCheckoutMenu(){
        if($this->main_config->allow_shipping){
            $options = array(
                array(
                    "name"=>__('general.cart_title.shipping'),
                    "url"=>route("checkout_show_shipping")
                ),
                array(
                    "name"=>__('general.cart_title.billing'),
                    "url"=>route("checkout_show_shipping")
                ),
                array(
                    "name"=>__('general.cart_title.confirmation'),
                    "url"=>route("checkout_show_shipping")
                )
            );
        }else{
            $options = array(
                array(
                    "name"=>__('general.cart_title.billing'),
                    "url"=>route("checkout_show_shipping")
                ),
                array(
                    "name"=>__('general.cart_title.confirmation'),
                    "url"=>route("checkout_show_shipping")
                )
            );
        };

        return $options;
    }
    public function showBilling(Request $request){
        if(empty(Session::has("vestidos_shop"))){
            return redirect()->route("home_page");
        }
        $data=[];
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["checkout_menu_prev_link"]=array("name"=>__('general.cart_title.shipping'),"url"=>route('checkout_show_shipping'));

        $has_address = $user->getAddresses->first() ? true : false; 

        $data["page_title"] = $has_address ? __('general.page_header.choose_billing_payment') : __('general.page_header.provide_billing_payment');

        $data["checkout_menus"]=$this->getCheckoutMenu();
        $cart = $request->session()->get('cart_session');
        $data["payment_types"]=$this->payment_types->where("status",1)->get();
        $data["tax_info"]=$this->tax_info;
        if($this->main_config->allow_shipping){
            $shipping_cost=$this->shipping_lists->find($cart["shipping_method"]);
            $data["shipping_cost"]=$shipping_cost->total;
            $data["shipping_info"] = $cart;
            $data["shipping_method"]=$this->shipping_lists->find($cart["shipping_method"]);
            $data["shipping_lists"]=$this->shipping_lists->all();
        }
        $data["main_config"]=$this->main_config;
        $data["provinces"]=$this->provinces->all();
        $data["address_id"]=$request->input("address_id");
        $data["checkout_header_key"]=__('general.cart_title.billing');
        $data["checkout_btn_name"]=__('buttons.submit_payment');

        return view("/checkout/billing",$data);
    }
    public function processPayment(Request $request){
        //if no session is available, redirect
        if($this->main_config->allow_shipping && empty($request->session()->has('cart_session'))){
            return redirect()->back()->withErrors([
                'required' => __('general.empty_msg.cart')
            ]);
        }
        $province_required=$request->input('province_required');
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $has_address = $user->getAddresses->first() ? true : false; 

        if($this->main_config->allow_shipping){
            $cart_address = $request->session()->get('cart_session');
            $data_shipping["name"]=$cart_address["shipping_name"];
            $data_shipping["address_1"]=$cart_address["shipping_address_1"];
            $data_shipping["address_2"]=$cart_address["shipping_address_2"];
            $data_shipping["district_id"]=$cart_address["shipping_district_id"];
            $data_shipping["province_id"]=$cart_address["shipping_province_id"];
            $data_shipping["corregimiento_id"]=$cart_address["shipping_corregimiento_id"];
            $data_shipping["country_id"]=$cart_address["shipping_country_id"];
            $data_shipping["zip_code"]=$cart_address["shipping_zip_code"];
            $data_shipping["phone_number_1"]=$cart_address["shipping_phone_number_1"];
            $data_shipping["phone_number_2"]=$cart_address["shipping_phone_number_2"];
            $data_shipping["email"]=$cart_address["shipping_email"];
            $data_shipping["address_type"]=1;
            $shipping_list = $this->shipping_lists->find($cart_address["shipping_method"]);
            $data["order_shipping_type"]=$shipping_list->id;
            $data["order_shipping"]=$shipping_list->total;
        }
        $province_id=null;
        $province_name=null;
        $city=null;
        $state=null;
        if($has_address){
            $this->validate($request,[
                "billing_address"=>"required"
            ]);
            $billing_id= $request->input("billing_address");
           // $shipping_id=$cart_address["shipping_method"];

           // $shipping= $this->addresses->find($shipping_id);
            $billing = $this->addresses->find($billing_id);
            $billing_province = $billing->getProvince->name;
            $billing_district = $billing->getDistrict->name;
            $billing_corregimiento = $billing->getCorregimiento->name;
            $billing_country= $billing->getCountry->countryCode;

            $billing_name = $billing->first_name;
            if(!empty($billing->middle_name)){
                $billing_name .= " ".$billing->middle_name;
            }
            $billing_name .= " ".$billing->last_name;

            $data_billing["name"]=$billing_name;
            $data_billing["address_1"]=$billing->address_1;
            $data_billing["address_2"]=$billing->address_2;
            $data_billing["province_id"]=$billing->province_id;
            $data_billing["district_id"]=$billing->district_id;
            $data_billing["corregimiento_id"]=$billing->corregimiento_id;
            $data_billing["country_id"]=$billing->getCountry->id;
            $data_billing["zip_code"]=$billing->zip_code;
            $data_billing["phone_number_1"]=$billing->phone_number_1;
            $data_billing["phone_number_2"]=$billing->phone_number_2;
            $data_billing["email"]=$billing->email;
            $data_billing["address_type"]=2;
        
        }else{

            // $data["province"] = $request->input("province");
            // $data["district"] = $request->input("district");
            // $data["corregimiento"] = $request->input("corregimiento");

            $this->validate($request,[
                "billing_name"=>"required",
                "billing_address_1"=>"required",
                "country"=>"required",
                "district"=>"required",
                "corregimiento"=>"required",
                "zip_code"=>"required",
                "billing_phone_number_1"=>"required",
                "billing_email"=>"required",
            ]);

            
            $province = $this->provinces->find($request->input("province"));
            $district = $this->districts->find($request->input("district"));
            $corregimiento = $this->corregimientos->find($request->input("corregimiento"));
            $country= $this->country->find($request->input("country"));

            $billing_province = $province->name;
            $billing_district = $district->name;
            $billing_corregimiento = $corregimiento->name;
            $billing_country= $country->countryCode;


            $billing_country= $country->countryCode;


            $billing_name = $request->input("billing_name");
            $data_billing["name"]=$billing_name;
            $data_billing["address_1"]=$request->input("billing_address_1");
            $data_billing["address_2"]=$request->input("billing_address_2");
            $data_billing["district_id"]=$request->input("district");
            $data_billing["corregimiento_id"]=$request->input("corregimiento");
            $data_billing["province_id"]=$request->input("province");
            $data_billing["country_id"]=$request->input("country");
            $data_billing["zip_code"]=$request->input("zip_code");
            $data_billing["phone_number_1"]=$request->input("billing_phone_number_1");
            $data_billing["phone_number_2"]=$request->input("billing_phone_number_2");
            $data_billing["email"]=$request->input("billing_email");
            $data_billing["address_type"]=2;

        }
        
        $nonce = $request->input('nonce', false);
        $today = carbon::now();
        $todayf = $today->format("dmY");
        $random = rand(0,99);
        $order_number = "VES-".$todayf.$user_id.$random;

        //GET TOTAL
        $data_products = [];
        $data_products_email = [];
        $subtotal = 0;
        $total = 0;
        $tax = 0;
        $cart=Session::get("vestidos_shop");
        for($i=0;$i<sizeof($cart);$i++){
            $total += $cart[$i]["quantity"] * $cart[$i]["total"];
        }
        $tax = $this->tax_info->tax / 100;
        $subtotal = ($total * $tax) + $total;
        $grand_total = $this->main_config->allow_shipping ? $subtotal+$shipping_list->total : $subtotal;
        
        //PREPARE DATA
        $data["user_id"]=$user_id;
        $data["order_number"]=$order_number;
        $data["purchase_date"]=$today;
        


        $data["order_total"]=$total;
        $data["order_tax"]=$total * $tax;

        $data["ip"]=$request->ip();
        $data["created_at"]=$today;
        $is_credit_card = $request->input("payment_type") == 4 ? true : false;
        $data["status"]=$is_credit_card ? 9 : 12;
        $data["payment_type"]=$request->input("payment_type");
         //dd($data);
        // dd($data_shipping);
        $order = Orders::create($data);

        $data["user"]=$user;
        $data["page_title"]=__('general.thank_you');
        $data["checkout_menus"]=$this->getCheckoutMenu();
        $data["province_required"]=$province_required;
        if(!empty($order->id)){
            //save addresese
            $data_shipping["order_id"]=$order->id;
            $data_billing["order_id"]=$order->id;
            $this->order_addresses->insert($data_shipping);
            $this->order_addresses->insert($data_billing);
            for($i=0;$i<sizeof($cart);$i++){
                $data_products[] = array(
                    "order_id"=>$order->id,
                    "product_id"=>$cart[$i]["id"],
                    "quantity"=>$cart[$i]["quantity"],
                    "total"=>$cart[$i]["total"],
                    "color_id"=>$cart[$i]["color_id"],
                    "color_id"=>$cart[$i]["color_id"],
                    "size_id"=>$cart[$i]["size_id"],
                    "status"=>9,
                    "created_at"=>$today
                );

                //for email
                $product_detail = $this->products->find($cart[$i]["id"]);
                $size_detail = $this->sizes->find($cart[$i]["size_id"]);
                $color_detail = $this->colors->find($cart[$i]["color_id"]);
                

                //decrease stock number
                $size_dec = $this->sizes->find($cart[$i]["size_id"]);
                if($size_dec->stock > 0){
                    $newstock_quant = (int)$cart[$i]["quantity"];
                    $newstock = $size_dec->stock - $newstock_quant;
                    $size_dec->stock = $newstock;
                    $size_dec->save();
                }

                $data_products_email[] = array(
                    "quantity"=>$cart[$i]["quantity"],
                    "total"=>$cart[$i]["total"],
                    "color"=>$color_detail->name,
                    "size"=>$size_detail->name,
                    "name"=>$product_detail->products_name,
                    "total"=>$size_detail->total_sale,
                    "model"=>$product_detail->product_model,
                    "img"=>$product_detail->images()->first()->img_url,
                    "id"=>$product_detail->id
                );
            }
            if(count($data_products)>0){
                if($this->order_products->insert($data_products)){
                    $get_order = $this->orders->find($order->id);
                    if($is_credit_card){
                        $status = Braintree_Transaction::sale([
                            'amount' => $grand_total,
                            'paymentMethodNonce' => $nonce,
                            'options' => [
                                'submitForSettlement' => True
                            ]
                        ]);
                        if($status->success){
                            //SAVE PAYMENT HISTORIES
                            $new_payment=[];
                            $new_payment["order_id"]=$get_order->id;
                            $new_payment["total"]=$grand_total;
                            $new_payment["user_id"]=$get_order->user_id;
                            $new_payment["transaction_id"]=$status->transaction->id;
                            $new_payment["payment_method"]=$status->transaction->paymentInstrumentType;
                            $new_payment["credit_card_type"]=$status->transaction->creditCard["cardType"];
                            $new_payment["credit_card_number"]=$status->transaction->creditCard["last4"];
                            $new_payment["payment_status"]=$status->transaction->processorResponseText;
                            $new_payment["ip"]=$request->ip();
                            $new_payment["created_at"]=$today;
                            $this->payment_histories->insert($new_payment);
                        }else{
                            $get_order->delete();
                            return redirect()->back()->withErrors([
                                'required' => $status->message
                            ]);
                        }
                    }

                    
                    //SEND EMAIL

                    if($this->main_config->allow_shipping){
                        $ds_country = $this->country->find($cart_address["shipping_country_id"]);
                        $package = array(                        
                            "order_number"=>$order_number,
                            "purchase_date"=>$today,
                            "shipping_name"=>$cart_address["shipping_name"],
                            "shipping_address_1"=>$cart_address["shipping_address_1"],
                            "shipping_address_2"=>$cart_address["shipping_address_2"],
                            "shipping_province"=>$cart_address["shipping_province"],
                            "shipping_district"=>$cart_address["shipping_district"],
                            "shipping_corregimiento"=>$cart_address["shipping_corregimiento"],
                            "shipping_country"=>$ds_country->countryCode,
                            "shipping_zip_code"=>$cart_address["shipping_zip_code"],
                            "shipping_phone_number_1"=>$cart_address["shipping_phone_number_1"],
                            "shipping_phone_number_2"=>$cart_address["shipping_phone_number_2"],
                            "shipping_email"=>$cart_address["shipping_email"],
                            "shipping_total"=>$shipping_list->total,
                            "billing_name"=>$data_billing["name"],
                            "billing_address_1"=>$data_billing["address_1"],
                            "billing_address_2"=>$data_billing["address_2"],
                            "billing_district"=>$billing_district,
                            "billing_province"=>$billing_province,
                            "billing_corregimiento"=>$billing_corregimiento,
                            "billing_country"=>$billing_country,
                            "billing_zip_code"=>$data_billing["zip_code"],
                            "billing_phone_number_1"=>$data_billing["phone_number_1"],
                            "billing_phone_number_2"=>$data_billing["phone_number_2"],
                            "billing_email"=>$data_billing["email"],
                            "products"=>$data_products_email,
                            "order_total"=>$total,
                            "order_tax"=>$tax,
                            "status"=>$get_order->getStatusName->name,
                            "allow_shipping"=>$this->main_config->allow_shipping==true ? "true" : "false",
                        );
                    }else{
                        $package = array(                        
                            "order_number"=>$order_number,
                            "purchase_date"=>$today,
                            "billing_name"=>$data_billing["name"],
                            "billing_address_1"=>$data_billing["address_1"],
                            "billing_address_2"=>$data_billing["address_2"],
                            "billing_district"=>$billing_district,
                            "billing_province"=>$billing_province,
                            "billing_corregimiento"=>$billing_corregimiento,
                            "billing_country"=>$billing_country,
                            "billing_zip_code"=>$data_billing["zip_code"],
                            "billing_phone_number_1"=>$data_billing["phone_number_1"],
                            "billing_phone_number_2"=>$data_billing["phone_number_2"],
                            "billing_email"=>$data_billing["email"],
                            "products"=>$data_products_email,
                            "order_total"=>$total,
                            "order_tax"=>$tax,
                            "status"=>$get_order->getStatusName->name,
                            "allow_shipping"=>$this->main_config->allow_shipping==true ? "true" : "false",
                        );
                    }
                    $order_detail=[
                        "user"=>$this->users->find($user_id),
                        "order"=>$package
                    ];
                    
                    $email_msg = [];
                    try{
                        //send email to client
                        Mail::send('emails.orderreceived',["order_detail"=>$order_detail],function($message) use($order_detail){
                            $message->from("info@vestidosboutique.com","Vestidos Boutique");
                            $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                            $subject = __('general.order_section.to_user.received',['name'=>$client_name]);
                            //$message->to($order_detail["user"]["email"],$client_name)->subject($subject);
                            $message->to("evil_luis@hotmail.com",$client_name)->subject($subject);
                        });

                        //send email to admin
                        Mail::send('emails.admin_orderreceived',["order_detail"=>$order_detail],function($message) use($order_detail){
                            $message->from("info@vestidosboutique.com","Vestidos Boutique");
                            $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                            $subject = __('general.order_section.to_admin.received',['name'=>$client_name]);
                            //$message->to("info@vestidosboutique.com","Admin")->subject($subject);
                            $message->to("evil_luis@hotmail.com","Admin")->subject($subject);
                        });
                        $email_msg[]=__('general.order_section.payment_success');
                    }catch(Exception $e){
                        $email_msg[]=__('general.order_section.payment_success');
                        $email_msg[]=__('general.failed_email');
                    }

                    


                    // DESTROY SESSION
                    $request->session()->forget('cart_session');
                    $request->session()->forget('vestidos_shop');
                    
                    $request->session()->flash('alert-success',$email_msg);
                    return redirect()->route("checkout_order_received");
                }
            }
       }

    //    return redirect()->route("checkout_order_received");
    }
    public function showOrderReceived(){
        $data=[];
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $last_order=$user->orders()->orderBy('created_at','desc')->first();
        $data["last_order"]=$last_order;
        $data["checkout_menu_prev_link"]="";
        $data["page_title"]=__('general.order_section.order_success_received');

        $data["checkout_menus"]=$this->getCheckoutMenu();
        $data["tax_info"]=$this->tax_info;
        $data["checkout_header_key"]=__('general.page_header.confirmation');
        $data["checkout_btn_name"]=__('buttons.back_home');
        $data["thankyou_msg"]=__('general.order_section.received_to_process');
        $data["thankyou_img"]="checked.svg";
        $data["thankyou_status"]=true;
        if(empty(Session::has("alert-success"))){
            $data["page_title"]="Ops!";
            $data["thankyou_msg"]=__('general.access_section.denied');
            $data["thankyou_img"]="close_2.svg";
            $data["thankyou_status"]=false;
        }
       return view("/checkout/confirmation",$data);
    }
    
}
