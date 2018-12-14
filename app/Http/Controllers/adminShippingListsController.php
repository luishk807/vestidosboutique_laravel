<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosStatus as Statuses;
use App\vestidosShippingLists as ShippingLists;
use Carbon\Carbon as carbon;
use Illuminate\Support\Arr;
use Excel;
use Session;
use Validator;

class adminShippingListsController extends Controller
{
    //
    public function __construct(Statuses $statuses, ShippingLists $shipping_lists){
        $this->statuses=$statuses;
        $this->shipping_lists=$shipping_lists;
    }
    function index(){
        $data=[];
        $data["page_submenus"]=[
            [
                "url"=>route('new_shipping_list'),
                "name"=>"Add Shipping Lists"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_shipping_lists');
        $data["main_items"]=$this->shipping_lists->paginate(10);
        $data["page_title"]="Shipping List Page";
        return view("admin/shipping_lists/home",$data);
    }
    function newShippingLists(){
        $data=[];
        $data["page_title"]="Create Shipping Lists Page";
        return view("admin/shipping_lists/new",$data);
    }
    function createShippingLists(Request $request){
        $data=[];
        $data["name"]=$request->input("name");
        $data["description"]=$request->input("description");
        $data["total"]=$request->input("total");
        $data["status"]=$request->input("status");
        $this->validate($request,[
            "name"=>"required",
            "description"=>"required",
            "total"=>"required",
            "status"=>"required",
        ]);
        $data["created_at"]=carbon::now();
        $this->shipping_lists->insert($data);
        return redirect()->route("admin_shipping_lists");
    }
    function editShippingList($shipping_list_id){
        $data=[];
        $shipping_list = $this->shipping_lists->find($shipping_list_id);
        $data["shipping_list"]=$shipping_list;
        $data["page_title"]="Edit Shipping Lists";
        $data["shipping_list_id"]=$shipping_list_id;
        return view("admin/shipping_lists/edit",$data);
    }
    function saveShippingList($shipping_list_id, Request $request){
        $data=[];
        $shipping_list = $this->shipping_lists->find($shipping_list_id);
        $this->validate($request,[
            "name"=>"required",
            "description"=>"required",
            "total"=>"required",
            "status"=>"required",
        ]);
        
        $shipping_list->name = $request->input("name");
        $shipping_list->description = $request->input("description");
        $shipping_list->total = $request->input("total");
        $shipping_list->status = $request->input("status");
        $shipping_list->updated_at=carbon::now();
        $shipping_list->save();
        return redirect()->route("admin_shipping_lists");
    }
    public function showDeleteShippingList($shipping_list_id){
        $data=[];
        $data["shipping_list"]=$this->shipping_lists->find($shipping_list_id);
        $data["page_title"]="Delete Shipping List";
        return view("admin/shipping_lists/confirm",$data);
    }
    public function deleteShippingList($shipping_list_id,Request $request){
        $data=[];
        $shipping_list = $this->shipping_lists->find($shipping_list_id);
        $shipping_list->delete();
        return redirect()->route("admin_shipping_lists");
    }
    public function deleteConfirmShippingLists(Request $request){
        $shipping_list_ids = $request["shipping_list_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "shipping_list_ids"=>"required",
        ],$custom_message);
        $shipping_lists = $this->shipping_lists->getShippingListsByIds($shipping_list_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_shipping_lists");
        $data["confirm_name"] = "ShippingLists";
        $data["confirm_data"] = $shipping_lists;
        $data["confirm_delete_url"]=route('delete_shipping_lists');
        $data["page_title"]="Confirm shipping_lists for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteShippingLists(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $shipping_list_ids = $request["item_ids"];
                foreach($shipping_list_ids as $shipping_list){
                   $shipping_list = $this->shipping_lists->find($shipping_list);
                    $shipping_list->delete();
                }
               return redirect()->route("admin_shipping_lists")->with('success','ShippingLists Deleted successfully.');
    }
}
