<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends Controller
{
    public $success_status = 200;

    public function register(Request $request){

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'gender' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if($validate->fails()){
            return response()->json(['error' => $validate->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['created_at'] = date('Y-m-d H:M');
        $input['updated_at'] = date('Y-m-d H:M');
        $input['rating'] = 0;
        $user = User::create($input);
        $success['token'] = $user->createToken('WebJournal')->accessToken;
        $user->token = $success['token'];
        $user->save();
        return response()->json(['success' => $success], $this->success_status);
    }

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')], true)){
            $user = Auth::user();
            $success['token'] = $user->createToken('WebJournal')->accessToken;
            $user->token = $success['token'];
            $user->save();
            return response()->json(['success' => $success], $this->success_status);
        } else{
            return response()->json(['error' => "UnAuthorized"], 401);
        }
    }

}
