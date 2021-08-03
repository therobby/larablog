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

        if($post){
            return view('blog.view')
                ->with('post', $post)
                ->with('comments', $comments)
                ->with('user_id', auth()->id())
                ->with('auth', auth()->check());
                // TODO: Add comments
        } else {
            return view('404');
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
            var_dump($title);
            var_dump($body);

            $newPost = new BlogPost;

            $newPost->title = $title;
            $newPost->body = $body;
            $newPost->owner_id = auth()->id;

            $newPost->save();
            
            return redirect('/');
        } else{
            return view('404');
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
}
