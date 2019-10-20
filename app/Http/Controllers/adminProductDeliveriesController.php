<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosProductDeliveries as ProductDeliveries;
use App\vestidosStatus as Statuses;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon as carbon;
use Auth;
use Illuminate\Support\Facades\DB;
use Session;

class adminProductDeliveriesController extends Controller
{
    //
    public function __construct(Statuses $statuses, ProductDeliveries $product_deliveries){
        $this->statuses=$statuses;
        $this->product_deliveries = $product_deliveries;
    }
    function index(){
        $data=[];
        $data["main_items"]=$this->product_deliveries->paginate(10);
        $data["page_submenus"]=[
            [
                "url"=>route('new_product_delivery'),
                "name"=>"Add Product Delivery"
            ]
        ];
        $data["deliveries"]=$this->product_deliveries->all();
        $data["delete_menu"] =route('confirm_delete_product_deliveries');
        $data["page_title"]="Product Deliveries";
        return view("admin/home_config/deliveries/home",$data);
    }
    function newDelivery(Request $request){
        $data=[];
        $data["page_title"]="Create Delivery Page";
        return view("admin/home_config/deliveries/new",$data);
    }
    function createDelivery(Request $request){
        $data=[];
        $data["name"]=$request->input("name");
        $data["description"]=$request->input("description");
        $data["total"]=$request->input("total");
        $data["status"]=$request->input("status");
        $this->validate($request,[
            "total"=>"required",
            "status"=>"required",
            "description"=>"required",
            "name"=>"required"
        ]);
        $data_save["name"]=$request->input("name");
        if($request->input("main")=="true"){
            DB::table('vestidos_product_deliveries')->where('main', '=', 1)->update(array('main' => 0));
        }
        $data_save["main"]=$request->input("main")=="true" ? true : false;
        $data_save["total"]=$request->input("total");
        $data_save["description"]=$request->input("description");
        $data_save["status"]=$request->input("status");
        $data_save["created_at"]=carbon::now();
        $this->product_deliveries->insert($data_save);
        return redirect()->route("admin_deliveries");
    }
    function editDelivery($delivery_id){
        $data=[];
        $delivery= $this->product_deliveries->find($delivery_id);
        $data["delivery"]=$delivery;
        $data["page_title"]="Edit Delivery";
       return view("admin/home_config/deliveries/edit",$data);
    }
    function saveDelivery($delivery_id, Request $request){
        $data=[];
        $this->product_deliveries->update(array("main"=>false));

        $data["name"]=$request->input("name");
        $data["total"]=$request->input("total");
        $data["description"]=$request->input("description");
        $data["status"]=$request->input("status");
        $delivery = $this->product_deliveries->find($delivery_id);

        $this->validate($request,[
            "description"=>"required",
            "status"=>"required",
            "total"=>"required",
            "name"=>"required"
        ]);
        $delivery->name = $request->input("name");
        $delivery->description = $request->input("description");
        if($request->input("main")=="true"){
            DB::table('vestidos_product_deliveries')->where('main', '=', 1)->update(array('main' => 0));
        }
        $delivery->main=$request->input("main")=="true" ? true : false;
        $delivery->total = (int)$request->input("total");
        $delivery->status = (int)$request->input("status");
        $delivery->updated_at = carbon::now();
        $delivery->save();
        return redirect()->route("admin_deliveries");
    }
    public function deleteDelivery($delivery_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $delivery = $this->product_deliveries->find($delivery_id);
            $delivery->delete();
            return redirect()->route("admin_deliveries");
        }
        $data["delivery"]=$this->product_deliveries->find($delivery_id);
        $data["page_title"]="Delete Delivery";
        return view("admin/home_config/deliveries/confirm",$data);
    }
    public function deleteConfirmDeliveries(Request $request){
        $delivery_ids = $request["delivery_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "delivery_ids"=>"required",
        ],$custom_message);
        $deliveries = $this->product_deliveries->getDeliveriesByIds($delivery_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_deliveries");
        $data["confirm_name"] = "Deliveries";
        $data["confirm_data"] = $deliveries;
        $data["confirm_delete_url"]=route('delete_product_deliveries');
        $data["page_title"]="Confirm Deliveries for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteDeliveries(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $deliveries_ids = $request["item_ids"];
                foreach($deliveries_ids as $delivery){
                   $delivery = $this->product_deliveries->find($delivery);
                    $delivery->delete();
                }
               return redirect()->route("admin_deliveries")->with('success','Deliveries deleted successfully.');
    }
}
