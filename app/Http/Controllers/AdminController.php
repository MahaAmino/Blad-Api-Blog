<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AdminController extends Controller
{
    public function index(){
            $users=User::whereNot('id',auth()->id())->get();
            return view('admin.users.index',compact('users'));
    }
    public function create(){
        return view('admin.users.create');
    }

    public function store(Request $request){

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
        return redirect()->route('admin.users.index');
    }
    public function destroy(User $user){
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','user deleted successful');
    }
    public function ban(User $user){
        $user = User::find($user->id);
        if ($user->status == true){
            $user->status =false;
            $user->save();
            return redirect()->route('admin.users.index')->with('success','user UBan successful');
        }elseif($user->status ==false)
    {
            $user->status =true;
            $user->save();
        return redirect()->route('admin.users.index')->with('success','user Ban successful');
    }}
}


