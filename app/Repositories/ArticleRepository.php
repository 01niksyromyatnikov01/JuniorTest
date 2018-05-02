<?php

namespace App\Repositories;

use App\User;
use App\Article;
use Illuminate\Support\Facades\Auth;

class ArticleRepository
{

    /**
     * Получить все новости заданного пользователя.
     *
     * @param  User $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->articles()
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function top3forUser()
    {
        return Article::orderBy('id', 'desc')->take(3)->where('active', 1)->get();
    }

    public function forAll()
    {
        return Article::orderBy('id', 'desc')->where('active', 1)->get();
    }

    public function One()
    {
        return Article::where('active','=',1)->orderBy('id', 'desc')->take(1)->get();
    }

    public function oneByID($id)
    {
        $article = Article::where('id', '=', $id)->first();
        if(\Auth::check() AND $article->user_id == \Auth::id() AND $article->active == 0)
            return $article;
        else if($article->active == 0) return $article['result'] = 'not-allowed';
            else return $article;
    }

    public function ListforAuthor($id=0) {
        if($id==0) return Article::where('user_id','=',\Auth::user()->id)->orderBy('id','desc')->get();
        else return Article::where([['user_id','=',$id],['active','=',1]])->orderBy('id','desc')->get();
    }

    public function Create($data)
    {
            return Article::create([
                'header' => $data['header'],
                'desc' => $data['desc'],
                'user_id' => $data['id'],
            ]);
    }


    public function Delete($data)
    {
        return Article::where([['user_id','=',$data['user_id']],['id','=',$data['id']]])->delete();
    }

    public function Update($data)
    {
        $arr = [];
        if(isset($data['active'])) $arr['active'] =$data['active'] ;
        if(!empty($arr))
         return Article::where([['user_id','=',$data['user_id']],['id','=',$data['id']]])->update($arr);
        else return false;
    }
}
