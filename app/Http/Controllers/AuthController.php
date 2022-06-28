<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){

        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|unique:users'
        ]);

        if ($validator->fails()) {
    
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        try{
            $newUser = new User([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);
    
            $newUser->save();

            return response()->json(['data' => $newUser->email], 200);
        }catch(Exception $e){
            return response()->json(['error' => 'error al registrarse'], 500);
        }

        
    }

    

    public function login(Request $request){

        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|unique:users'
        ]);

        if ($validator->fails()) {

            return response()->json(['errors'=>$validator->errors()], 400);
        }

        try{

            $userFound = User::where('email', $request->get('email'))->first();

            if (Hash::check($request->get('password'), $userFound->password)){
                return response()->json(['data' => $userFound->email], 200);
            }else{
                return response()->json(['error' => 'error al logearse'], 401);
            }
            
        }catch(Exception $e){
            return response()->json(['error' => 'error del servidor'], 500);
        }
 

    } 
}
