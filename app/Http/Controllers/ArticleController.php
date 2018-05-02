<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 21.04.2018
 * Time: 22:42
 */

namespace App\Http\Controllers;


use Validator;
use App\Article;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API;
use App\Repositories\ArticleRepository;
use App\Repositories\UserRepository;

class ArticleController extends Controller
{
    /**
     * Экземпляр ArticleRepository.
     *
     * @var ArticleRepository
     */
    protected $articles;
    protected $users;
    protected $api;

    /**
     * Создание нового экземпляра контроллера.
     *
     * @param  ArticleRepository  $articles
     * @return void
     */
    public function __construct(ArticleRepository $articles,UserRepository $users,API $api)
    {

        $this->articles = $articles;
        $this->users = $users;
        $this->api = $api;
    }

    /**
     * Показать список всех задач пользователя.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->middleware('auth');
        return view('index', [
            'articles' => $this->articles->forUser($request->user()),
        ]);
    }

    public function getArticles() {
        return view('articles.index',[
            'articles' => $this->articles->ForAll()
        ]);
    }

    public function get3NewestArticles()
    {
        return view('index',[
            'articles' => $this->articles->top3forUser()
        ]);
    }

    public function getArticle($id)
    {
        $article = $this->articles->oneByID($id);
        if($article != 'not-allowed') {
            return view('articles.article', [
                'article' => $article,
                'author' => $this->users->getUserName($article->user_id)]);
        }
        else return redirect('/');
    }

    public function userArticlesList() {
    return view('articles.userList',[
        'articles' => $this->articles->ListforAuthor(),
        ]);
    }




    /** API STARTS */
    public function delete(Request $request,Article $article)
    {
        if(empty($request->token) AND \Auth::check()) {
            $id = \Auth::id();
        }
        else if(isset($request->token)) {
            $id = API::id($request->token);
        }
        else return redirect('/');


        if($id == $article->user_id) {
            $this->articles->delete(['id' => $article->id,'user_id' => $id]);

            return response()->json(['result' => '1', 'message' => 'deleted']);
        }
        else return response()->json(['error' => '1','message' => 'not-allowed']);
    }



    public function put(Request $request,Article $article)
    {

        if(empty($request->token) AND \Auth::check()) {
            $id = \Auth::id();
        }
        else if(isset($request->token)) {
            $id = API::id($request->token);
        }
        else return redirect('/');


        if($id === $article->user_id) {
           if($this->articles->update(['id'=>$article->id,'user_id' => $id,'active' => $request->active]))
            return response()->json(['result' => '1', 'message' => 'updated']);
           else return response()->json(['error' => '1']);
        }
        else return response()->json(['error' => '1','message' => 'not-allowed']);
    }




    public function create(Request $request)
    {


        if(empty($request->token) AND \Auth::check()) {
            $this->authorize('create',Article::class);
            $id = \Auth::id();
        }
        else if(isset($request->token)) {
            $id = API::id($request->token);
        }
        else return redirect('/');



        $validation = Validator::make($request->input(), [
            'header' => 'required|unique:articles|min:10|max:120',
            'description' => 'required|min:100|max:2500',
        ]);

        if($validation->fails()) $validate = false;
        else $validate = true;



        if(!$validate AND \Auth::check())  return back()->withErrors($validation)->withInput();
        else if(!$validate) return response()->json(['error' => 1,'message' => $validation->errors()]);


        $res = $this->articles->create([
            'id' => $id,
            'header' => $request->header,
            'desc' => $request->description,
        ]);
           if($res AND !\Auth::check()) {
               return response()->json([
                'message' => 'Created successfully']);
           }
           if($res AND \Auth::check()) {
               return redirect('/articles/my');
           }
           else return back();




    }






    public function getAll()
    {
        $result = $this->articles->forAll();
        if(!empty($result[0]->id))
            return $result;
        else return response()->json(['error'=> 1,'message' => 'was not found']);
    }


    public function getOne() {
        $result = $this->articles->One();
        if(!empty($result[0]->id))
        return $result;
        else return response()->json(['error'=> 1,'message' => 'was not found']);
    }

    public function getOneByID($id) {
        $result = $this->articles->OneByID($id);
        if(!empty($result->id))
            return $result;
        else return response()->json(['error'=> 1,'message' => 'was not found']);
    }




    public function show(Product $product)
    {
        return $product;
    }







}