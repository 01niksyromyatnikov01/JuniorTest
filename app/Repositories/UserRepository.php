<?php

namespace App\Repositories;

use App\User;
use App\Article;
use App\Comment;


use Illuminate\Support\Facades\DB;

class UserRepository
{

    protected $user;
    function __construct(User $user)
    {
        $this->user = $user;
    }

    /**

     * @return Collection
     */

    public function getYourself($id) {
        return $this->user->where('id','=',$id)->first();
    }

    public function getUserName($id)
    {
        return $this->user->where('id','=',$id)->value('name');
    }

    public function getUser($id)
    {
        return $this->user->where('id','=',$id)->get();
    }

    public function getSubsList($id)
    {
        return DB::table('subs')->where('user_id','=',$id)->get(['id','subber_id']);
    }



    public function checkIfSub($id) {
        $res = DB::table('subs')->where([['subber_id','=',\Auth::id()],['user_id','=',$id]])->count();
        if($res >0) return ['result' => 'sub'];
        else return ['result' => 'unsub'];
    }

    public function countSubs($id) {
        return DB::table('subs')->where('user_id','=',$id)->count();
    }


    public function countArticles($id) {
        return Article::where('user_id','=',$id)->count();
    }

    public function countComments($id) {
        $name = $this->getUserName($id);
        return Comment::where('user_name','=',$name)->count();
    }

    public function countDubSubs($data) {
        return \DB::table('subs')->where([['user_id','=',$data['user_id']],['subber_id','=',$data['sub_id']]])->count();
    }

    public function subscribe($data) {
        return DB::table('subs')->insert([
            'user_id' => $data['user_id'],
            'subber_id' => $data['id'],
        ]);
    }

    public function unsubscribe($data) {
        return DB::table('subs')->where([['user_id','=',$data['user_id']],['subber_id','=',$data['id']]])->delete();
    }



}
