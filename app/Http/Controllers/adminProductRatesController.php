<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosProducts as Products;
use App\vestidosStatus as vestidosStatus;
use App\vestidosProductRates as Rates;
use App\vestidosUsers as Users;
use Carbon\Carbon as carbon;

class adminProductRatesController extends Controller
{
    //
    public function __construct(Users $users, Rates $rates, vestidosStatus $vestidosStatus, Products $products){
        $this->statuses=$vestidosStatus;
        $this->products=$products;
        $this->users=$users;
        $this->rates=$rates;
        $this->rate_numbers=5;
    }
    public function index($product_id){
        $data=[];
        $product=$this->products->find($product_id);
        $data["page_submenus"]=[
            [
                "url"=>route('admin'),
                "name"=>"Home"
            ],
            [
                "url"=>route('edit_product',['product_id'=>$product_id]),
                "name"=>"Back to Edit"
            ],
            [
                "url"=>route('new_rate',['product_id'=>$product_id]),
                "name"=>"Add Product Rate"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_rates');
        $data["rates"]=$product->rates()->get();
        $data["page_title"]="Rates For ".$product->products_name;
        $data["product_id"]=$product_id;
        return view("admin/products/rates/home",$data);
    }

    public function newRates($product_id,Request $request){
        $data=[];
        $data["user_id"]=(int)$request->input("user");
        $data["user_rate"]=$request->input("user_rate");
        $data["status"]=(int)$request->input("status");
        $data["product_id"]=$product_id;
        $data["user_comment"]=$request->input("user_comment");
        if($request->isMethod("post")){
            $this->validate($request,[
        
                "user"=>"required",
                "user_rate"=>"required",
                "status"=>"required"
            ]
            );
            $data["created_at"]=carbon::now();
            $this->rates->insert($data);
            return redirect()->route("admin_rates",["product_id"=>$product_id]);
        }
        $product=$this->products->find($product_id);
        $data["user"]=$request->input("user");
        $users =$this->users->all();
        $data["users"]=$users;
        $data["product"]=$product;
        $data["rate_nums"]=$this->rate_numbers;
        $data["page_title"]="New Rate For Product: ".$product->products_name;
        // if(!$users->count()){
        //     $data["product_id"]=$product_id;
        //     $data["error_message"]="No User To Add";
        //     return redirect()->route("admin_rates",$data);
        // }
        return view("admin/products/rates/new",$data);
    }
    public function editRate($rate_id,Request $request){
        $data=[];
        $rate =$this->rates->find($rate_id);
        $data["page_title"]="Edit Rate";
        $data["rate"]=$rate;
        $data["user_rate"] = $request->input("user_rate");
        $data["user"] =(int)$request->input("user");
        $data["user_comment"] = $request->input("user_comment");
        $data["rate_id"]=$rate_id;
        $data["status"]=(int)$request->input("status");
        if($request->isMethod("post")){
            $this->validate($request,[
                "user"=>"required",
                "user_rate"=>"required",
                "status"=>"required"
            ]);
            $rate =$this->rates->find($rate_id);
            $rate->user_id=$request->input("user");
            $rate->product_id=$rate->product_id;
            $rate->user_comment = $request->input("user_comment");
            $rate->user_rate = (int)$request->input("user_rate");
            $rate->status=(int)$request->input("status");
            $rate->updated_at=carbon::now();

            $rate->save();

            return redirect()->route("admin_rates",["product_id"=>$rate->product_id]);
        }
        $data["users"]=$this->users->all();
        $data["rate_nums"]=$this->rate_numbers;
        $data["page_title"]="Edit Rate";
        return view("admin/products/rates/edit",$data);
    }
    public function deleteRate($rate_id,Request $request){
        $data=[];
        $rate = $this->rates->find($rate_id);
        if($request->input("_method")=="DELETE"){
            $rate->delete();
            return redirect()->route("admin_rates");
        }
        $data["rate"]=$rate;
        $data["page_title"]="Delete Rates";
        $data["product_id"]=$rate->product_id;
        return view("admin/products/rates/confirm",$data);
    }
    public function deleteConfirmRates(Request $request){
        $rate_ids = $request["rate_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "rate_ids"=>"required",
        ],$custom_message);
        $rates = $this->rates->getRatesByIds($rate_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_rates");
        $data["confirm_name"] = "Rates";
        $data["confirm_data"] = $rates;
        $data["confirm_delete_url"]=route('delete_rates');
        $data["page_title"]="Confirm rates for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteRates(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $rate_ids = $request["item_ids"];
                foreach($rate_ids as $rate){
                   $rate = $this->rates->find($rate);
                    $rate->delete();
                }
               return redirect()->route("admin_rates")->with('success','Rates Deleted successfully.');
    }
}
