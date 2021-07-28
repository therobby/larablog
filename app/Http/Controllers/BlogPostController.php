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

    public function createIndex() {
        return view('blog.edit')
            ->with('title', "")
            ->with('body', "");
    }

    public function create(Request $request) {
        if($request->has(["title", "body"])){
            $title = $request->input('title');
            $body = $request->input('body');
            var_dump($title);
            var_dump($body);

            $newPost = new BlogPost;

            $newPost->title = $title;
            $newPost->body = $body;
            $newPost->owner_id = 1; // TODO: temporal

            $newPost->save();
            
            return redirect('/');
        } else{
            return view('404');
        }
    }
}
