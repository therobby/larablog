<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCommentModel extends Model
{
    use HasFactory;
    protected $table = 'blog_posts_comments';

    public function user(){
        return $this->hasOne(User::class, "id", "owner_id");
    }
}
