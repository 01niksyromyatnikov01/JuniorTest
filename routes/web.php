<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('setlocale/{locale}', function ($locale) {

    if (in_array($locale, \Config::get('app.locales'))) {   # Проверяем, что у пользователя выбран доступный язык
        Session::put('locale', $locale);                    # И устанавливаем его в сессии под именем locale
    }

    return redirect()->back();                              # Редиректим его <s>взад</s> на ту же страницу

})->name('setlocale');


Route::get('/','ArticleController@get3NewestArticles');

Route::get('/articles','ArticleController@getArticles');


Route::get('/article/post',function () {
    return view('articles.add');
})->middleware('auth');




Route::get('/article/{id}','ArticleController@getArticle');

Route::post('/article/new','ArticleController@create')->middleware('auth');

Route::get('/articles/my','ArticleController@userArticlesList')->middleware('auth');

Route::get('/user/{id}','UserController@getUser');

Route::get('/user', 'UserController@myProfile')->middleware('auth')->name('home');




// Auth Routes
Route::get('auth/register', 'Auth\RegisterController@getRegister');

Route::post('auth/register', 'Auth\RegisterController@postRegister');

Auth::routes();



Route::get('/home', 'HomeController@index', function () {route('home');});
