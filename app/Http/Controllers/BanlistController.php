<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banlist;

class BanlistController extends Controller
{
    public function banlist() {
        $banlist = Banlist::paginate(15);
        return view('banlist', compact('banlist'));
    }
}
