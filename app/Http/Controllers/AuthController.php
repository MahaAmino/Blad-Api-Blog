<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
    public function ShowLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $result=$request->validate([
        'email'=>'required|email',
        'password'=>'required',
        ]);

    if(Auth::attempt($result)){
        $request->session()->regenerate();
        return redirect()->route('post.index');
    }
    return redirect()->back()->withErrors(['email'=>'Invalid credentials']);
    }

    public function ShowRegisterForm(){
        return view('auth.register');
    }

    public function register(Request $request){

        $validator = FacadesValidator::make($request->all(),[
        'name'=>'required|string|max:255',
        'email'=>'required|email|unique:users',
        'password'=>'required|string|min:8|confirmed',
        'image' =>  'file|mimes:jpg,jpeg,png,gif|max:1024',
        ]);
        if($validator->fails()){
            return response($validator->messages(), 200);
        }
        $user=new User;
        if($request->hasFile('image')){
            $img=$request['image'];
            $imgName=time().".".$img->getClientOriginalExtension();
            $img->move('./assets/imgs',$imgName);
    }

        $user->create(
        [  'name'=>$request['name'],
            'email'=>$request['email'],
            'password' => Hash::make($request['password']),
            'image'=>$imgName,
        ]);
        Auth::login($user);
        return redirect()->route('post.index');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('post.index');
    }

}
