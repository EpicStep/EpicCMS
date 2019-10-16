<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LauncherController extends Controller
{
    public function login(){
        $login = request('login');
        $password = request('password');

        $error_msg = 'Username or password incorrect.';

        if (empty($login) || empty($password)){
            return $error_msg;
        }

        $user = User::where('name', $login)->first();

        if (!isset($user)){
            return $error_msg;
        }

        $currentPassword = $user->password;

        if (!password_verify($password, $currentPassword)) {
            return $error_msg;
        }

        return('OK:'. $login);
    }
}
