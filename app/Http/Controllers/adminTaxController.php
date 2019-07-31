<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosStatus as Statuses;
use App\vestidosTaxInfos as Taxes;
use App\vestidosCountries as Countries;
use Carbon\Carbon as carbon;
use Illuminate\Support\Arr;
use Excel;
use Session;
use Validator;

class adminTaxController extends Controller
{
    //
    public function __construct(Statuses $statuses, Taxes $taxes, Countries $countries){
        $this->statuses=$statuses;
        $this->taxes=$taxes;
        $this->countries=$countries;
    }
    function index(){
        $data=[];
        $data["main_items"]=$this->taxes->paginate(10);
        $data["page_submenus"]=[
            [
                "url"=>route('new_tax'),
                "name"=>"Add Vendor"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_tax');
        $data["page_title"]="Tax Page";
        return view("admin/home_config/tax/home",$data);
    }
    function newTax(Request $request){
        $data=[];
        $data["page_title"]="CreateTaxes Page";
        return view("admin/home_config/tax/new",$data);
    }
    function createTax(Request $request){
        $data=[];
        $data["name"]=$request->input("name");
        $data["country_id"]=$request->input("country_id");
        $data["tax"]=$request->input("tax");
        $data["status"]=$request->input("status");
        $this->validate($request,[
            "country_id"=>"required",
            "status"=>"required",
            "tax"=>"required",
            "code"=>"required"
        ]);
        $data["created_at"]=carbon::now();
        $this->taxes->insert($data);
        return redirect()->route("admin_taxes");
    }
    function editTax($tax_id){
        $data=[];
        $tax= $this->taxes->find($tax_id);
        $data["country"]=$request->input("country");
        $data["tax"]=$tax;
        $data["page_title"]="Edit Taxes";
       return view("admin/home_config/tax/edit",$data);
    }
    function saveTax($tax_id, Request $request){
        $data=[];
        $data["name"]=$request->input("name");
        $data["country_id"]=$request->input("country_id");
        $data["tax"]=$request->input("tax");
        $data["status"]=$request->input("status");
        $vendor = $this->vendors->find($tax_id);

        $this->validate($request,[
            "country_id"=>"required",
            "status"=>"required",
            "tax"=>"required",
            "code"=>"required"
        ]);
        $vendor->code = $request->input("name");
        $vendor->tax = $request->input("tax");
        $vendor->country_id = (int)$request->input("country");
        $vendor->status = (int)$request->input("status");
        $vendor->updated_at = carbon::now();
        $vendor->save();
        return redirect()->route("admin_taxes");
        
    }
    public function deleteTax($tax_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $tax = $this->taxes->find($tax_id);
            $tax->delete();
            return redirect()->route("admin_taxes");
        }
        $data["tax"]=$this->taxes->find($tax_id);
        $data["page_title"]="Delete Tax";
        return view("admin/home_config/tax/confirm",$data);
    }
    public function deleteConfirmTaxes(Request $request){
        $tax_ids = $request["tax_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "tax_ids"=>"required",
        ],$custom_message);
        $taxes = $this->taxes->getTaxesByIds($tax_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_taxes");
        $data["confirm_name"] = "Taxes";
        $data["confirm_data"] = $taxes;
        $data["confirm_delete_url"]=route('delete_taxes');
        $data["page_title"]="Confirm Taxes for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteTaxes(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $taxes_ids = $request["item_ids"];
                foreach($taxes_ids as $tax){
                   $tax = $this->taxes->find($vendor);
                    $tax->delete();
                }
               return redirect()->route("admin_taxes")->with('success','Taxes deleted successfully.');
    }
}
