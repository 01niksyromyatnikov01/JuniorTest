<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 29.04.2018
 * Time: 22:28
 */


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


class Api {



    public static function auth($token) {
        $user = DB::table('users')->where('token','=',$token)->select('id','name')->first();
        return $user;
    }

    public static function id($token) {
        $id = DB::table('users')->where('token','=',$token)->value('id');
        if($id) return $id;
        else return 0;
    }

    public static function check($token) {
        $counter = DB::table('users')->where('token','=',$token)->count();
        if($counter > 0) return true;
        else return false;
    }

}