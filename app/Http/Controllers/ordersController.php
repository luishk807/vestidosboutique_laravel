<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosOrders as Orders;
use App\vestidosOrdersProducts as OrdersProducts;
use App\vestidosStatus as vestidosStatus;
use App\vestidosUsers as Users;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use App\vestidosCoupons as Coupons;
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
use Braintree;
use Mail;
use Auth;
use Session;

class ordersController extends Controller
{
    //
    public function __construct(Addresses $addresses, Products $products, Users $users, vestidosStatus $vestidosStatus, Orders $orders,OrdersProducts $order_products,CancelReasons $cancel_reasons,ShippingLists $shippingLists, Countries $countries,Sizes $sizes,Colors $colors,PaymentHistories $payment_histories,AddressTypes $address_types,Tax $tax,OrderAddresses $orderaddresses,Provinces $provinces, Districts $districts, Corregimientos $corregimientos,PaymentTypes $paymentTypes, MainConfig $main_config, Coupons $coupons){
        $this->statuses=$vestidosStatus;
        $this->orders=$orders;
        $this->order_products=$order_products;
        $this->users=$users;
        $this->countries = $countries;
        $this->provinces=$provinces;
        $this->districts=$districts;
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
    public function index(){
        $data=[];
        $data["main_items"]=$this->orders->orderBy('created_at','desc')->paginate(10);
        $data["page_submenus"]=[
            [
                "url"=>route('admin_new_order'),
                "name"=>"Add Order"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_orders');
        $data["page_title"]=__('header.orders');
        return view("admin/orders/home",$data);
    }
    public function getAddressDropdown(){
        $user_id=Input::get('data');
        $users = $this->users->find($user_id);
        return response()->json($users->getAddresses()->get());
    }
    public function getProductDropdown(){
        $product_id=Input::get('data');
        $product = $this->products->find($product_id);
        return response()->json($product);
    }
    public function newOrders(){
        $data=[];
        $data["users"]=$this->users->all();
        $data["products"]=$this->products->all();
        $data["page_title"]=__('general.order_section.new_order');
        return view("admin/orders/new",$data);
    }
    public function createOrder(Request $request){
        $data=[];
        $user_id=(int)$request->input("user");
        $data["user_id"]=$user_id;
        $data["purchase_date"]=$request->input("purchase_date");
        $data["status"]=(int)$request->input("status");
        $ip=$request->ip();
        $data["ip"]=$ip;
        $this->validate($request,[
            "user"=>"required",
            "purchase_date"=>"required",
            "status"=>"required"
        ]
        );

        if(Session::has("vestidos_admin_shop")){
            Session::forget("vestidos_admin_shop");
        }
        Session::put("vestidos_admin_shop",$data);
        return redirect()->route("admin_show_new_order_address");
        
    }
    public function editOrder($order_id){
        $data=[];
        $order =$this->orders->find($order_id);
        $data["page_submenus"]=[
            [
                "url"=>route('admin_orders'),
                "name"=>"Back to Orders"
            ],
            [
                "url"=>route('admin_order_products',['order_id'=>$order_id]),
                "name"=>"[".$order->products()->count()."] View products"
            ],
            [
                "url"=>route('admin_show_order_payment',['order_id'=>$order_id]),
                "name"=>"[".$order->paymentHistories()->count()."] Re-process Payment"
            ]
        ];
        $data["order"]=$order;
        $data["order_id"]=$order_id;
        
        $data["coupons"] = $this->coupons->where("status",1)->orderBy("created_at","desc")->get();

        $user=$this->users->find($order->user_id);
        $data["users"]=$this->users->all();
        $data["products"]=$this->products->all();
        $data["shipping_lists"]=$this->shipping_lists->all();
        $amount_paid = $this->payment_histories->where("order_id",$order_id)->sum('total');
        $amount_due = (($order->order_total + $order->order_tax)- $order->order_discount) - $amount_paid;
        $data["amount_due"]=$amount_due;
        $order_shipping = $order->getOrderShippingAddress();
        $data["order_shipping"]=$order->order_shipping ?  $order_shipping[0] : null;
        $order_billing = $order->getOrderBillingAddress();
        $data["order_billing"]=$order->order_billing ? $order_billing[0] : null;
        $data["page_title"]=__('general.order_section.edit_order')." ".$order->order_number;
        return view("admin/orders/edit",$data);
    }
    public function showOrderAddress(){
        $data=[];
        $user=[];
        if(Session::has("vestidos_admin_shop")){
            $session=Session::get("vestidos_admin_shop");
            $user = $this->users->find($session["user_id"]);
        }
        $data["page_submenus"]=[
            [
                "url"=>route('admin_newaddress',['user_id'=>$user->id]),
                "name"=>"Add New Address"
            ]
        ];
        $data["user"]=$user;
        $data["shipping_lists"]=$this->shipping_lists->all();
        $data["address_types"]=$this->address_types->all();
        $data["user_adresses"]=$this->addresses->all();
        $data["provinces"]=$this->provinces->all();
        $data["page_title"]=__('general.order_section.new_order_address');
        return view("admin/orders/addresses/new",$data);
    }
    public function createOrderAddress(Request $request){
        $data=[];
        if(Session::has("vestidos_admin_shop")){
            $data=Session::get("vestidos_admin_shop");
            $user = $this->users->find($data["user_id"]);
        }else{
            return redirect()->route('admin_orders')->with("error",__('general.access_section.invalid_access'));
        }
        $addresses=$request->input("addresses");
        if(count($addresses) < 1){
            $this->validate($request,[
                "name"=>"required",
                "address_1"=>"required",
                "country"=>"required",
                "zip_code"=>"required",
                "phone_number_1"=>"required",
                "email"=>"required"
            ]);
        }
        foreach($addresses as $address){
            $address_type = $this->address_types->find($address["address_type"]);
            if($address["address_type"]==1 && $this->main_config->allow_shipping){
                if(array_key_exists('user_address_id', $address)){
                    $user_address=$this->addresses->find($address["user_address_id"]);
                    $country = $this->countries->find($user_address->country_id);
                    $data["shipping_name"]=$user_address->getFullName();
                    $data["shipping_address_1"]=$user_address->address_1;
                    $data["shipping_address_2"]=$user_address->address_2;
                    $data["shipping_province_id"]=$user_address->province_id;
                    $data["shipping_province"]=$user_address->getProvince->name;
                    $data["shipping_district_id"]=$user_address->district_id;
                    $data["shipping_district"]=$user_address->getDistrict->name;
                    $data["shipping_corregimiento_id"]=$user_address->corregimiento_id;
                    $data["shipping_corregimiento"]=$user_address->getCorregimiento->name;
                    $data["shipping_country"]=$user_address->country_id;
                    $data["shipping_country_name"] = $country->countryCode;
                    $data["shipping_zip_code"]=$user_address->zip_code;
                    $data["shipping_phone_number_1"]=$user_address->phone_number_1;
                    $data["shipping_phone_number_2"]=$user_address->phone_number_2;
                    $data["shipping_email"]=$user_address->email;
                }else{
                    $country = $this->countries->find($address["country"]);
                    $province = $this->provinces->find($address["province"]);
                    $district = $this->districts->find($address["district"]);
                    $corregimiento = $this->corregimientos->find($address["corregimiento"]);
                    $data["shipping_name"]=$address["name"];
                    $data["shipping_address_1"]=$address["address_1"];
                    $data["shipping_address_2"]=$address["address_2"];
                    $data["shipping_province_id"]=$province->id;
                    $data["shipping_province"]=$province->name;
                    $data["shipping_district_id"]=$district->id;
                    $data["shipping_district"]=$district->name;
                    $data["shipping_corregimiento_id"]=$corregimiento->id;
                    $data["shipping_corregimiento"]=$corregimiento->name;
                    $data["shipping_country"]=$address["country"];
                    $data["shipping_country_name"] = $country->countryCode;
                    $data["shipping_zip_code"]=$address["zip_code"];
                    $data["shipping_phone_number_1"]=$address["phone_number_1"];
                    $data["shipping_phone_number_2"]=$address["phone_number_2"];
                    $data["shipping_email"]=$address["email"];
                }
            }
            if($address["address_type"]==2  && $this->main_config->allow_billing){
                if(array_key_exists('user_address_id', $address)){
                    $user_address=$this->addresses->find($address["user_address_id"]);
                    $country = $this->countries->find($user_address->country_id);
                    $data["billing_name"]=$user_address->getFullName();
                    $data["billing_address_1"]=$user_address->address_1;
                    $data["billing_address_2"]=$user_address->address_2;
                    $data["billing_province_id"]=$user_address->province_id;
                    $data["billing_province"]=$user_address->getProvince->name;
                    $data["billing_district_id"]=$user_address->district_id;
                    $data["billing_district"]=$user_address->getDistrict->name;
                    $data["billing_corregimiento_id"]=$user_address->corregimiento_id;
                    $data["billing_corregimiento"]=$user_address->getCorregimiento->name;
                    $data["billing_country"]=$user_address->country_id;
                    $data["billing_country_name"] = $country->countryCode;
                    $data["billing_zip_code"]=$user_address->zip_code;
                    $data["billing_phone_number_1"]=$user_address->phone_number_1;
                    $data["billing_phone_number_2"]=$user_address->phone_number_2;
                    $data["billing_email"]=$user_address->email;
                }else{
                    $country = $this->countries->find($address["country"]);
                    $province = $this->provinces->find($address["province"]);
                    $district = $this->districts->find($address["district"]);
                    $corregimiento = $this->corregimientos->find($address["corregimiento"]);
                    $data["billing_name"]=$address["name"];
                    $data["billing_address_1"]=$address["address_1"];
                    $data["billing_address_2"]=$address["address_2"];
                    $data["billing_province_id"]=$province->id;
                    $data["billing_province"]=$province->name;
                    $data["billing_district_id"]=$district->id;
                    $data["billing_district"]=$district->name;
                    $data["billing_corregimiento_id"]=$corregimiento->id;
                    $data["billing_corregimiento"]=$corregimiento->name;
                    $data["billing_country"]=$address["country"];
                    $data["billing_country_name"] = $country->countryCode;
                    $data["billing_zip_code"]=$address["zip_code"];
                    $data["billing_phone_number_1"]=$address["phone_number_1"];
                    $data["billing_phone_number_2"]=$address["phone_number_2"];
                    $data["billing_email"]=$address["email"];
                }
            }
        }
        $shipping_list=$this->shipping_lists->find($request->input("shipping_list"));
        $data["shipping_list"]=$shipping_list;
        if(Session::has("vestidos_admin_shop")){
            Session::forget("vestidos_admin_shop");
        }
        Session::put("vestidos_admin_shop",$data);
        return redirect()->route("admin_new_order_products");
        
    }
    public function editOrderAddress(Request $request, $order_id,$address_type_id){
        $data=[];
        $order =$this->orders->find($order_id);
        $data["order"]=$order;
        $address_var = $address_type_id==1? __('general.cart_title.shipping') : __('general.cart_title.billing');
        $order_shipping = $order->getOrderShippingAddress();
        $order_billing = $order->getOrderBillingAddress();
        $data["order_id"]=$order_id;
        $data["address_var"]=$address_var;
        $data["page_title"]=__('general.order_section.edit_order_address',["name"=>$address_var])." ".$order->order_number;
        $data["address_type_id"]=$address_type_id;
        $data["name"]=$request->input("name");
        $data["email"]=$request->input("email");
        $data["phone_number_1"]=$request->input("phone_number_1");
        $data["phone_number_2"]=$request->input("phone_number_2");
        $data["address_1"]=$request->input("address_1");
        $data["address_2"]=$request->input("address_2");
        $data["province"]=$request->input("province");
        $data["district"]=$request->input("district");
        $data["corregimiento"]=$request->input("corregimiento");
        $data["country"]=$request->input("country");
        $data["zip_code"]=$request->input("zip_code");
        $data["provinces"]=$this->provinces->all();

        if($address_type_id==1){
            $data["districts"]=$this->districts->where("province_id",$order_shipping[0]->province_id)->get();
            $data["corregimientos"]=$this->corregimientos->where("districts_id",$order_shipping[0]->district_id)->get();
            $data["address"]=$order_shipping[0];
        }else if($address_type_id==2){
            $data["districts"]=$this->districts->where("province_id",$order_billing[0]->province_id)->get();
            $data["corregimientos"]=$this->corregimientos->where("districts_id",$order_billing[0]->district_id)->get();
            $data["address"]=$order_billing[0];
        }
        return view("admin/orders/addresses/edit",$data);
    }
    public function saveOrderAddress(Request $request){
        $data=[];
        $this->validate($request,[
            "name"=>"required",
            "email"=>"required",
            "phone_number_1"=>"required",
            "address_1"=>"required",
            "province"=>"required",
            "district"=>"required",
            "corregimiento"=>"required",
            "country"=>"required",
            "zip_code"=>"required"
        ]);
        $order_id=$request->input("order_id");
        $address_type_id=$request->input("address_type_id");
        $order =$this->orders->find($order_id);
        $address_var = $address_type_id==1? __('general.cart_title.shipping') : __('general.cart_title.billing');
        $data["order_id"]=$order_id;
        $data["address_var"]=$address_var;
        $data["page_title"]= __('general.order_section.edit_order_address',["name"=>$address_var]);

        if($address_type_id==1){
            $order_update = $this->order_addresses->where("order_id",$order->id)->where("address_type",1)->update(
                [
                    "name"=>$request->input("name"),
                    "email"=>$request->input("email"),
                    "phone_number_1"=>$request->input("phone_number_1"),
                    "phone_number_2"=>$request->input("phone_number_2"),
                    "address_1"=>$request->input("address_1"),
                    "address_2"=>$request->input("address_2"),
                    "province_id"=>$request->input("province"),
                    "district_id"=>$request->input("district"),
                    "corregimiento_id"=>$request->input("corregimiento"),
                    "country_id"=>$request->input("country"),
                    "zip_code"=>$request->input("zip_code")
                ]
            );

        }else if($address_type_id==2){
            $order_update = $this->order_addresses->where("order_id",$order->id)->where("address_type",2)->update([
                "name"=>$request->input("name"),
                "email"=>$request->input("email"),
                "phone_number_1"=>$request->input("phone_number_1"),
                "phone_number_2"=>$request->input("phone_number_2"),
                "address_1"=>$request->input("address_1"),
                "address_2"=>$request->input("address_2"),
                "province_id"=>$request->input("province"),
                "district_id"=>$request->input("district"),
                "corregimiento_id"=>$request->input("corregimiento"),
                "country_id"=>$request->input("country"),
                "zip_code"=>$request->input("zip_code"),
            ]);
        }
        if($order_update){
            return redirect()->route("admin_edit_order",["order_id"=>$order_id])->with("success",__('general.order_section.address_saved'));
        }
        return redirect()->back()->withErrors([
            "required"=>__('general.unable_save')
        ]);
    }
    public function saveOrder($order_id,Request $request){
        $data=[];
        $order =$this->orders->find($order_id);
        $shipping_list = $this->shipping_lists->find($request->input("shipping_method"));
        $data["order_id"]=$order_id;
        $data["purchase_date"]=$request->input("purchase_date");
        $data["order_quantity"]=(int)$request->input("order_quantity");
        $data["order_total"]=$request->input("order_total");
        $data["order_tax"]=$request->input("order_tax");
        $data["status"]=(int)$request->input("status");
        $data["ip"]=$request->ip();
        $this->validate($request,[
            "user"=>"required",
            "purchase_date"=>"required",
            "order_total"=>"required",
            "order_tax"=>"required",
            "status"=>"required",
        ]);
        $current_status=$order->status;
        $order->updated_at=carbon::now();
        $order->user_id=(int)$request->input("user");
        $order->purchase_date=$request->input("purchase_date");
        if($this->main_config->allow_shipping){
            $data["shipping_date"]=$request->input("shipping_date");
            $data["shipping_method"]=$request->input("shipping_method");
            $order->shipping_date=$request->input("shipping_date");
            $order->order_shipping_type= $this->main_config->allow_shipping ? (int)$request->input("shipping_method") : null;
            $order->order_shipping = $this->main_config->allow_shipping ? $shipping_list->total : null;
        }

        $order->order_total=$request->input("order_total");
        $order->order_tax=$request->input("order_tax");
        $order->status=(int)$request->input("status");
        if($order->status==2){
            $order->order_total_refund=$request->input("order_total_refund");
            $order->order_refund_date=$request->input("order_refund_date");
        }
        $order->ip=$request->ip();
        $order->save();
        if($current_status != $request->input("status")){
            $order_detail = $this->sendEmail($order_id);

            Mail::send('emails.orderstatus_update',["order_detail"=>$order_detail],function($message) use($order_detail){
                $message->from($this->sender_info["email"],$this->sender_info["name"]);
                $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                $subject = __('general.order_section.to_user.updated',['name'=>$client_name]);
                $message->to($this->sender_info["email"],"Admin")->subject($subject);
            });
        }
        return redirect()->route("admin_orders");
    }
    public function confirmCancel($order_id){
        $data=[];
        $data["order"]=$this->orders->find($order_id);
        $data["cancel_reasons"]=$this->cancel_reasons->all();
        $data["page_title"]=__('general.order_section.confirm_cancellation');
        return view("admin/orders/confirm_cancel",$data);
    }
    public function cancelOrder($order_id,Request $request){
        $data=[];
        $order = $this->orders->find($order_id);
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $user_id=$order->user_id;
        $order->status=2;
        $order->cancel_reason=$request->input('cancel_reason');
        $order->cancel_user=$user_id;
        $today=carbon::now();
        $data_products_email=[];
        if($order->save()){
            
            DB::table('vestidos_orders_products')->where("id",$order->id)->update(["status"=>2]);

            //revert product stock
            $order_products = $this->order_products->where("order_id",$order->id)->get();
            foreach($order_products as $order_product){
                $size_dec = $this->sizes->find($order_product->size_id);
                $newstock_quant =$order_product->quantity;
                $newstock = $size_dec->stock + $newstock_quant;
                $size_dec->stock = $newstock;
                $size_dec->save();
            }

            //send email to user
            $order_detail = $this->sendEmail($order_id);

            Mail::send('emails.ordercancel_confirm',["order_detail"=>$order_detail],function($message) use($order_detail){
                $message->from($this->sender_info["email"],$this->sender_info["name"]);
                $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                $subject = __('general.order_section.to_user.cancel',['name'=>$client_name]);
                $message->to($order_detail["user"]["email"],$client_name)->subject($subject);
            });
        }
        return redirect()->route("admin_orders")->with('success',__('general.order_section.cancel_success'));
    }
    public function sendEmail($order_id){
        echo $order_id;
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

        //if user applied discount
        $discount_app = $order->order_discount ? $order->order_discount : 0;

        $subtotal = $order->order_total - $order->order_discount;

        $grand_total = $subtotal + $order->order_tax + $order->order_shipping;

        $order_detail["user"]=$this->users->find($user_id);
        $order_detail["order"]=array(                        
            "order_number"=>$order->order_number,
            "purchase_date"=>$today,
            "products"=>$data_products_email,
            "order_total"=>$order->order_total,
            "discount_app"=>$discount_app,
            "order_tax"=>$order->order_tax,
            "subtotal"=>$subtotal,
            "grand_total"=>$grand_total,
            "status"=>$order->getStatusName->name,
            "allow_shipping"=>$this->main_config->allow_shipping ? "true" : "false",
            "allow_billing"=>$this->main_config->allow_billing ? "true" : "false",
            "order_grand_total"=>$order->order_total + $order->order_tax,
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
        );
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
        return $order_detail;
    }
    public function confirmDelete($order_id){
        $data=[];
        $data["order"]=$this->orders->find($order_id);
        $data["page_title"]=__('general.order_section.confirm_cancellation');
        return view("admin/orders/confirm_delete",$data);
    }
    public function deleteOrder($order_id,Request $request){
        $data=[];
        $order = $this->orders->find($order_id);
        if($order->delete()){
            return redirect()->route("admin_orders")->with('success',__('general.order_section.order_success_deleted'));
        }
        return redirect()->route("admin_orders")->with('error',__('general.order_section.unable_delete'));
    }
    public function deleteConfirmOrders(Request $request){
        $order_ids = $request["order_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "order_ids"=>"required",
        ],$custom_message);
        $orders = $this->orders->getOrdersByIds($order_ids);
        $data["confirm_type"] = "name";
        $data["confirm_show_warning"]=true;
        $data["confirm_return"] = route("admin_orders");
        $data["confirm_name"] = "Orders";
        $data["confirm_data"] = $orders;
        $data["confirm_delete_url"]=route('delete_orders');
        $data["page_title"]="Confirm orders for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteOrders(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $order_ids = $request["item_ids"];
                foreach($order_ids as $order){
                   $order = $this->orders->find($order);
                    $order->delete();
                }
               return redirect()->route("admin_orders")->with('success','Orders Deleted successfully.');
    }
}
