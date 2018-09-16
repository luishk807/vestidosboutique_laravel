<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosProducts as Products;
use App\vestidosStatus as vestidosStatus;
use App\vestidosProductRates as Rates;
use App\vestidosUsers as Users;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosCountries as Countries;
use Carbon\Carbon as carbon;
use Auth;

class userProductRateController extends Controller
{
    //
    public function __construct(Users $users, Rates $rates, vestidosStatus $vestidosStatus, Products $products,Brands $brands, Categories $categories){
        $this->statuses=$vestidosStatus;
        $this->products=$products;
        $this->users=$users;
        $this->rates=$rates;
        $this->brands=$brands;
        $this->categories = $categories;
        $this->rate_numbers=5;
    }
    public function index($product_id){
        $data=[];
        $product=$this->products->find($product_id);
        $data["rates"]=$product->rates()->get();
        $data["page_title"]=__('general.page_header.review_name',['name'=>$product->products_name]);
        $data["product_id"]=$product_id;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        return view("account/review/home",$data);
    }

    public function newReview($product_id){
        $data=[];
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $product=$this->products->find($product_id);
        $user = $this->users->find($user_id);
        $data["users"]=$user;
        $data["product"]=$product;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["rate_nums"]=$this->rate_numbers;
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]=__('general.rate_title.product_review_title',['name'=>$product->products_name]);
        return view("account/review/new",$data);
    }
    public function createReview($product_id,Request $request){
        $data=[];
        $data["user_id"]=Auth::guard("vestidosUsers")->user()->getId();
        $data["user_rate"]=$request->input("user_rate");
        $data["product_id"]=$product_id;
        $data["user_comment"]=$request->input("user_comment");
        $data["user_headline"]=$request->input("user_headline");
        $this->validate($request,[
            "user_rate"=>"required",
            "user_comment"=>"required",
            "user_headline"=>"required"
        ]
        );
        $data["status"]=13;
        $data["created_at"]=carbon::now();
        if($this->rates->insert($data)){
            return redirect()->route("user_account");
        }
        return redirect()->back();
    }
    public function editReview($rate_id){
        $data=[];
        $rate =$this->rates->find($rate_id);
        $data["page_title"]=__('general.rate_title.edit_rate');
        $data["rate"]=$rate;
        $data["user_rate"] = $request->input("user_rate");
        $data["user"] =(int)$request->input("user");
        $data["user_comment"] = $request->input("user_comment");
        $data["rate_id"]=$rate_id;
        $data["status"]=(int)$request->input("status");

        $data["users"]=$this->users->all();
        $data["rate_nums"]=$this->rate_numbers;
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]=__('general.rate_title.edit_rate');
        return view("admin/products/rates/edit",$data);
    }
    public function saveReview($rate_id,Request $request){
        $data=[];
        $rate =$this->rates->find($rate_id);
        $data["page_title"]=__('general.rate_title.edit_rate');
        $data["rate"]=$rate;
        $data["user_rate"] = $request->input("user_rate");
        $data["user"] =(int)$request->input("user");
        $data["user_comment"] = $request->input("user_comment");
        $data["rate_id"]=$rate_id;
        $this->validate($request,[
            "user_rate"=>"required",
            "user_headline"=>"required",
            "user_comment"=>"required"
        ]);
        $rate =$this->rates->find($rate_id);
        $rate->product_id=$rate->product_id;
        $rate->user_headline = $request->input("user_headline");
        $rate->user_comment = $request->input("user_comment");
        $rate->user_rate = (int)$request->input("user_rate");
        $rate->status=(int)$request->input("status");
        $rate->updated_at=carbon::now();

        if($rate->save()){
            return redirect()->route("user_account");
        }

        return redirect()->back();
    }
    public function deleteReview($rate_id,Request $request){
        $data=[];
        $rate = $this->rates->find($rate_id);
        if($request->input("_method")=="DELETE"){
            $rate->delete();
            return redirect()->route("admin_rates");
        }
        $data["rate"]=$rate;
        $data["page_title"]=__('general.rate_title.delete_rate');
        $data["product_id"]=$rate->product_id;
        return view("admin/products/rates/confirm",$data);
    }
}
