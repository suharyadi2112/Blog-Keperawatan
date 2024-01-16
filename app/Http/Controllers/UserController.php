<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user=DB::table('users')->get();
        return view('admin.profile.index',['user'=>$user]);
    }

    public function edit($id){
        $user=DB::table('users')->where('id',($id))->get();
        return view('admin.profile.edit',['user'=>$user]);
    }

    public function update(Request $request){

        $password=$request->password;

        if ($password!=null) {
            
            DB::table('users')->where('id',($request->id))->update([
                'name'=>$request->name,
                'username'=>$request->username,
                'password'=>Hash::make($password)
            ]);
        } else {
            # code...
            DB::table('users')->where('id',($request->id))->update([
                'name'=>$request->name,
                'username'=>$request->username
                // 'password'=>Hash::make($password)
            ]);
        }
        
        
        return redirect('profile');
    }
}
