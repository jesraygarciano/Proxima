<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Application extends Model
{

    // dd('通りました');
    protected $fillable = ['description', 'is_active', 'user_id','opening_id','resume_id','created_at', 'updated_at', 'from_available_time', 'to_available_time', 'expected_salary', 'salary_from', 'salary_to'];

    // dd('通りました');

    // protected $hidden = ['password'];


    //related to application
    public function users()
    {
    	return $this->belongsTo(User::class);
    }

    //related to application
    public function opening()
    {
        return $this->belongsTo(Opening::class);
    }

    public function resume()
    {
        // return $this->hasOne(Application::class, 'resume_id');
        return $this->belongsTo(Resume::class);
    }

    //for using "DB::table", changed to static method
    public static function applied_application_openings($user_id)
    {
        $applied_application_openings = DB::table('applications as a')
            ->select('a.id', 'a.created_at', 'o.title', 'o.id as opening_id', 'o.details', 'o.address1')
            ->join('openings as o', 'a.opening_id', '=', 'o.id')
            ->where('a.user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return $applied_application_openings;
    }
}
