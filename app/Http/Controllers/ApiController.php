<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 28.04.2018
 * Time: 0:04
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


class ApiRepository extends Controller {


    protected $token;

    function __construct($token)
    {
        $this->token = $token;
    }

    public function auth() {
        $user = DB::table('users')->where('token','=',$this->token)->select('id','name');
        return $user;
    }

    public function getID() {
        $id = DB::table('users')->where('token','=',$this->token)->select('id');
        if($id)
        return $id;
        else return 0;
    }

    public function check() {
        $counter = DB::table('users')->where('token','=',$this->token)->count();
        if($counter > 0) return true;
        else return false;
    }

}