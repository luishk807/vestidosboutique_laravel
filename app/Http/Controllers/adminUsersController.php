<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosUsers as Users;
use App\vestidosUserTypes as UserTypes;
use App\vestidosStatus as Statuses;
use App\vestidosGenders as Genders;
use Carbon\Carbon as carbon;
use Illuminate\Support\Facades\Hash;
use App\vestidosLanguages as Languages;
use Mail;
use Excel;
use Auth;
use Session;

class adminUsersController extends Controller
{
    //
    public function __construct(Request $request,UserTypes $user_types, Genders $genders, Users $users, Statuses $statuses,Languages $languages){
        $this->users = $users;
        $this->statuses=$statuses;
        $this->languages=$languages;
        $this->user_types=$user_types;
        $this->genders = $genders;
        $this->config=$request->instance()->query('configData');
    }
    public function userAddress($user_id){
        $data=[];
        $user = $this->users->find($user_id);
        $data["addresses"]=$user->getAddresses()->get();
        $data["user"]=$user;
        $data["user_id"]=$user_id;
        $data["page_submenus"]=[
            [
                "url"=>route('admin_edituser',['user_id'=>$user_id]),
                "name"=>"Back to Edit"
            ],
            [
                "url"=>route('admin_newaddress',['user_id'=>$user_id]),
                "name"=>"Add Address"
            ]
        ];
        $data["delete_menu"] =route('confirm_delete_addresses');
        $data["page_title"]="Address Page For ".$user->getFullName();
        return view("admin/users/addresses/home",$data);
    }
    public function index(){
        $data = [];
        $data["delete_menu"] =route('confirm_delete_users');
        $data["page_title"]="Users";
        $data["page_submenus"]=[
            [
                "url"=>route('admin_newuser'),
                "name"=>"Add User"
            ],
            [
                "url"=>route('show_import_adminuser'),
                "name"=>"Import User"
            ]
        ];
        $data["main_items"]=$this->users->paginate(10);
        return view("admin/users/home",$data);
    }
    public function showNewUserForm(){
        $data = [];
        $data["page_title"]="New Users";
        $data["genders"] = $this->genders->all();
        $data["user_types"]=$this->user_types->all();
        $data["users"]=$this->users->all();
        $data["languages"]=$this->languages->all();
        return view("admin/users/new",$data);
    }
    function createUserForm(Request $request){
        $data = [];
        $data["password"]=$request->input("password");
        $data["first_name"]=$request->input("first_name");
        $data["middle_name"]=$request->input("middle_name");
        $data["last_name"]=$request->input("last_name");
        $data["phone_number"]=$request->input("phone_number");
        $data["email"]=$request->input("email");
        $data["date_of_birth"]=$request->input("date_of_birth");
        $data["gender"]=$request->input("gender");
        $data["preferred_language"]=$request->input("preferred_language");
        $data["status"]=(int)$request->input("status");
        $data["user_type"]=(int)$request->input("user_type");

        $this->validate($request,[
            "password"=>"required | same:re-type_password",
            "first_name"=>"required",
            "last_name"=>"required",
            "gender"=>"required",
            "email"=>"required | email | unique:vestidos_users,email",
            "date_of_birth"=>"required",
            "preferred_language"=>"required",
            "status"=>"required",
        ]);
        $data["ip"]=$request->ip();

        $data["created_at"]=carbon::now();
        $data["password"]=Hash::make($request->input("password"));
        if($this->users->insert($data)){
            $data["vestidos_email"]=$request->input("configData")["support_email"];
            if($request->input("user_type")==1){
                $data["link"]=route('login_user');
                Mail::send('emails.usercreation_confirmation',["data"=>$data],function($message) use($data){
                    $message->from($data["vestidos_email"],"Vestidos Boutique");
                    $client_name = $data['first_name']." ".$data["last_name"];
                    $subject = 'Hello '.$client_name.', your account registration is completed';
                    $message->to($data["email"],$client_name)->subject($subject);
                });
            }else{
                $data["link"]=route('admin_show_login');
                $u_type = $this->user_types->find($request->input("user_type"));
                $data["account_type"]=$u_type->name;
                Mail::send('emails.admincreation_confirmation',["data"=>$data],function($message) use($data){
                    $message->from($data["vestidos_email"],"Vestidos Boutique");
                    $client_name = $data['first_name']." ".$data["last_name"];
                    $subject = 'Hello '.$client_name.', your account registration is completed';
                    $message->to($data["email"],$client_name)->subject($subject);
                });
            }
            return redirect()->route("admin_users");
        }
        return redirect()->back();
    }
    function showUpdateUser($user_id, Request $request){
        $data=[];
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["page_submenus"]=[
            [
                "url"=>route('admin_users'),
                "name"=>"Back to Users"
            ],
            [
                "url"=>route('admin_address',['user_id'=>$user_id]),
                "name"=>"[".$user->getAddresses()->count()."] View Address"
            ]
        ];
        $data["page_title"]="Edit Info For ".$user->first_name;
        $data["user_id"]=$user_id;
        $data["user_types"]=$this->user_types->all();
        $data["languages"]=$this->languages->all();
        $data["genders"]=$this->genders->all();
        return view("admin/users/edit",$data);
    }
    function showUpdateAdmin(){
        $data=[];
        $user_id=Auth::guard(Session::get("guard"))->user()->getId();
        $user = $this->users->find($user_id);
        $data["user"]=$user;
        $data["page_title"]="Edit Info For ".$user->first_name;
        $data["user_id"]=$user_id;
        $data["user_types"]=$this->user_types->all();
        $data["languages"]=$this->languages->all();
        $data["genders"]=$this->genders->all();
        return view("admin/account",$data);
    }
    function updateAdmin(Request $request){
        $data=[];
        $user_id=Auth::guard(Session::get("guard"))->user()->getId();
        $data["password"]=$request->input("password");
        $data["first_name"]=$request->input("first_name");
        $data["middle_name"]=$request->input("middle_name");
        $data["last_name"]=$request->input("last_name");
        $data["phone_number"]=$request->input("phone_number");
        $data["email"]=$request->input("email");
        $data["gender"]=$request->input("gender");
        $data["preferred_language"]=$request->input("preferred_language");
        $data["date_of_birth"]=$request->input("date_of_birth");
        $data["status"]=(int)$request->input("status");
        $data["user_type"]=(int)$request->input("user_type");
        $user = $this->users->find($user_id);
        $this->validate($request,[
            "first_name"=>"required",
            "password" => "same:re-type_password",
            "last_name"=>"required",
            "phone_number"=>"required",
            "email"=>"required | email | unique:vestidos_users,email,".$user->id,
            "date_of_birth"=>"required",
            "gender"=>"required",
            "preferred_language"=>"required",
            "status"=>"required"
        ]);
        if(!empty($request->input("password"))){
            $user->password = Hash::make($request->input("password"));
        }
        //CHECK STATUS
        $old_status=(int)$request->input("status");
        $sendEmail = ($user->status != $old_status) ? true : false;

        $user->first_name = $request->input("first_name");
        $user->middle_name = $request->input("middle_name");
        $user->last_name = $request->input("last_name");
        $user->phone_number = $request->input("phone_number");
        $user->email = $request->input("email");
        $user->date_of_birth = $request->input("date_of_birth");
        $user->gender = (int)$request->input("gender");
        $user->user_type = (int)$request->input("user_type");
        $user->preferred_language = (int)$request->input("preferred_language");
        $user->status =$old_status;
        $user->updated_at = carbon::now();
        if($user->save()){
            if($sendEmail){
                switch($user->status){
                    case 1:
                        $data["message"]="Congratulations! Your account has been activated.";
                    break;
                    case 2:
                        $data["message"]="Your account has been cancelled";
                    break;
                    case 4:
                        $data["message"]="Your account has been placed on hold until further notice.";
                    break;
                    case 7:
                        $data["message"]="This email is to notify you that your account required notification before activation.";
                    break;
                    default:
                        $data["message"]="Your account has been updated!.";
                }
                $data["status_name"]=$user->getStatusName->name;
                $data["vestidos_email"]=$request->input("configData")["support_email"];
                Mail::send('emails.adminuser_update',["data"=>$data],function($message) use($data){
                    $message->from($data["vestidos_email"],"Vestidos Boutique");
                    $client_name = $data['first_name']." ".$data["last_name"];
                    $subject = 'Hello '.$client_name.', your account is updated';
                    $message->to($data["email"],$client_name)->subject($subject);
                });
            }
            return redirect()->route("admin")->with("success","User Updated");
        }else{
            redirect()->back();
        }
    }
    function updateUser($user_id, Request $request){
        $data=[];
        $data["password"]=$request->input("password");
        $data["first_name"]=$request->input("first_name");
        $data["middle_name"]=$request->input("middle_name");
        $data["last_name"]=$request->input("last_name");
        $data["phone_number"]=$request->input("phone_number");
        $data["email"]=$request->input("email");
        $data["gender"]=$request->input("gender");
        $data["preferred_language"]=$request->input("preferred_language");
        $data["date_of_birth"]=$request->input("date_of_birth");
        $data["status"]=(int)$request->input("status");
        $data["user_type"]=(int)$request->input("user_type");
        $user = $this->users->find($user_id);
        $this->validate($request,[
            "first_name"=>"required",
            "password" => "same:re-type_password",
            "last_name"=>"required",
            "phone_number"=>"required",
            "email"=>"required | email | unique:vestidos_users,email,".$user->id,
            "date_of_birth"=>"required",
            "gender"=>"required",
            "preferred_language"=>"required",
            "status"=>"required"
        ]);
        if(!empty($request->input("password"))){
            $user->password = Hash::make($request->input("password"));
        }
        //CHECK STATUS
        $old_status=(int)$request->input("status");
        $sendEmail = ($user->status != $old_status) ? true : false;

        $user->first_name = $request->input("first_name");
        $user->middle_name = $request->input("middle_name");
        $user->last_name = $request->input("last_name");
        $user->phone_number = $request->input("phone_number");
        $user->email = $request->input("email");
        $user->date_of_birth = $request->input("date_of_birth");
        $user->gender = (int)$request->input("gender");
        $user->user_type = (int)$request->input("user_type");
        $user->preferred_language = (int)$request->input("preferred_language");
        $user->status =$old_status;
        $user->updated_at = carbon::now();
        if($user->save()){
            if($sendEmail){
                switch($user->status){
                    case 1:
                        $data["message"]="Congratulations! Your account has been activated.";
                    break;
                    case 2:
                        $data["message"]="Your account has been cancelled";
                    break;
                    case 4:
                        $data["message"]="Your account has been placed on hold until further notice.";
                    break;
                    case 7:
                        $data["message"]="This email is to notify you that your account required notification before activation.";
                    break;
                    default:
                        $data["message"]="Your account has been updated!.";
                }
                $data["status_name"]=$user->getStatusName->name;
                $data["vestidos_email"]=$request->input("configData")["support_email"];
                Mail::send('emails.adminuser_update',["data"=>$data],function($message) use($data){
                    $message->from($data["vestidos_email"],"Vestidos Boutique");
                    $client_name = $data['first_name']." ".$data["last_name"];
                    $subject = 'Hello '.$client_name.', your account is updated';
                    $message->to($data["email"],$client_name)->subject($subject);
                });
            }
            return redirect()->route("admin_users")->with("success","User Updated");
        }else{
            redirect()->back();
        }
    }
    public function deleteConfirmUsers(Request $request){
        $user_ids = $request["user_ids"];
        $custom_message = [
            'required'=>"Please select a item to delete"
        ];
        $this->validate($request,[
            "user_ids"=>"required",
        ],$custom_message);
        $users = $this->users->getUsersByIds($user_ids);
        $data["confirm_type"] = "name";
        $data["confirm_return"] = route("admin_users");
        $data["confirm_name"] = "Users";
        $data["confirm_data"] = $users;
        $data["confirm_delete_url"]=route('delete_users');
        $data["page_title"]="Confirm users for deletion";
       return view("admin/confirm_delete",$data);
    }
    public function deleteUsers(Request $request){
    
            $this->validate($request,[
                "item_ids"=>"required",
            ],[
                'required'=>"Please select a item to delete"
            ]);
                $user_ids = $request["item_ids"];
                foreach($user_ids as $user){
                   $user = $this->users->find($user);
                    $user->delete();
                }
               return redirect()->route("admin_users")->with('success','Users Deleted successfully.');
    }
    public function deleteUser($user_id,Request $request){
        $data=[];
        if($request->input("_method")=="DELETE"){
            $user = $this->users->find($user_id);
            $user->delete();
            return redirect()->route("admin_users");
        }
        $data["user"]=$this->users->find($user_id);
        $data["page_title"]="Delete User";
        return view("admin/users/confirm",$data);
    }
    public function showImportUser(){
        $data=[];
        $data["page_title"]="Import Users";
        $data["import_btn"]="Import Users";
        return view("admin/users/import",$data);
    }

    public function saveImportUser(Request $request){
        $this->validate($request,[
            "file"=>"required"
        ]);

        if($request->hasFile('file')) {
            $path = $request->file->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            
            if(!empty($data) && $data->count()){
                foreach ($data as $value) {
                    $insert[]=[
                        "first_name"=>$value->first_name,
                        "middle_name"=>$value->middle_name,
                        "last_name"=>$value->last_name,
                        "password"=>Hash::make($value->password),
                        "email"=>$value->email,
                        "phone_number"=>$value->phone_number,
                        "date_of_birth"=>$value->date_of_birth,
                        "gender"=>$value->gender,
                        "preferred_language"=>$value->preferred_language,
                        "user_type"=>$value->user_type,
                        "status"=>1,
                        "ip"=>$request->ip(),
                        "created_at"=>carbon::now(),
                    ];
                }
                if(!empty($insert)){
                    Users::insert($insert);
                    return redirect()->route('admin_users')->with('success','Insert Record successfully.');
                }
            }
        }else{
            return redirect()->back()->withErrors([
                "required","No File Entered"
            ]);
        }
        return redirect()->back()->with('error','Please Check your file, Something is wrong there.');
    }
}
