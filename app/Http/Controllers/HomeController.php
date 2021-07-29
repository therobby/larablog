<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = BlogPost::all();

        for($i=0; $i < count($posts); $i++){
            $posts[$i]->body = substr($posts[$i]->body, 0, 50) . "...";
        }

        return view('main')
            ->with('posts', $posts)
            ->with('auth', auth()->check());
    }
}
