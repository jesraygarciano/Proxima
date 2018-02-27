<?php

namespace App\Http\Controllers;
use App\Libs\Common;
use App\Company;
use App\Application;
use App\Opening;
use App\User;
use App\Resume;
use App\InternshipApplicationSkills;
use App\InternshipApplication;
use Auth;
use Mapper;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InternshipApplicationController extends Controller
{

    public function landing_page(){

        // Mapper::map(10.318686,123.90317049999999);
        Mapper::map(10.318686,123.90317049999999,['zoom' => 19, 'markers' => ['title' => 'My Location', 'animation' => 'DROP'], 'clusters' => ['size' => 10, 'center' => true, 'zoom' => 30]]);

        return view('itp.landing_page');
    }

    public function create(){
// <<<<<<< HEAD
        // return view('itp.create');
// =======
        return view('intership-training-programming.applicant.create');
// >>>>>>> u_0227_newbranch
    }

    public function save_application(Request $requests){

        if (!$requests->has('skills')) {
            $requests->skills = "";
        }

        $this->validate($requests,[
            'skills' => 'required',
            'objective' => 'required',
            'school' => 'required',
            'course' => 'required',
            'preffered_training_date' => 'required',
            'course' => 'required',
        ]);

// <<<<<<< HEAD
//         $application = InternshipApplication::create(
//             [
//                 'user_id'=>\Auth::user()-id
//             ]
//         );

//         $table->integer('user_id');
//             $table->text('objectives');
//             $table->string('school');
//             $table->string('course');
//             $table->date('preffered_training_date');
// =======
        $application = InternshipApplication::create([
            'user_id'=>\Auth::user()->id,
            'objectives'=>$requests->objective,
            'school'=>$requests->school,
            'course'=>$requests->course,
            'preffered_training_date'=>$requests->preffered_training_date
        ]);

        foreach ($requests->skills as $skill) {
            $application->skills()->attach($skill);
        }

        return $application->load('skills');

    }

    public function profile(){

        return view('intership-training-programming.applicant.profile');
    }    

}
