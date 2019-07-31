<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user;
class GantiPasswordController extends Controller
{
    //
    public function index(){
        return view('ganti_password');
    }
    public function action(Request $request){
       $this->validate($request,[

            'current_password'=>'required',
            'new_password'=>'required|min:6',
            'confirm_password'=>'required|min:6',
       ]);
       if(!Hash::check($request->get('current_password'),auth::user()->password)){
            return redirect()->back()->with('succes','password yang anda masukkan tidak sama');
       }
       if(strcmp($request->get('current_password'),$request->get('new_password'))==0){
            return redirect()->back()->with('succes','maaf password yang anda masukkan sama dengan password lama');
       }
       if(strcmp($request->get('new_password'),$request->get('confirm_password'))){
            return redirect()->back()->with('succes','maaf confirm password tidak sama');
       }
       $user=auth::user();
       $user->password=bcrypt($request->get('new_password'));
       $user->save();
       auth::logout();
       return redirect()->route('login')->with('succes','password berhasil di rubah');

    }
    public function Api(Request $request){
        $this->validate($request,[
            'current_password'=>'required',
            'new_password'=>'required|min:6',
            'confirm_password'=>'required|min:6',
       ]);
       if(!Hash::check($request->get('current_password'),auth::guard('api')->user()->password)){
            return Response()->json(['error'=>'password yang anda masukkan tidak cocok']);
       }
       if(strcmp($request->get('current_password'),$request->get('new_password'))==0){
            return Response()->json(['error'=>'maaf password yang anda masukkan sama dengan password lama']);
        }
       if(strcmp($request->get('new_password'),$request->get('confirm_password'))){
            return Response()->json(['error'=>'maaf confirm password tidak sama']);
       }
       $user=auth::guard('api')->user();
       $user->password=bcrypt($request->get('new_password'));
       $user->api_token=bcrypt($user->email);
       $user->save();
       return Response()->json(['success'=>'password berhasil di rubah']);

    }
}
