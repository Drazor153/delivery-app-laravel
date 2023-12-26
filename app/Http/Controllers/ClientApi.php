<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class ClientApi extends Controller
{
    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $hpass = hash('sha256', $password);
        $user = UserModel::all()->where('email', $email)->first();
        if($user == null){
            $success = false;
            return compact('success');
        }
        if($user->password == $hpass){
            $success = true;
            return compact('success', 'user');
        }else{
            $success = false;
            return compact('success');
        }
    }
}
