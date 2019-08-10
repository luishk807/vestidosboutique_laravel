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
use Carbon\Carbon as carbon;
use App\vestidosTaxInfos as Tax;
use Auth;
use Mail;
use Illuminate\Support\Facades\Input;
use App\vestidosUserAddresses as Addresses;

class userOrderController extends Controller
{
    //
    public function __construct(Addresses $addresses, Products $products, Users $users, vestidosStatus $vestidosStatus, Orders $orders,Brands $brands,Categories $categories, CancelReasons $cancel_reasons,Colors $colors,Sizes $sizes,Tax $tax){
        $this->statuses=$vestidosStatus;
        $this->tax_info = $tax->first();
        $this->orders=$orders;
        $this->users=$users;
        $this->products=$products;
        $this->addresses=$addresses;
        $this->brands=$brands;
        $this->cancel_reasons=$cancel_reasons;
        $this->categories = $categories;
        $this->sizes=$sizes;
        $this->colors=$colors;
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
        $data["order_billing"]=$getOrderBilling[0];
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
                    "total"=>$product_detail->total_rent,
                    "model"=>$product_detail->product_model,
                    "img"=>$product_detail->images()->first()->img_url,
                    "id"=>$product_detail->id
                );
            }
            if($order->order_shipping){
                $order_detail=[
                    "user"=>$this->users->find($user_id),
                    "order"=>array(                        
                        "order_number"=>$order->order_number,
                        "allow_shipping"=>"true",
                        "purchase_date"=>$today,
                        "shipping_name"=>$order->shipping_name,
                        "shipping_address_1"=>$order->shipping_address_1,
                        "shipping_address_2"=>$order->shipping_address_2,
                        "shipping_city"=>$order->shipping_city,
                        "shipping_state"=>$order->shipping_state,
                        "shipping_country"=>$order->getShippingCountry->countryCode,
                        "shipping_zip_code"=>$order->shipping_zip_code,
                        "shipping_phone_number_1"=>$order->shipping_phone_number_1,
                        "shipping_phone_number_2"=>$order->shipping_phone_number_2,
                        "shipping_email"=>$order->shipping_email,
                        "billing_name"=>$order->billing_name,
                        "billing_address_1"=>$order->billing_address_1,
                        "billing_address_2"=>$order->billing_address_2,
                        "billing_city"=>$order->billing_city,
                        "billing_state"=>$order->billing_state,
                        "billing_country"=>$order->getBillingCountry->countryCode,
                        "billing_zip_code"=>$order->billing_zip_code,
                        "billing_phone_number_1"=>$order->billing_phone_number_1,
                        "billing_phone_number_2"=>$order->billing_phone_number_2,
                        "billing_email"=>$order->billing_email,
                        "products"=>$data_products_email,
                        "order_total"=>$order->order_total,
                        "order_tax"=>$order->order_tax,
                        "status"=>$order->getStatusName->name,
                        "shipping_total"=>$order->order_shipping
                    )
                ];
            }else{
                $order_detail=[
                    "user"=>$this->users->find($user_id),
                    "order"=>array(                        
                        "order_number"=>$order->order_number,
                        "allow_shipping"=>"false",
                        "purchase_date"=>$today,
                        "billing_name"=>$order->billing_name,
                        "billing_address_1"=>$order->billing_address_1,
                        "billing_address_2"=>$order->billing_address_2,
                        "billing_city"=>$order->billing_city,
                        "billing_state"=>$order->billing_state,
                        "billing_country"=>$order->getBillingCountry->countryCode,
                        "billing_zip_code"=>$order->billing_zip_code,
                        "billing_phone_number_1"=>$order->billing_phone_number_1,
                        "billing_phone_number_2"=>$order->billing_phone_number_2,
                        "billing_email"=>$order->billing_email,
                        "products"=>$data_products_email,
                        "order_total"=>$order->order_total,
                        "order_tax"=>$order->order_tax,
                        "status"=>$order->getStatusName->name,
                    )
                ];
            }

            Mail::send('emails.ordercancel',["order_detail"=>$order_detail],function($message) use($order_detail){
                $message->from("info@vestidosboutique.com","Vestidos Boutique");
                $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                $subject = __('general.order_section.to_user.cancel_confirmation',['name'=>$client_name]);
                $message->to($order_detail["user"]["email"],$client_name)->subject($subject);
            });
            Mail::send('emails.ordercanceladmin',["order_detail"=>$order_detail],function($message) use($order_detail){
                $message->from("info@vestidosboutique.com","Vestidos Boutique");
                $client_name = $order_detail["user"]['first_name']." ".$order_detail["user"]["last_name"];
                $subject = __('general.order_section.to_admin.cancelled',['name'=>$client_name]);
                $message->to("info@vestidosboutique.com","Admin")->subject($subject);
            });
            return redirect()->route("user_account",["user_id"=>$order->user_id])->with(
                "success",__('general.order_section.cancel_request'));
        }
        return redirect()->route("user_account")->with("error",__('general.order_section.unable_delete'));
 
    }
}
