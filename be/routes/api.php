<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(["message"=>"backend web"]);
});

Route::get('/login', function () {
    $user = request()->input("username");
    $password  = request()->input("password");

    $user = User::where("email",$user)->get()->first();
    if($user){
        if(Hash::check($password,$user->password)){
            $token = $user->createToken("app_token");
            return response()->json([
                "user"=>$user,
                "token"=>$token
            ]);
        }
    }
    return response()->json(["message"=>"failed"],401);
});
