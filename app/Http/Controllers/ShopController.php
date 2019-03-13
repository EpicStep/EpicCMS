<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use App\Shop_item;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function serversShops(){
        $servers = Server::all()->where('shop', '1');
        return view('shop.index', compact('servers'));
    }

    public function allNewsByServerId($id){
        $items = Shop_item::all()->where('server_id', $id);
        return view('shop.show', compact('items'));
    }
}
