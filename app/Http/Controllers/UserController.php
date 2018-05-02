<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 21.04.2018
 * Time: 22:42
 */

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    /**
     * Экземпляр UserRepository.
     *
     * @var UserRepository
     */
    protected $user,$article;

    /**
     * Создание нового экземпляра контроллера.
     *
     * @param  UserRepository  $user
     * @return void
     */
    public function __construct(UserRepository $user, ArticleRepository $article)
    {
        $this->article = $article;
        $this->user = $user;
    }

    /**
     * Показать список всех задач пользователя.
     *
     * @param  Request  $request
     * @return Response
     */
    public function myProfile() {
        $id = $this->getUserID();
        return view('users.profile',[
            'user' => $this->user->getYourself($id),
            'subs' => $this->getSubs($id),
            'articles' => $this->getArticles($id),
            'comments' => $this->getComments($id),
            'issubed' => $this->checkSubscribe($id)['result'],
            'visitor_id' => $id,
            'user_articles' => $this->article->ListforAuthor(),
        ]);
    }



    public function getUserID() {
        if(Auth::check())
        return Auth::id();
        else return 0;
    }


    public function getUser($id)
    {

        return view('users.profile', [
            'user' => $this->user->getUser($id)[0],
            'subs' => $this->getSubs($id),
            'articles' => $this->getArticles($id),
            'comments' => $this->getComments($id),
            'issubed' => $this->checkSubscribe($id)['result'],
            'visitor_id' => $this->getUserID(),
            'user_articles' => $this->article->ListforAuthor($id),
        ]);
    }

    public function checkSubscribe($id) {
        if(\Auth::check()) {
            if ($this->authorize('checkIfSub', User::class)) {
                return $this->user->checkIfSub($id);
            }
            else return ['result' => 'not-user'];
        }
        else return ['result' => 'not-user'];
    }



    public function getSubs($id) {
        return $this->user->countSubs($id);
    }

    public function getSubsList($id) {
        $result = $this->user->getSubsList($id);
        if(!empty($result[0]->id))
            return $result;
        else return response()->json(['error'=> 1,'message' => 'was not found'],404);
    }


    public function getArticles($id) {
        return $this->user->countArticles($id);
    }


    public function getComments($id) {
        return $this->user->countComments($id);
    }



    public function subscribe(Request $request)
    {
        if(empty($request->token) AND \Auth::check()) {
            $this->authorize('subscribe',User::class);
            $id = \Auth::id();
        }
        else if(isset($request->token)) {
            $id = API::id($request->token);
        }
        else return response()->json(['error' => 1,'message' => 'forbidden'],403);


        $validation = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);


        if($validation->fails())  return response()->json(['error' => 1,'message' => $validation->errors()]);


        $counter = $this->user->countDubSubs(['user_id' => $request->user_id,'sub_id' => $id]);
        if($counter < 1 )
        $res = $this->user->subscribe([
            'user_id' => $request->user_id,
            'id' => $id,
        ]);
        else $res = false;

        if($res) return response()->json(['result' => 1,'message' => 'subbed successfully']);
        else return response()->json(['error' => 1,'message' => 'failed to subscribe']);

    }



    public function unsubscribe(Request $request)
    {

        if(empty($request->token) AND \Auth::check()) {
            $this->authorize('unsubscribe',User::class);
            $id = \Auth::id();
        }
        else if(isset($request->token)) {
            $id = API::id($request->token);
        }
        else return response()->json(['error' => 1,'message' => 'forbidden'],403);


        $validation = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if($validation->fails())  return response()->json(['error' => 1,'message' => $validation->errors()]);


        $counter = $this->user->countDubSubs(['user_id' => $request->user_id,'sub_id' => $id]);
        if($counter == 1)
        $res = $this->user->unsubscribe([
            'user_id' => $request->user_id,
            'id' => $id,
        ]);
        else $res = false;

        if($res) return response()->json(['result' => 1,'message' => 'unsubscribed successfully']);
        else return response()->json(['error' => 1,'message' => 'failed to unsubscribe']);


    }













}