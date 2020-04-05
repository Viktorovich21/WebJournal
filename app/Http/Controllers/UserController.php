<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserById(Request $request){
        if ($request['id']) {
            $user = User::where('id', $request['id'])->firstOrFail();
        } else if ($request['token']){
            $user = User::where('token', $request['token'])->firstOrFail();
        }
        return response()->json(['user' => [
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "rating" => $user->rating,
            "gender" => $user->gender]]);
    }

    public function getUserInfo($token){
        $user = User::where('token', $token) -> first();
        return response()->json(['user' => $user->name]);
    }

    public function getUsersListInfo(){
        $users = User::orderBy('rating')->get();
        return response()->json(['users' => $users]);
    }
}
