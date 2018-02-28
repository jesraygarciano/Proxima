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
use yajra\Datatables\Datatables;

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

        // dd($application);

        foreach ($requests->skills as $skill) {
            $application->skills()->attach($skill);
        }

        return redirect()->route('applicant_profile');

    }

    public function applicant_index(){
        return view('intership-training-programming.applicant.index');
    }

// <<<<<<< HEAD
    public function profile(){

        // $student = Opening::where('is_active', 1)->orderBy('created_at','desc');            
        $student = \Auth::user()->intershipApplication()->get();
        // dd($student);
        // $skill_ids = array();
        // $skill_ids = Common::app_skill_ids_get();


        return view('intership-training-programming.applicant.profile',compact('student','skill_ids'));

    }


// =======
    public function json_get_application_datatable(Request $requests){
        $ids = \Auth::user()->intershipApplication()->lists('internship_applications.id');

        // return Datatables::of($companies)->make(true);
        return Datatables::of(InternshipApplication::query()->leftJoin('users','users.id','=','internship_applications.user_id')
            ->select(['internship_applications.id',\DB::raw('concat(users.f_name," ",users.l_name) as applicant_name'),'school','preffered_training_date','course'])->whereIn('internship_applications.id',$ids))
        // ->filterColumn('applicant_name', function($query, $keyword) {
        //         $sql = "CONCAT(users.l_name,'-',users.l_name)  like ?";
        //         $query->whereRaw($sql, ["%{$keyword}%"]);
        //     })
        ->make(true);
    }
// >>>>>>> u_0227_newbranch_2

}
