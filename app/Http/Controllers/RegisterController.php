<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;
use Dotenv\Exception\ValidationException;

class RegisterController extends Controller
{
   


    public function Register(Request $request){

        
        $resp=new BaseController();
       $validtor=Validator::make($request->all(),[
    
        'name'=>'required',
        'email'=>'required|email',
        'password'=>'required',
        'c_password'=>'required|same:password',
    
       ]);


       if($validtor->fails()){

        return  $resp->sendError('error in validtor',$validtor->error);
       }
        $resp=new BaseController();
        $input=$request->all();
        $input['password']= Hash::make($input['password']);
        $user=User::create($input);
        $success['token']=$user->createToken('hayder')->accessToken;
        $success['name']=$user->name;
        return $resp->sendRespone($success,'Register Successfuly');

        
    }



    

    public function login(Request $request){

        $resp=new BaseController();
        $request->validate([
            'email' => 'required|email|exists:users,email', 
            'password' => 'required'
        ]);


       if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

                 $user=Auth::user();
                 
             $success['token']=$user->createToken('hayder')->accessToken;
            $success['name']=$user->name;
            return $resp->sendRespone($success,'Login Successfuly');
        }
        else{
            return $resp->sendError('error in validtor',['error'=>'Unauthorised']);
        }

    }
}

