<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class HomeController extends Controller
{
    
    public function index() {
        $posts = BlogPost::all();


        return view('main')
            ->with('posts', $posts); 
    }
}
