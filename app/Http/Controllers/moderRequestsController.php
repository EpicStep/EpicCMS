<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class moderRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mRequest() {
        return  view('moder');
    }
}
