<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class SiteController extends Controller{

    public function index(){
        return view("about",['name' => '']);
    }

    public function about_us(Request $request,$name){

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

    }

    public function user_edit(Request $request){

        //$user = User::where('id',$id)->first();
        //$user = DB::table('users')->where('id', $id)->first();
        $data['user'] = User::find($request->id);
        return view('users.edit',$data);
    }

    public function update_user(Request $request){

        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'phone_number'=>'required',
            'email'=>'required|email|unique:users,email,'.$request->id]);

         $user_data = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "name" => $request->first_name.' '. $request->last_name,
            "phone_number" => $request->phone_number,
            "email" => $request->email];

            if(isset($request->password) && !empty($request->password)){

                $this->validate($request,['password' => 'min:8']);
                $user_data['password'] = $request->password;
            }

            User::where('id',$request->id)->update($user_data);

            session()->flash('success', 'User successfully updated.');

            return redirect()->to('/user-edit-'.$request->id);
    }

}
