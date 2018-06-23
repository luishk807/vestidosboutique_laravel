<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vestidosUsers as Users;

class adminUsersController extends Controller
{
    //
    public function __construct(Users $users){
        $this->users = $users;
    }
    public function index(){
        $data = [];
        $data["page_title"]="Users";
        $data["users"]=$this->users->all();
        return view("admin/users/home",$data);
    }
    // public function newUser(){
    //     $data = [];
    //     $data["page_title"]="Users";
    //     $data["users"]=$this->users->all();
    //     return view("admin/users/home",$data);
    // }
    // public function updateUser(){
    //     $data = [];
    //     $data["page_title"]="Users";
    //     $data["users"]=$this->users->all();
    //     return view("admin/users/home",$data);
    // }
    // public function deleteUser(){
    //     $data = [];
    //     $data["page_title"]="Users";
    //     $data["users"]=$this->users->all();
    //     return view("admin/users/home",$data);
    // }
    // public function destroy(){
    //     $data = [];
    //     $data["page_title"]="Users";
    //     $data["users"]=$this->users->all();
    //     return view("admin/users/home",$data);
    // }
}
