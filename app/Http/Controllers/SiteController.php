<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    public function index()
    {
        return view("about",['name' => '']);
    }

    public function about_us(Request $request,$name)
    {
        return view("about",['name' => $name]);
    }

    public function user_add(){

        return view("users.add");
    }

    public function store_user(Request $request){

        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'phone_number'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8',
         ]);


         $user = new User([
            "first_name" => $request->get('first_name'),
            "last_name" => $request->get('last_name'),
            "name" => $request->get('first_name').' '. $request->get('last_name'),
            "phone_number" => $request->get('phone_number'),
            "email" => $request->get('email'),
            "password" => $request->get('password'),
        ]);

        $user->save();

        session()->flash('success', 'User successfully added.');

        return redirect()->to('/user-add');

         //return view("users.add");
    }

}
