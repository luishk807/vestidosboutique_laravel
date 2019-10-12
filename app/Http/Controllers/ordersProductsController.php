<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosOrders as Orders;
use App\vestidosOrdersProducts as OrdersProducts;
use App\vestidosStatus as vestidosStatus;
use App\vestidosUsers as Users;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use App\vestidosCountries as Countries;
use Illuminate\Support\Arr;
use App\vestidosTaxInfos as Tax;
use Illuminate\Support\Facades\Input;
use App\vestidosMainConfigs as MainConfig;
use App\vestidosUserAddresses as Addresses;
use App\vestidosShippingLists as ShippingLists;
use App\vestidosColors as Colors;
use App\vestidosSizes as Sizes;
use Session;

class ordersProductsController extends Controller
{
    //
    public function __construct(Countries $countries, Addresses $addresses, Products $products, Users $users, vestidosStatus $vestidosStatus, Orders $orders,OrdersProducts $order_products,Tax $tax,ShippingLists $shippingLists,Colors $colors, Sizes $sizes, MainConfig $main_config){
        $this->tax_info = $tax->first();
        $this->main_config = $main_config->first();
        $this->statuses=$vestidosStatus;
        $this->orders=$orders;
        $this->order_products=$order_products;
        $this->users=$users;
        $this->countries=$countries;
        $this->colors = $colors;
        $this->sizes = $sizes;
        $this->products=$products;
        $this->addresses=$addresses;
        $this->shipping_lists = $shippingLists;
    }
    public function index($order_id){
        $data=[];
        $order = $this->orders->find($order_id);
        $data["page_submenus"]=[
            [
                "url"=>route('admin_edit_order',['order_id'=>$order->id]),
                "name"=>"Back to Previous"
            ]
        ];
        $data["order"]=$this->orders->find($order_id);
        $data["orders"]=$this->orders->all();
        $data["page_title"]=__('header.orders')." ".$order->order_number;
        return view("admin/orders/products/home",$data);
    }
    public function cartAddProduct(){
        $data=[];
        $prd_id = Input::get('data') ? Input::get('data') : null;
        if(!empty($prd_id)){
            if(Session::has("vestidos_admin_shop")){
                $data=Session::get("vestidos_admin_shop");
            }
            $order_p=[];
            $prod = $this->products->find($prd_id);
    
            if(empty($product["color"]) || empty($product["size"]) || empty($product["quantity"])){
                return redirect()->back()->withErrors([
                    "required"=> __('general.product_title.missing_size_color',['name'=>$prod->products_name])
                ]);
            }

            $color = $this->colors->find($product["color"]);
            $size = $this->sizes->find($product["size"]);
            $total = $size->total_sale * $product['quantity'];
            $image_save = $prod->images->count() > 0 ? $prod->images->first()->img_url : "no-image.jpg";
            $image_name = $prod->images->count() > 0 ? $prod->images->first()->img_name : "";
            $subtotal += $total;
            $order_p[]=array(
                "id"=>$prod->id,
                "name"=>$prod->products_name,
                "img"=>$image_save,
                "img_name"=>$image_name,
                "total"=>$total,
                "color_id"=>$product["color"],
                "color"=>$color->name,
                "size_id"=>$product["size"],
                "size"=>$size->name,
                "quantity"=>$product['quantity']
            ); 
            $data["products"]=$order_p;
            Session::forget('vestidos_admin_shop');
            Session::put('vestidos_admin_shop',$data);
            return redirect()->route("admin_show_checkout");
        }

    }
    public function cartRemoveProduct(){
        $prd_id = Input::get('data');
        if(!empty($prd_id) || !Session::has("vestidos_admin_shop")){
            $data=Session::get("vestidos_admin_shop");
            $order_p = $data["products"];
            if(array_key_exists($prd_id,$data)){
                array_splice($order_p, $prd_id, 1); 
                $data["products"]=$order_p;
                Session::forget('vestidos_admin_shop');
                Session::put('vestidos_admin_shop',$data);
            }
            return redirect()->route("admin_show_checkout");
        }
    }
    public function cartUpdateProduct(){
        $prd_id = Input::get('data');
        if(!empty($prd_id) || !Session::has("vestidos_admin_shop")){
            $data=Session::get("vestidos_admin_shop");
            $order_p = $data["products"];
            foreach($order_p as $product){
                if($product["id"]==$prd_id){
                    $product["color_id"]=$product["color"];
                    $product["size_id"]=$product["size"];
                    $product["quantity"]=$product['quantity'];
                }
            }
            $data["products"]=$order_p;
            Session::forget('vestidos_admin_shop');
            Session::put('vestidos_admin_shop',$data);
            return redirect()->route("admin_show_checkout");
        }
    }
    public function newOrderProducts(){
        $data=[];
        $prd_id = Input::get('data') ? Input::get('data') : null;
        $data["main_items"]=empty($prd_id) ? $this->products->where("status",1)->paginate(10) : $this->products->where("status",1)->where("id",$prd_id)->paginate(10);
        $data["page_title"]=__('general.order_section.new_order_products'); 
        return view("admin/orders/products/new",$data);
    }
    public function createOrderProducts(Request $request){
        $data=[];
        $tax = $this->tax_info->tax / 100;
        $subtotal = 0;
        if(Session::has("vestidos_admin_shop")){
            $data=Session::get("vestidos_admin_shop");
            $user = $this->users->find($data["user_id"]);
        }else{
            return redirect()->route('admin_orders')->with(__('general.access_section.denied'));
        }
         $order_products=$request->input("order_products");
        $order_p=[];
        if(empty(array_column($order_products, 'product_id'))){
            return redirect()->back()->withErrors([
                "required"=>"You must select at least one product"
            ]);
        }
        foreach($order_products as $product){
            if(!empty($product["product_id"])){
                $prod = $this->products->find($product['product_id']);

                if(empty($product["color"]) || empty($product["size"]) || empty($product["quantity"])){
                    return redirect()->back()->withErrors([
                        "required"=> __('general.product_title.missing_size_color',['name'=>$prod->products_name])
                    ]);
                }

                $color = $this->colors->find($product["color"]);
                $size = $this->sizes->find($product["size"]);
                $total = $size->total_sale * $product['quantity'];
                //dd($size->stock);
                //if($size->stock >0){
                    $image_save = $prod->images->count() > 0 ? $prod->images->first()->img_url : "no-image.jpg";
                    $image_name = $prod->images->count() > 0 ? $prod->images->first()->img_name : "";
                    $subtotal += $total;
                    $order_p[]=array(
                        "id"=>$prod->id,
                        "name"=>$prod->products_name,
                        "img"=>$image_save,
                        "img_name"=>$image_name,
                        "total"=>$total,
                        "color_id"=>$product["color"],
                        "color"=>$color->name,
                        "size_id"=>$product["size"],
                        "size"=>$size->name,
                        "quantity"=>$product['quantity']
                    );
                //}
            }
        }
        // echo "<pre>";
        // print_r($order_p);
        // echo "</pre>";
        $shipping_list=$this->main_config->allow_shipping ? $data["shipping_list"] : null;
        $data["order_total"]=$subtotal;
        $data["order_tax"]=$subtotal * $tax;
        $data["order_shipping"]=$this->main_config->allow_shipping ? $shipping_list->total : null;
        $data["grand_total"]=$this->main_config->allow_shipping ? $subtotal + ($subtotal * $tax) + $shipping_list->total : $subtotal + ($subtotal * $tax);
        $data["products"]=$order_p;
        Session::forget('vestidos_admin_shop');
        Session::put('vestidos_admin_shop',$data);
        return redirect()->route("admin_show_checkout");
    }
    public function editOrderProduct($order_id,Request $request){
        $data=[];
        $order =$this->orders->find($order_id);
        $data["order_id"]=$order_id;
        $user=$this->users->find($order->user_id);
        $data["users"]=$this->users->all();
        $data["products"]=$this->products->all();
        $data["page_title"]=__('general.order_section.edit_order')." ".$order->order_number;
        return view("admin/orders/products/edit",$data);
    }
    public function saveOrderProduct($order_id,Request $request){
        $data=[];
        $valid_array=false;
        $this->validate($request,[
            "order_product"=>"required"
        ]);
        $order_product = $request->input("order_product");
        foreach($order_product as $product){
            if(Arr::exists($product,"id")){
                $valid_array=true;
                $order_p = $this->order_products->find($product["id"]);
                $order_p->status=$product["status"];
                $order_p->save();
            }
        }
        if(!$valid_array){
            return redirect()->back()->withErrors(["required"=>__('general.product_title.select_product')]);
        }else{
            return redirect()->route("admin_orders")->with("success",__('general.order_section.order_updated'));
        }
    }
    public function confirmDeleteOrderProduct($order_product_id){
        $data=[];
        $data["order"]=$this->orders->find($order_product->order_id);
        $data["order_product"]=$order_product;
        $data["page_title"]=__('general.order_section.delete_name',['name'=>$order_product->getProduct->products_name]);
        return view("admin/orders/products/confirm",$data);
    }
    public function deleteOrderProduct($order_product_id,Request $request){
        $data=[];
        $order_product = $this->order_products->find($order_product_id);
        $order_product->delete();
        return redirect()->route("admin_orders"); 
    }
    public function editOrderAddress($order_id,$address_type){
        $data["order"]=$this->orders->find($order_id);
        $data["orders"]=$this->orders->all();
        $data["address_type"]=$address_type;
        $data["name"] = $request->input('address_name');
        $data["page_title"]=__('general.order_section.order_address');
        return view("admin/orders/addresses/new",$data);
    }
    public function saveOrderAddress($order_id,Request $request){
        $data=[];
        $order=$this->orders->find($order_id);
        $data["order"]=$order;
        $data["order_id"]=$order_id;
        return redirect()->route("admin_edit_order",$data);
    }
}
