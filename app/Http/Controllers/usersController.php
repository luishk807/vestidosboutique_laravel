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
use Illuminate\Support\Facades\Hash;
use Auth;
use Mail;
use App;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Redirect;

class usersController extends Controller
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
    public function index(){
        $data=[];
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $data["brands"]=$this->brands->all();
        if(Auth::guard("vestidosUsers")->check()){
            $user=$this->users->find($user_id);
            $data["page_title"]= __('general.page_header.welcome',["name"=>$user->getFullName()]);
            $data["user"]=$user;
            return view("account/home",$data);
        }
        $data["page_title"]=__('header.log_in');
        return view('/signin',$data);
    }
    public function viewNewUser(Request $request){
        $data=[];
        $data["languages"]=$this->languages->where('status',1)->get();
        $data["genders"]=$this->genders->all();
        $data["page_title"]=__('general.page_header.new_account');
        return view("account/new",$data);
    }
    public function newUser(Request $request){
        $data=[];
        $this->validate($request,[
            "preferred_language"=>"required",
            "first_name"=>"required",
            "last_name"=>"required",
            "gender"=>"required",
            "password"=>"required | same:repassword",
            "repassword"=>"required | same:password",
            "date_of_birth"=>"required",
            "email"=>"required | email | unique:vestidos_users,email",
            "phone_number"=>"required",
        ]);
        
        $data["preferred_language"]=$request->input("preferred_language");
        $data["password"]=$request->input("password");
        $data["first_name"]=$request->input("first_name");
        $data["middle_name"]=$request->input("middle_name");
        $data["last_name"]=$request->input("last_name");
        $data["email"]=$request->input("email");
        $data["phone_number"]=$request->input("phone_number");
        $data["gender"]=$request->input("gender");
        $data["date_of_birth"]=$request->input("date_of_birth");
        
        $data["ip"]=$request->ip();
        $data["status"]=6;
        $data["user_type"]=1;
        $data["created_at"]=carbon::now();
        $data["password"]=Hash::make($request->input("password"));
        $data["remember_token"]=str_random(60);
        $user = Users::create($data);
        if(!empty($user->id)){
            $link = url('/account/activate/'. $user->remember_token);
            $data["link"]=$link;
            Mail::send('emails.usercreation_confirmation',["data"=>$data],function($message) use($data){
                $message->from("info@vestidosboutique.com","Vestidos Boutique");
                $client_name = $data['first_name']." ".$data["last_name"];
                $subject = __('general.user_section.registration_complete',['name'=>$client_name]);
                $message->to($data["email"],$client_name)->subject($subject);
                //$message->to("evil_luis@hotmail.com",$client_name)->subject($subject);
            });
            return redirect()->route('account_create_confirmed');
        }else{
            return redirect()->back();
        }
    }
    public function activeUserAccount($token){
        $userRaw = DB::table('vestidos_users')->where('remember_token',$token)->first();
        if($userRaw){
            $user = $this->users->find($userRaw->id);
            $user->status=1;
            if($user->save()){
                Users::find($user->id)->rollBackApi();
                return redirect()->route('user_account_activation_confirmed');
            }else{
                return redirect()->route('login_page')->with('msg',__('general.user_section.invalid_save'));
            }
        }else{
            return redirect()->route('login_page')->with('msg',__('auth.account_already_active'));
        }
    }
    public function ShowResendActiveUserAccount(){
        $data=[];
        $data["page_title"]=__('general.user_section.resend_activation_title');
        return view('/account/resend_active',$data);
    }
    public function ResendActiveUserAccount(Request $request){
        $data=[];
        $this->validate($request,[
            "email"=>"required | email",
        ]);
        $user = DB::table('vestidos_users')->where('email',$request->input("email"))->first();
        if($user){
            if(empty($user->remember_token)){
                Users::find($user->id)->rollBackApi();
            }
            $link = url('/account/activate/'. $user->remember_token);
            $data["link"]=$link;
            $data["first_name"]=$user->first_name;
            $data["last_name"]=$user->last_name;
            $data["middle_name"]=$user->middle_name;
            $data["email"]=$user->email;
            Mail::send('emails.usercreation_resend_confirmation',["data"=>$data],function($message) use($data){
                $message->from("info@vestidosboutique.com","Vestidos Boutique");
                $client_name = $data['first_name']." ".$data["last_name"];
                $subject = __('general.user_section.to_user.activate',['name'=>$client_name]);
                $message->to($data["email"],$client_name)->subject($subject);
                //$message->to("evil_luis@hotmail.com",$client_name)->subject($subject);
            });
            return redirect()->route('user_account_activation_confirmed_resend');
        }else{
            return redirect()->back()->withErrors(['required'=>__('general.form.no_email_match')]);
        }
    }
    public function updateUser(Request $request){
        $user_id = Auth::guard("vestidosUsers")->user()->getId();
        $user=$this->users->find($user_id);
        $data["page_title"]=__('general.page_header.edit_account');
        $data["languages"]=$this->languages->where('status',1)->get();
        $data["user"]=$user;
        $data["user_id"]=$user->id;
        if($request->isMethod("post")){
            $this->validate($request,[
                "preferred_language"=>"required",
                "first_name"=>"required",
                "last_name"=>"required",
                "password"=>"same:repassword",
                "email"=>"required | email | unique:vestidos_users,email,".$user_id,
                "phone_number"=>"required",
            ]);
            if(!empty($request->input("password"))){
                $user->password = Hash::make($request->input("password"));
            }
            $changeLang = false;
            if($user->preferred_language != $request->input("preferred_language")){
                $changeLang = true;
            }
            $user->preferred_language=$request->input("preferred_language");
            $user->first_name=$request->input("first_name");
            $user->middle_name=$request->input("middle_name");
            $user->last_name=$request->input("last_name");
            $user->email=$request->input("email");
            $user->phone_number=$request->input("phone_number");
            $user->updated_at=carbon::now();
            $user->save();
            if($changeLang){
                $lang = $user->getLanguage->code;
                App::setLocale($lang);
                Session::forget("locale");
                Session::put("locale",$lang);
            }
            return redirect()->route("user_account",['user_id'=>$user->id])->with('success',__('general.user_section.to_user.update',['name'=>$user->first_name]));
        }
        return view("account/edit",$data);
    }
    public function ShowSendPasswordResetForm(){
        $data=[];
        $data["page_title"]=__('general.forgot_password.title');
        return view('/password/forgot',$data);
    }
    public function SendResetPasswordEmail(Request $request){
        $data=[];
        $this->validate($request,[
            "email"=>"required | email",
        ]);
        $user = DB::table('vestidos_users')->where('email',$request->input("email"))->first();
        if($user){
            if(empty($user->remember_token)){
                Users::find($user->id)->rollBackApi();
            }
            $link = url('/password/reset/show/'. $user->remember_token);
            $data["link"]=$link;
            $data["first_name"]=$user->first_name;
            $data["last_name"]=$user->last_name;
            $data["middle_name"]=$user->middle_name;
            $data["email"]=$user->email;
            Mail::send('emails.password_reset',["data"=>$data],function($message) use($data){
                $message->from("info@vestidosboutique.com","Vestidos Boutique");
                $client_name = $data['first_name']." ".$data["last_name"];
                $subject = __('general.forgot_password.send_title',['name'=>$client_name]);
                $message->to($data["email"],$client_name)->subject($subject);
                //$message->to("evil_luis@hotmail.com",$client_name)->subject($subject);
            });
            return redirect()->route('forgot_password_confirm_sent',$data)->with('success',__('general.forgot_password.confirm_title'));;
        }else{
            return redirect()->back()->withErrors(['required'=>__('general.form.no_email_match')]);
        }
    }
    public function showPasswordResetForm(Request $request,$token){
        $data=[];
        $data["page_title"]=__('general.forgot_password.title');
        $user = DB::table('vestidos_users')->where('remember_token',$token)->first();
        if($user){
           $data["token"]=$token;
           return view('/password/reset',$data);
        }else{
            $data["page_title"]=__('general.forgot_password.confirm_title');
            return view('/password/forgot',$data)->withErrors(['required'=>__('general.forgot_password.invalid_token')]);
        }
    }
    public function resetpassword(Request $request){
        $data=[];
        $this->validate($request,[
            "password"=>"required | same:repassword",
            "repassword"=>"required | same:password",
            'token'=>"required",
        ]);
        $userRaw = DB::table('vestidos_users')->where('remember_token',$request->input("token"))->first();
        $user=$this->users->find($userRaw->id);
        $user->password=Hash::make($request->input("password"));
        $user->updated_at=carbon::now();
        if($user->save()){
            Users::find($user->id)->rollBackApi();
            $data["first_name"]=$user->first_name;
            $data["last_name"]=$user->last_name;
            $data["middle_name"]=$user->middle_name;
            $data["email"]=$user->email;
            $data["name"]=__('general.forgot_password.reset_confirm_email',["name"=>$user->first_name]);
            $data["message"]=__('general.forgot_password.reset_confirm_message');
            Mail::send('emails.default',["data"=>$data],function($message) use($data){
                $message->from("info@vestidosboutique.com","Vestidos Boutique");
                $client_name = $data['first_name']." ".$data["last_name"];
                $subject = __('general.user_section.to_user.update',['name'=>$client_name]);
                $message->to($data["email"],$client_name)->subject($subject);
                //$message->to("evil_luis@hotmail.com",$client_name)->subject($subject);
            });
            $data["page_title"]=__('header.log_in');
            return redirect()->route('login_page',$data)->with("msg",__('general.forgot_password.reset_confirm_message'));
        }else{
            return redirect()->route('show_reset_password')->with("msg",__('general.form.save_password_error'));
        }

    }
}
