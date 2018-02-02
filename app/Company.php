<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    // dd('通りました');
    protected $fillable = ['company_name', 'email', 'password', 'in_charge', 'ceo_name', 'postal', 'address1', 'address2', 'city', 'country', 'url', 'tel', 'number_of_employee', 'established_at', 'facebook_url', 'twitter_url', 'company_logo', 'background_photo', 'company_introduction', 'what', 'what_photo1', 'what_photo1_explanation', 'what_photo2', 'what_photo2_explanation', 'bill_company_name', 'bill_postal', 'bill_address1', 'bill_address2', 'bill_city', 'bill_country', 'user_id', 'created_at', 'updated_at', 'is_active', 'company_size'];

    // dd('通りました');

    // protected $hidden = ['password'];

    public function openings()
    {
        return $this->hasMany(Opening::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //related to scout
    public function scout_users()
    {
        return $this->belongsToMany(User::class, 'scouts', 'company_id', 'user_id');
    }

    public function scout_users_save($user_id)
    {
        return $this->scout_users()->attach($user_id);
    }

    /*public function company_google_mapper()
    {
        return $this->attributes['address1']. " ". $this->attributes['city']. " ". $this->attributes['country'];
    }*/

    public function getCompanyLogoAttribute(){
        if(!file_exists('storage/'.$this->attributes['company_logo']) || str_replace(' ','',$this->attributes['company_logo']) == ''){
            return asset('img/default-company.png');
        }

        return asset('storage/'.$this->attributes['company_logo']);
    }

    public function getCompanyCoverAttribute(){
        if(!file_exists('storage/'.$this->attributes['background_photo']) || str_replace(' ','',$this->attributes['background_photo']) == ''){
            return asset('img/default-opening.jpg');
        }

        return asset('storage/'.$this->attributes['background_photo']);
    }
}
