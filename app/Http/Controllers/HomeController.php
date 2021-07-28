<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class HomeController extends Controller
{
    
    public function index() {
        $posts = BlogPost::all();

        for($i=0; $i < count($posts); $i++){
            $posts[$i]->body = substr($posts[$i]->body, 0, 50) . "...";
        }

        return view('main')
            ->with('posts', $posts); 
    }
}
