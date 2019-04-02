<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

// Все модели для форма.
use App\Sections;
use App\Categories;
use App\SubCategories;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('forum'); // Middleware для формума
        $this->middleware('auth');
    }

    public function forumIndex(){
        $allsections = Sections::all();
        $allcategories = Categories::all();
        return view('forum.index', compact('allsections', 'allcategories'));
    }

    public function showSection($section_id){
        $categories = Categories::all()->where('section_id', $section_id);
        return view('forum.category', compact('categories'));
    }

    public function showSubcategory($section_id){
        $categories = Categories::all()->where('section_id', $section_id);
        return view('forum.category', compact('categories'));
    }
}
