<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosOrders as Orders;
use App\vestidosStatus as vestidosStatus;
use App\vestidosUsers as Users;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosProducts as Products;
use App\vestidosColors as Colors;
use App\vestidosSizes as Sizes;
use App\vestidosOrderCancelReasons as CancelReasons;
use App\vestidosProductDeliveries as ProductDeliveries;
use Carbon\Carbon as carbon;
use App\vestidosTaxInfos as Tax;
use App\vestidosMainConfigs as MainConfig;
use Auth;
use Mail;
use Illuminate\Support\Facades\Input;
use App\vestidosUserAddresses as Addresses;

class userOrderController extends Controller
{
    //
    public function __construct(Addresses $addresses, Products $products, Users $users, vestidosStatus $vestidosStatus, Orders $orders,Brands $brands,Categories $categories, CancelReasons $cancel_reasons,Colors $colors,Sizes $sizes,Tax $tax, ProductDeliveries $product_deliveries,MainConfig $main_config){
        $this->statuses=$vestidosStatus;
        $this->tax_info = $tax->first();
        $this->orders=$orders;
        $this->users=$users;
        $this->products=$products;
        $this->addresses=$addresses;
        $this->brands=$brands;
        $this->cancel_reasons=$cancel_reasons;
        $this->product_deliveries = $product_deliveries->where("status","1")->orderBy("main",'desc')->get();
        $this->categories = $categories;
        $this->sizes=$sizes;
        $this->colors=$colors;
        $this->main_config = $main_config->first();
        $this->sender_info = [
            "name"=>env("MAIL_FROM_NAME"),
            "email"=>env("MAIL_FROM_ORDER"),
        ];
    }

