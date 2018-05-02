<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 21.04.2018
 * Time: 22:42
 */

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Validator;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use App\Repositories\UserRepository;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    /**
     * Экземпляр TaskRepository.
     *
     * @var ArticleRepository
     */
    protected $comments;
    protected $users;

    /**
     * Создание нового экземпляра контроллера.
     *
     * @param  TaskRepository $articles
     * @return void
     */
    public function __construct(CommentRepository $comments, UserRepository $users)
    {

        $this->comments = $comments;
        $this->users = $users;
    }

    /**
     * Показать список всех задач пользователя.
     *
     * @param  Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->middleware('auth');
        return view('index', [
            'articles' => $this->articles->forUser($request->user()),
        ]);
    }

    public function getAll($id)
    {
        $result =  $this->comments->forAll($id);
        if(!empty($result->id))
            return $result;
        else return response()->json(['error'=> 1,'message' => 'was not found']);
    }

    /** API STARTS */
    public function create(Request $request)
    {
        if(empty($request->token) AND \Auth::check()) {
            $this->authorize('create',Article::class);
            $name = \Auth::user()->name;
        }
        else if(isset($request->token) AND isset(API::auth($request->token)->name)) {
            $name = API::auth($request->token)->name;
        }
        else return response()->json(['error' => 1,'message' => 'incorrect token']);


        $validation = Validator::make($request->all(), [
            'text' => 'required|min:1|max:120',
            'article_id' => 'required',
        ]);


        if($validation->fails()) $validate = false;
        else $validate = true;

        if(!$validate) return response()->json(['error' => 1,'message' => $validation->errors()]);



        $res = $this->comments->create([
            'text' => $request->text,
            'article_id' => $request->article_id,
            'user_name' => $name,
        ]);



        if($res) {
            return response()->json(['message'=>'Created','error' => 0,'comment' => $request->text,'user_name' => $name]);
        }
        else return response()->json(['error' => 1,'message' => 'Failed to create']);


    }
}