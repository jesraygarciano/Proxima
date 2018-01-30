<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scout extends Model
{
    
    protected $fillable = ['description', 'is_active', 'company_id','user_id','created_at', 'updated_at'];

    //related to application
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    //related to application
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
