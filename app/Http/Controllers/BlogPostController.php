<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogPostController extends Controller
{
    
    public function index($id) {
        $post = BlogPost::where(['id' => $id])->first();

        if($post){
            return view('blog.view')
                ->with('post', $post);
        } else {
            return view('404');
        }
    }
}
