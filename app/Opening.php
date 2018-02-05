<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opening extends Model
{
    protected $fillable = ['title', 'company_id', 'address', 'picture', 'icon', 'details', 'requirements', 'term', 'other', 'created_at', 'updated_at'];

    // protected $hidden = ['password'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    //related to application
    public function users()
    {
        return $this->belongsToMany(User::class, 'applications', 'opening_id', 'user_id');
    }

    public function users_that_bookmarked()
    {
        return $this->belongsToMany(User::class, 'save_openings', 'opening_id', 'user_id');
    }    

    public function bookmark_count()
    {
        return $this->users_that_bookmarked()->count();
    }        

    //$opening_skill_ids should be array
    public function register_skill($opening_skill_ids)
    {
        $existing_skills = $this->skill_requirements()->lists('opening_skills.id')->toArray();

        foreach ($opening_skill_ids as $opening_skill_id) {
            if(!in_array($opening_skill_id, $existing_skills))
            {
                $this->has_skill()->attach($opening_skill_id);
            }
        }
        return true;
    }

    public function has_skill()
    {
        return $this->belongsToMany('App\Opening_skill', 'joining_opening_skills', 'opening_id', 'opening_skill_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'application_id');
    }

    public function skill_requirements()
    {
        return $this->belongsToMany(Opening_skill::class, 'joining_opening_skills', 'opening_id', 'opening_skill_id');
    }

    public function getPictureAttribute(){
        if(!file_exists('storage/'.$this->attributes['picture']) || str_replace(' ','',$this->attributes['picture']) == ''){
            return asset('img/default-opening.jpg');
        }
        return asset('storage/'.$this->attributes['picture']);
    }

}
