<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = ['f_name', 'm_name', 'l_name', 'email', 'objective', 'nationality', 'birth_date', 'marital_status', 'spoken_language', 'experience', 'university', 'graduate_flag', 'program_of_study', 'field_of_study', 'gender', 'postal', 'address1', 'address2', 'city', 'country', 'phone_number', 'photo', 'is_master', 'is_active', 'user_id','spoken_language', 'religion', 'summary', 'other_skills', 'websites', 'seminars_attended', 'awards'];

    //$resume_skill_ids should be array
    // public function register_skill($resume_skill_ids)
    // {
    //     foreach ($resume_skill_ids as $resume_skill_id) {
    //         $this->has_skill()->attach($resume_skill_id);
    //     }
    //     return true;
    // }

    public function has_skill()
    {
        return $this->belongsToMany('App\Resume_skill', 'joining_resume_skills', 'resume_id', 'resume_skill_id');
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
}
