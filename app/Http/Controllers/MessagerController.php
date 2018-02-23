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
use App\Contact;

// use Common;


class MessagerController extends Controller
{
    public function index(Request $requests){
        // 
    }

    public function json_return_user_messages(Request $requests){
        return ['messages'=>Message::whereRaw('((reciever = '.$requests->reciever.' and user_id = '.\Auth::user()->id.') or (user_id = '.$requests->reciever.' and reciever='.\Auth::user()->id.'))')->orderBy('created_at','desc')->limit(10)->get()];
    }

    public function json_return_chatable_users(Request $requests){
        return ['users'=>\Auth::user()->contacts->load('contact')->load('latestMessage'), 'recieved_request'=> \Auth::user()->receivedContactRequests->load('user')];
    }

    public function json_fetch_previews_messages(Request $requests){
        $messages = Message::whereRaw(
                        '((reciever = '.$requests->contact_id.' and user_id = '
                        .\Auth::user()->id.') or (user_id = '
                        .$requests->contact_id.' and reciever='
                        .\Auth::user()->id.'))')
                ->where('id','<',$requests->first_id)
                ->limit(10)
                ->orderBy('created_at','desc')->get();

        return ['messages'=>$messages];
    }

    public function json_save_sent_message(Request $requests){
        $message = Message::create(
            [
                'user_id'=>\Auth::user()->id,
                'reciever'=>$requests->reciever,
                'message'=>$requests->message
            ]
        );

        return ['message'=>'message saved','data'=>$message];
    }

    public function json_mark_message_seen(Request $requests){
        Message::where('reciever',\Auth::user()->id)->where('user_id',$requests->reciever)->update(['seen'=>1]);

        return 'message seen';
    }

    public function json_search_contact(Request $requests){
        // 
        $contacts = \Auth::user()->contacts()->lists('contact_id');
        $requested = \Auth::user()->contactRequests()->lists('contact_id');
        $recieved_request = \Auth::user()->receivedContactRequests()->lists('user_id');

        $others_users = User::searchKey($requests->keyword)->whereNotIn('id',$requested)->whereNotIn('id',$recieved_request)->whereNotIn('id',$contacts)->limit(5);
        $requested = User::searchKey($requests->keyword)->whereIn('id',$requested);
        $recieved_request = User::searchKey($requests->keyword)->whereIn('id',$recieved_request);

        return ['contacts'=>\Auth::user()->contacts()->searchKey($requests->keyword)->get()->load('contact')->load('latestMessage') ,'others'=>$others_users->get(), 'requested'=>$requested->get(), 'recieved_request'=>$recieved_request->get() ];
    }

    public function json_request_contact(Request $requests){
        \Auth::user()->requestMessage($requests);

        return  'contact requested';
    }

    public function json_accept_contact(Request $requests){
        Contact::where('contact_id',\Auth::user()->id)->where('user_id',$requests->contact_id)->update(['status'=>'approved']);

        Contact::create(
            [
                    'user_id'=>\Auth::user()->id,
                    'contact_id'=>$requests->contact_id,
                    'status'=>'approved'
            ]
        );

        return 'contact accepted';
    }
}