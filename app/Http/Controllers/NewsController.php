<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function allNews(){
        $news = News::paginate(10)->sortBy('created_at');
        return view('welcome', compact('news'));
    }
    public function show($tech_name){
        $news = News::all()->where('tech_name', $tech_name)->first();
        return view('news.show', compact('news'));
    }
}
