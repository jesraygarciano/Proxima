<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Opening;
use App\Libs\Common;
use App\User;
use App\Message;
use Carbon\Carbon;

// use Common;


class MessagerController extends Controller
{
    public function index(Request $requests){
        // 
    }

    public function json_return_user_messages(Request $requests){
        return ['messages'=>Message::whereRaw('((reciever = '.$requests->reciever.' and user_id = '.\Auth::user()->id.') or (user_id = '.$requests->reciever.' and reciever='.\Auth::user()->id.'))')->orderBy('created_at','asc')->get()];
    }

    public function json_return_chatable_users(Request $requests){
        return ['users'=>[User::first(),User::find(301)]];
    }

    public function json_save_sent_message(Request $requests){
        Message::create(
            [
                'user_id'=>\Auth::user()->id,
                'reciever'=>$requests->reciever,
                'message'=>$requests->message
            ]
        );

        return 'message saved';
    }

    public function json_mark_message_seen(Request $requests){
        Message::where('reciever',$requests->reciever)->where('user_id',\Auth::user()->id)->update(['seen'=>1]);

        return 'message seen';
    }
}