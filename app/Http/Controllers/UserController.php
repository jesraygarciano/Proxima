<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Opening;
use App\Libs\Common;
use App\User;
use App\Scout;
use App\Company;
use App\Application;
use Carbon\Carbon;

// use Common;


class UserController extends Controller
{
    public function index(Request $requests){
        // 
        return view('user.index');
    }

    public function notifications(Request $requests){
    	return view('user.notifications');
    }

    public function json_get_scout_notification(Request $requests){
    	return User::find($requests->user_id)->scouts()->orderBy('scouts.created_at','desc')->get()->load('company');
    }

    public function json_get_application_notification(Request $requests){
    	return Company::find($requests->company_id)->applications->load('user');
    }

    public function json_get_opening_notification(Request $requests){
    	$notifications = User::find($requests->user_id)->openingNotifications();
    	$openings = Opening::whereIn('id',$notifications->lists('opening_id'))->get()->load('company')->load('skill_requirements');
    	return $openings;
    }
}