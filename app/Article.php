<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected $fillable = ['header','desc','user_id','active','updated_at'];

    protected $hidden = ['created_at','active'];
    //
}
