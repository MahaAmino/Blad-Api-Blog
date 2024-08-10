<?php
namespace App\Http\Controllers\api;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{   public function login(Request $request){
        $result=$request->validate([
        'email'=>'required|email|string',
        'password'=>'required|string|min:8',
        ]);
        $user=User::where('email',$result['email'])->first();
        if(!$user || !Hash::check($result['password'],$user->password)){
            return  response()->json(['message'=>'Not Found'],404);
        }
        $token=$user->createToken($user->name .'-authToken')->plainTextToken;
            return response()->json(['token'=>$token],200);
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
        return response()->json(['message'=>'well done'],200);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'well done'],200);
    }

}

