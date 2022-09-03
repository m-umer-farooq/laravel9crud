<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SiteController extends Controller{

    public function user_add(){

        return view("users.add");
    }

    public function list_users()
    {
        $users = User::all();

        $data['users'] = $users;

        return view("users.list",$data);
    }

    public function user_delete(Request $request)
    {
        $user = User::find($request->id);

        if(!empty($user)){

            $response = $user->delete(); //returns true/false

            if($response){
                session()->flash('success', 'User deleted successfully.');
            }else{
                session()->flash('errors', 'Unable to delete user.');
            }

        }else{
            session()->flash('errors', 'User not found.');
        }
        return redirect()->to('/list-users');
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
        //$data['user_data'] = DB::table('users')->where('id', $request->id)->first();
        $data['user_data'] = User::find($request->id);
        $data['page_title'] = 'Edit User';
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
