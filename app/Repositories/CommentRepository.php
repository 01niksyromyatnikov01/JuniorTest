<?php

namespace App\Repositories;

use App\User;
use App\Comment;
use App\Http\Controllers\Auth;

class CommentRepository
{

    /**
     * Получить все комментарии заданного пользователя.
     *
     * @param  User  $user
     * @return Collection
     */


    public function forAll($id) {
        return Comment::orderBy('id','desc')->where('article_id','=',$id)->get(['id','user_name','text','created_at']);
    }

    public function One() {
        return Comment::orderBy('id','desc')->take(1)->get();
    }

    public function oneByID($id) {
        return Comment::where([['active','=',1],['id','=',$id]])->get();
    }

    public function Create($data) {
        return Comment::create([
            'text' => $data['text'],
            'article_id' => $data['article_id'],
            'user_name' => $data['user_name'],
        ]);
    }



}