    public function index(){
        $data=[];
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["orders"]=$user->orders()->orderBy('created_at',"desc")->paginate(5);
        $data["user"]=$user;
        $data["page_title"]= __('header.orders');
        return view("account/orders/home",$data);
    }
    public function viewOrder($order_id,Request $request){
        $data=[];
        $order =$this->orders->find($order_id);
        $data["page_title"]=__('general.page_header.order_detail');;
        $data["order"]=$order;
        $getOrderShipping = $order->getOrderShippingAddress();
        $data["order_shipping"]=$getOrderShipping ? $getOrderShipping[0] : null;
        $getOrderBilling = $order->getOrderBillingAddress();
        $data["order_billing"]=$getOrderShipping ? $getOrderBilling[0] : null;;
        $data["user"]=$this->users->find($order->user_id);
        return view("account/orders/view",$data);
    }
    public function showCancelIndex($order_id){
        $data=[];
        $data["order"]=$this->orders->find($order_id);
        $data["cancel_reasons"]=$this->cancel_reasons->all();
        $data["page_title"]=__('general.page_header.cancel_order');
        return view("account/orders/confirm",$data);
    }
    public function deleteOrder($order_id,Request $request){
        $data=[];
        $this->validate($request,[
            "cancel_reason"=>"required"
        ]);
        $today = carbon::now();
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $order = $this->orders->find($order_id);
        $order->status=11;
        $order->cancel_reason = $request->input("cancel_reason");
        $order->cancel_user=$user_id;
        $billing_add = $order->getOrderBillingAddress();
        $shipping_add = $order->getOrderShippingAddress();

        $discount_app = $order->order_discount ? $order->order_discount : 0;

        $subtotal = $order->order_total - $order->order_discount;

        $grand_total = ($subtotal + $order->order_tax) + $order->order_shipping + $order->delivery_speed_cost;
        
        if($order->save()){
            //send email to user
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
                    "total"=>$product->total,
                    "model"=>$product_detail->product_model,
                    "img"=>$product_detail->images()->first()->img_url,
                    "id"=>$product_detail->id
                );
            }
            $order_detail["user"]=$this->users->find($user_id);
            $order_detail["order"]=array(                        
                    "order_number"=>$order->order_number,
                    "allow_shipping"=>$this->main_config->allow_shipping==true ? "true" : "false",
                    "allow_billing"=>$this->main_config->allow_billing==true ? "true" : "false",
                    "allow_delivery_speed"=>$this->main_config->allow_delivery_time ? "true" : "false",
                    "delivery_speed_name"=>null,
                    "delivery_speed_total"=>null,
                    "delivery_speed_description"=>null,
                    "purchase_date"=>$today,
                    "products"=>$data_products_email,
                    "order_total"=>$order->order_total,
                    "discount_app"=>$discount_app,
                    "order_tax"=>$order->order_tax,
                    "subtotal"=>$subtotal,
                    "grand_total"=>$grand_total,
                    "status"=>$order->getStatusName->name,
                    "shipping_total"=>null,
                    "shipping_name"=>null,
                    "shipping_address_1"=>null,
                    "shipping_address_2"=>null,
                    "shipping_district"=>null,
                    "shipping_corregimiento"=>null,
                    "shipping_province"=>null,
                    "shipping_country"=>null,
                    "shipping_zip_code"=>null,
                    "shipping_phone_number_1"=>null,
                    "shipping_phone_number_2"=>null,
                    "shipping_email"=>null,
                    "billing_name"=>null,
                    "billing_address_1"=>null,
                    "billing_address_2"=>null,
                    "billing_district"=>null,
                    "billing_corregimiento"=>null,
                    "billing_province"=>null,
                    "billing_country"=>null,
                    "billing_zip_code"=>null,
                    "billing_phone_number_1"=>null,
                    "billing_phone_number_2"=>null,
                    "billing_email"=>null,
            );
            if($shipping_add){                 
                $order_detail["order"]["shipping_name"]=$shipping_add[0]->name;
                $order_detail["order"]["shipping_address_1"]=$shipping_add[0]->address_1;
                $order_detail["order"]["shipping_address_2"]=$shipping_add[0]->address_2;
                $order_detail["order"]["shipping_district"]=$shipping_add[0]->district_name;
                $order_detail["order"]["shipping_corregimiento"]=$shipping_add[0]->corregimiento_name;
                $order_detail["order"]["shipping_province"]=$shipping_add[0]->province_name;
                $order_detail["order"]["shipping_country"]=$shipping_add[0]->country_name;
                $order_detail["order"]["shipping_zip_code"]=$shipping_add[0]->zip_code;
                $order_detail["order"]["shipping_phone_number_1"]=$shipping_add[0]->phone_number_1;
                $order_detail["order"]["shipping_phone_number_2"]=$shipping_add[0]->phone_number_2;
                $order_detail["order"]["shipping_email"]=$shipping_add[0]->email;
            }
            if($billing_add){  
                $order_detail["order"]["billing_name"]=$billing_add[0]->name;
                $order_detail["order"]["billing_address_1"]=$billing_add[0]->address_1;
                $order_detail["order"]["billing_address_2"]=$billing_add[0]->address_2;
                $order_detail["order"]["billing_district"]=$billing_add[0]->district_name;
                $order_detail["order"]["billing_corregimiento"]=$billing_add[0]->corregimiento_name;
                $order_detail["order"]["billing_province"]=$billing_add[0]->province_name;
                $order_detail["order"]["billing_country"]=$billing_add[0]->country_name;
                $order_detail["order"]["billing_zip_code"]=$billing_add[0]->zip_code;
                $order_detail["order"]["billing_phone_number_1"]=$billing_add[0]->phone_number_1;
                $order_detail["order"]["billing_phone_number_2"]=$billing_add[0]->phone_number_2;
                $order_detail["order"]["billing_email"]=$billing_add[0]->email;
            }
            if($this->main_config->allow_delivery_time){
                $order_detail["order"]["delivery_speed_name"]=$order->delivery_speed_name;
                $order_detail["order"]["delivery_speed_total"]=$order->delivery_speed_cost;
                $order_detail["order"]["delivery_speed_description"]=$order->delivery_speed_description;
            }
            Mail::send('emails.ordercancel',["order_detail"=>$order_detail],function($message) use($order_detail){
                $message->from($this->sender_info["email"],$this->sender_info["name"]);
                $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                $subject = __('general.order_section.to_user.cancel_confirmation',['name'=>$client_name]);
                $message->to($order_detail["user"]["email"],$client_name)->subject($subject);
            });
            Mail::send('emails.ordercanceladmin',["order_detail"=>$order_detail],function($message) use($order_detail){
                $message->from($this->sender_info["email"],$this->sender_info["name"]);
                $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                $subject = __('general.order_section.to_admin.cancel_confirmation',['name'=>$client_name]);
                $message->to($this->sender_info["email"],"Admin")->subject($subject);
            });
            return redirect()->route("user_account",["user_id"=>$order->user_id])->with(
                "success",__('general.order_section.cancel_request'));
       }
        return redirect()->route("user_account")->with("error",__('general.order_section.unable_delete'));
 
    }
}
