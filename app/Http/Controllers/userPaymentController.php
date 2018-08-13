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
use App\vestidosUserAddresses as Addresses;
use Braintree_Transaction;

class userPaymentController extends Controller
{
    //
    public function __construct(Addresses $addresses, Genders $genders, Languages $languages, Users $users, Countries $countries,Brands $brands, Categories $categories){
        $this->country=$countries->all();
        $this->users = $users;
        $this->genders=$genders;
        $this->languages=$languages;
        $this->addresses=$addresses;
        $this->brands=$brands;
        $this->categories = $categories;
    }
    public function showCheckout(){
        $data["page_title"]="Checkout";
        $data["brands"]=$this->brands->all();
        $data["categories"]=$this->categories->all();
        return view("/checkout",$data);
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
