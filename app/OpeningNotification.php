<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpeningNotification extends Model
{
    public function user(){
    	return $this->belongsTo('\App\User');
    }

    public function opening(){
    	return $this->belongsTo('\App\Opening');
    }

    public function company(){
    	return $this->belongsTo('\App\Company');
    }
}