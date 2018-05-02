<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group.
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




/** COMMENTS */

/** id = article_id */
Route::get('comments/{id}','CommentController@getAll');  //+

Route::post('comments', 'CommentController@create'); //+


/** ARTICLE */

Route::get('articles', 'ArticleController@getAll'); //+

Route::get('articles/{id}', 'ArticleController@getOneByID'); //+

/** Latest one */
Route::get('article/', 'ArticleController@getOne'); //+

/** CREATE */
/** {token,header,desc}  */
Route::post('articles', 'ArticleController@create'); //+
/** DELETE */
/** {token} */
Route::delete('article/{article}','ArticleController@delete'); //+
/** UPDATE */
/** make article public(1) or private(0) */
/** {token,active} */
Route::put('article/{article}','ArticleController@put');  //+


/** USERS */

/** SUBBS */
/** return counter of user#id  */
Route::get('users/subscribers/{id}','UserController@getSubs'); //+

Route::get('users/subscribers/list/{id}','UserController@getSubsList'); //+

Route::post('users/subscribe','UserController@subscribe'); //+

Route::delete('users/unsubscribe','UserController@unsubscribe'); //+




