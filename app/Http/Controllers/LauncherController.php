<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LauncherController extends Controller
{
    public function login(){
        $login = request('login');
        $password = request('password');

        if (empty($login) || empty($password)){
            exit('Введите логин или пороль');
        }

        $user = User::where('name', $login)->first();

        $password = bcrypt($password);

        if (!isset($user)){
            exit('Данного пользователя не существует.');
        }

        $userpass = $user->password;

        dd($userpass, ' || ', $password);

        if ($password == $userpass) {
            $msg = '1';
            return $msg;
        }
    }
}
