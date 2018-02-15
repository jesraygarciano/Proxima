<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Opening;
use App\Libs\Common;
use App\User;
use Carbon\Carbon;

// use Common;


class MessagerController extends Controller
{
    public function index(Request $requests){
        // 
    }

    public function json_return_user_messages(Request $requests){
        return ['messages'=>[]];
    }

    public function json_return_chatable_users(Request $requests){
        return ['users'=>[User::first(),User::find(301)]];
    }
}