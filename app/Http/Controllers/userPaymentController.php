<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosUsers as Users;
use Carbon\Carbon as carbon;
use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosCountries as Countries;
use App\vestidosGenders as Genders;
use App\vestidosLanguages as Languages;
use App\vestidosAddressTypes as AddressTypes;
use App\vestidosUserAddresses as Addresses;
use Braintree_Transaction;
use Auth;
use Mail;
use Illuminate\Support\Facades\DB;
use Session;

class userPaymentController extends Controller
{
    //
    public function __construct(AddressTypes $addresstypes, Addresses $addresses, Genders $genders, Languages $languages, Users $users, Countries $countries,Brands $brands, Categories $categories){
        $this->country=$countries->all();
        $this->users = $users;
        $this->genders=$genders;
        $this->languages=$languages;
        $this->addresses=$addresses;
        $this->brands=$brands;
        $this->categories = $categories;
        $this->addresstypes = $addresstypes;
        $this->checkout_menus=[
            "Shipping",
            "Payment & Billing",
            "Confirmation"
        ];
    }
    public function showShipping(){
        $data=[];
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["page_title"]="Select Shipping Address";
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["countries"]=$this->country->all();
        $data["checkout_menus"]=$this->checkout_menus;
        return view("/checkout/shipping",$data);
    }
    public function saveShipping(Request $request){
            $user_id=Auth::guard("vestidosUsers")->user()->getId();
            $user = $this->users->find($user_id);
            $data["user"]=$user;
            $data["page_title"]="Choose Billing and Payment Method";
            $data["brands"]=$this->brands->all();
            $data["categories"]=$this->categories->all();
            $data["countries"]=$this->country->all();
            $data["address_id"]=$request->input("address_id");
            $data["checkout_menus"]=$this->checkout_menus;
            return view("/checkout/billing",$data);
    }
    public function showBilling(){
        
        $data=[];
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["user"]=$user;

        $data["page_title"]="Choose Billing and Payment Method";
        $data["checkout_menus"]=$this->checkout_menus;
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["address_id"]=$request->input("address_id");
        return view("/checkout/checkout",$data);
    }
    public function saveBilling(Request $request){
        $data=[];
        $user_id=Auth::guard("vestidosUsers")->user()->getId();
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["page_title"]="Billing";
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        $data["countries"]=$this->country->all();
        $data["address_id"]=$request->input("address_id");
        return redirect()->route('checkout_page')->with($data);
    }
    public function process(Request $request){
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];

        $status = Braintree_Transaction::sale([
        'amount' => '10.00',
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => True
        ]
        ]);

        return response()->json($status);
       // dd($request);
    }
}
