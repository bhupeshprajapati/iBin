<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostComments extends Model
{
    protected $table = 'comments';
       // public function comments(){
       //     $this->hasMany(PostComments::class);
       // }
    public function post(){
       return $this->hasOne(Post::class);
    }
}
