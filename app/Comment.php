<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Article;

class Comment extends Model
{


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    //
    protected $fillable = [
        'text', 'user_name', 'article_id',
    ];
}
