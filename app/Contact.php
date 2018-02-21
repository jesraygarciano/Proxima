<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = ['user_id', 'contact_id', 'status'];

	public function user()
	{
	  return $this->belongsTo(User::class);
	}

	public function contact(){
		return $this->belongsTo(User::class,'contact_id');
	}
}
