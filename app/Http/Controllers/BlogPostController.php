<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\PostCommentModel;
use App\Models\User;

class BlogPostController extends Controller
{
    
    public function index($id) {
        $post = BlogPost::where(['id' => $id])->first();
        $comments = PostCommentModel::where(['post_id' => $id])->get();

        $is_logged_in = auth()->check();
        $admin = false;
        if($is_logged_in){
            $admin = auth()->user()->admin;
        }

        if($post){
            return view('blog.view')
                ->with('post', $post)
                ->with('comments', $comments)
                ->with('author', auth()->id() == $post->owner_id)
                ->with('is_admin', $admin)
                ->with('user_id', auth()->id())
                ->with('auth', $is_logged_in);
        } else {
            return view('400');
        }
    }

    public function showCreate() {
        return view('blog.edit')
            ->with('title', "")
            ->with('body', "");
    }

    public function create(Request $request) {
        if($request->has(["title", "body"])){
            $title = $request->input('title');
            $body = $request->input('body');

            $newPost = new BlogPost;

            $newPost->title = $title;
            $newPost->body = $body;
            $newPost->owner_id = auth()->id();

            $newPost->save();
            
            return redirect('/');
        } else{
            return view('400');
        }
    }

    public function addComment(Request $request, $id){
        if($request->has('comment')){
            $comment = new PostCommentModel;
            $comment->body = $request->input('comment');
            $comment->owner_id = auth()->id();
            $comment->post_id = $id;
            $comment->save();
        }
        return redirect()->back();
    }

    public function deleteComment(Request $request, $comment_id){
        $comment = PostCommentModel::where(['owner_id' => auth()->id(), 'id' => $comment_id])->first();
        if($comment){
            $comment->delete();
        }
        return redirect()->back();
    }

    public function getEditPost(Request $request, $id){

        $post = BlogPost::where(['id' => $id])->first();
        
        if($post){
            return view('blog.edit')
                ->with('title', $post->title)
                ->with('body', $post->body)
                ->with('auth', auth()->check())
                ->with('id', $id);
        } else {
            return view('400');
        }
    }

    public function saveEditPost(Request $request, $id){
        $post = BlogPost::where(['id' => $id])->first();

        if($request->has(['title', 'body'])){
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->save();
            return redirect('/post/get/'.$id);
        } else {
            return view('400');
        }
    }

    public function deletePost(Request $request, $id){
        $post = BlogPost::where(['id' => $id])->first();
        if($post){
            $post->delete();
        }
        return redirect('/');
    }
}
