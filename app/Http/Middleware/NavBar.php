<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Resume;
use App\Libs\Common;

class NavBar
{

    public function handle($request, Closure $next)
    {

        if(Auth::guest()){

        } elseif (Auth::user()->role == 0) {

            $lists = Common::get_master_resume();
            $bookmark_opening_count = Auth::user()->bookmarkings()->get()->count();
            // dd($lists);
            // dd(count($lists));
            \Session::flash('lists', $lists );
            \Session::flash('bookmark_opening_count', $bookmark_opening_count );

        } elseif(Auth::user()->role == 1){

            $save_applicants_count = Auth::user()->saved_applicants()->get()->count();
            \Session::flash('save_applicants_count', $save_applicants_count );

        } elseif(Auth::user()->role == 2){

        }
        
        return $next($request);
    }
}
