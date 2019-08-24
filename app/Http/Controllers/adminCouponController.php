<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\vestidosCoupons as Coupons;
use App\vestidosProducts as Products;
use Carbon\Carbon as carbon;
use App\vestidosStatus as Statuses;
use Excel;
use Session;
use Auth;
use DB;

class adminCouponController extends Controller
{
    //
    public function __construct(Coupons $coupons, Products $products, Statuses $statuses){
        $this->coupons = $coupons;
        $this->products = $products;
        $this->statuses = $statuses;
    }
    public function index(){
        $data=[];
        $data["main_items"]=$this->coupons->paginate(10);
        $data["page_title"]="Coupons";
        $data["page_submenus"]=[
            [
                "url"=>route('new_coupon'),
                "name"=>"Add Coupon"
            ]
            // ,
            // [
            //     "url"=>route('show_import_coupon'),
            //     "name"=>"Import Coupon"
            // ]
        ];
        //$data["delete_menu"] =route('confirm_delete_coupons');
        return view("admin/coupons/home",$data);
    }
    public function showNewCoupon(Request $request){
        $data["page_title"]="New Coupon";
        $data["statuses"]=$this->statuses->all();
        return view("admin/coupons/new",$data);
    }
    public function createNewCoupon(Request $request){
        $data=[];
        $this->validate($request,[
            "code"=>[
                "required",
                Rule::unique('vestidos_coupons')->where(function ($query) use ($request) {
                    return $query->where("code",$request->input("code"));
                })
            ],
            "discount"=>"required",
            "status"=>"required",
        ]
        );
        $data["code"]=$request->input("code");
        $data["short_desc"]=$request->input("short_desc");
        $data["description"]=$request->input("description");
        $data["discount"]=$request->input("discount");
        $data["exp_date"]=$request->input("exp_date");
        $data["status"]=(int)$request->input("status");
        $data["created_at"]=carbon::now();
        $date["updated_at"]=carbon::now();
        $this->coupons->insert($data);
        return redirect()->route("admin_coupons");
    }
    public function editCoupon($coupon_id,Request $request){
        $data=[];
        $coupon =$this->coupons->find($coupon_id);
        $data["statuses"]=$this->statuses->all();
        $data["page_title"]="Edit Coupon";
        $data["coupon"]=$coupon;
        $data["coupon_id"]=$coupon_id;
        $data["page_title"]="Edit Coupon";
        return view("admin/coupons/edit",$data);
    }
    public function saveCoupon($coupon_id,Request $request){
        $data=[];
        $coupon =$this->coupons->find($coupon_id);
        $this->validate($request,[
            "code"=>"required | unique:vestidos_coupons,code,".$coupon_id,
            "discount"=>"required",
            "status"=>"required",
        ]);
        $coupon->discount=$request->input("discount");
        $coupon->short_desc=$request->input("short_desc");
        $coupon->description=$request->input("description");
        $coupon->exp_date=$request->input("exp_date");
        $coupon->status=(int)$request->input("status");
        $coupon->updated_at=carbon::now();

        $coupon->save();

        return redirect()->route("admin_coupons");
    }
    public function deleteCoupon($coupon_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $coupon = $this->coupons->find($coupon_id);
            $coupon->delete();
            return redirect()->route("admin_coupons");
        }
        $data["coupon"]=$this->coupons->find($coupon_id);
        $data["page_title"]="Delete Coupons";
        return view("admin/coupons/confirm",$data);
    }
    public function showImportCoupons(){
        $data=[];
        $data["page_title"]="Import Coupons";
        $data["import_btn"]="Import Coupons";
        return view("admin/coupons/import",$data);
    }

    public function saveImportCoupons(Request $request){
        $this->validate($request,[
            "file"=>"required"
        ]);

        if($request->hasFile('file')) {
            $path = $request->file->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            
            if(!empty($data) && $data->count()){
                foreach ($data as $value) {
                    $insert[]=[
                        "code"=>$value->code,
                        "discount"=>$value->code,
                        "short_desc"=>$value->short_description,
                        "description"=>$value->description,
                        "exp_date"=>$value->exp_date,
                        "status"=>1,
                        "created_at"=>carbon::now(),
                    ];
                }
                if(!empty($insert)){
                    Coupons::insert($insert);
                    return redirect()->route('admin_coupons')->with('success','Insert Record successfully.');
                }
            }
        }else{
            return redirect()->back()->withErrors([
                "required","No File Entered"
            ]);
        }
        return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }
    public function deleteConfirmCoupons(Request $request){
        $coupon_ids = $request["coupons_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "coupons_ids"=>"required",
        ],$custom_message);
        $coupons = $this->coupons->getCouponsByIds($coupon_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_coupons");
        $data["confirm_name"] = "Coupons";
        $data["confirm_data"] = $coupons;
        $data["confirm_delete_url"]=route('delete_coupons');
        $data["page_title"]="Confirm coupons for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteCoupons(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $coupon_ids = $request["item_ids"];
                foreach($coupon_ids as $coupon){
                   $coupon = $this->coupons->find($coupon);
                    $coupon->delete();
                }
               return redirect()->route("admin_coupons")->with('success','Coupons Deleted successfully.');
    }
}
