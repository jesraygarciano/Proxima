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
use App\TrainingBatch;
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
        $batch = TrainingBatch::all();

        return view('intership-training-programming.applicant.create', compact('batch'));

// >>>>>>> u_0227_newbranch
    }

    public function save_application(Request $requests){


        // dd($requests->batch);
        if (!$requests->has('skills')) {
            $requests->skills = "";
        }

        $this->validate($requests,[
            'skills' => 'required',
            'objective' => 'required',
            'school' => 'required',
            'course' => 'required',
            // 'preffered_training_date' => 'required',
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

        $application = InternshipApplication::create([
            'user_id'=>\Auth::user()->id,
            'objectives'=>$requests->objective,
            'school'=>$requests->school,
            'course'=>$requests->course,
            'batches'=>$requests->batch
            // 'preffered_training_date'=>$requests->preffered_training_date

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

    public function profile(){

// <<<<<<< HEAD
    //     return view('intership-training-programming.applicant.profile');
    // }

// =======
        // $student = Opening::where('is_active', 1)->orderBy('created_at','desc');            
        $student = \Auth::user()->intershipApplication()->get();
        // dd($student);
        // $skill_ids = array();
        // $skill_ids = Common::app_skill_ids_get();

        return view('intership-training-programming.applicant.profile',compact('student','skill_ids'));

    }

    public function edit(Request $request){

        $batch = TrainingBatch::all();
        $student_id = $request->student_id;

        $student = $request->student_id ? InternshipApplication::find($request->student_id) : false;

        // dd($student);
        // $student = \Auth::user()->intershipApplication()->get();

        return view('intership-training-programming.applicant.edit',compact('student','batch'));

    }

    public function update_application(Request $requests){

        if (!$requests->has('skills')) {
            $requests->skills = "";
        }

        // dd($requests->student_id);

        $this->validate($requests,[
            'skills' => 'required',
            'objective' => 'required',
            'school' => 'required',
            'course' => 'required',
            // 'preffered_training_date' => 'required',
        ]);

        // $application = InternshipApplication::update([
        // $application = InternshipApplication::whereId($requests)->update([        
        $requests->user()->intershipApplication()->update([
            'user_id'=>\Auth::user()->id,
            'objectives'=>$requests->objective,
            'school'=>$requests->school,
            'course'=>$requests->course
            // 'preffered_training_date'=>$requests->preffered_training_date
        ]);

        // dd($application);

        // foreach ($requests->skills as $skill) {
        //     $application->skills()->attach($skill);
        // }
        return redirect()->route('applicant_profile');

    }


// =======
// >>>>>>> j_0228_new_branch
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


    // management code
    public function manage_batch_index(){
        return view('intership-training-programming.management.index');
    }

    public function getBatchCreate($id = null){
        $batch = TrainingBatch::find($id);
        return view('intership-training-programming.management.create-batch', compact('batch'));
    }

    public function postBatchCreate(Request $requests){
        $this->validate($requests
            ,[
                'name'=>'required',
                'start_date'=>'required',
                'regitration_deadline'=>'required',
                'schedule'=>'required',
            ]
        );

        if(!$requests->batch_id)
        {
            $batch = TrainingBatch::create([
                'author_id'=>\Auth::user()->id,
                'name'=>$requests->name,
                'start_date'=>$requests->start_date,
                'regitration_deadline'=>$requests->regitration_deadline,
                'description'=>$requests->description,
                'schedule'=>$requests->schedule
            ]);
        }
        else
        {
            $batch = TrainingBatch::where('id',$requests->batch_id)->update([
                'author_id'=>\Auth::user()->id,
                'name'=>$requests->name,
                'start_date'=>$requests->start_date,
                'regitration_deadline'=>$requests->regitration_deadline,
                'description'=>$requests->description,
                'schedule'=>$requests->schedule
            ]);
        }

        return redirect()->route('itp_management_index');
    }

    public function json_get_batches_datatable(Request $requests){
        return Datatables::of(TrainingBatch::query())->make(true);
    }

    public function json_get_applicants_datatable(Request $requests){
        $internships = InternshipApplication::query();
        $internships = $requests->training_batch_id ? $internships->where('training_batch_id',$requests->training_batch_id) : $internships;

        return Datatables::of($internships
        ->leftJoin('users','users.id','=','internship_applications.user_id')
        ->leftJoin('training_batches','training_batches.id','=','internship_applications.training_batch_id')
        ->select(['internship_applications.id','users.photo',\DB::raw('training_batches.name as training_batch_name'),\DB::raw('concat(users.f_name," ",users.l_name) as applicant_name'),'school','preffered_training_date','course','internship_applications.created_at',"internship_applications.objectives","school","course"])
        )
        ->filterColumn('applicant_name', 'whereRaw', "CONCAT(users.f_name,' ',users.l_name) like ? ", ["$1"])
        ->filterColumn('training_batch_name', 'whereRaw', "training_batches.name like ? ", ["$1"])
        ->editColumn('photo', function($data) {
            if(!file_exists('storage/'.$data->photo) || str_replace(' ','',$data->photo) == ''){
                return asset('img/member-placeholder.png');
            }

            return asset('storage/'.$data->photo);
        })
        ->make(true);
    }

    public function json_delete_batch(Request $requests){
        TrainingBatch::find($requests->batch_id)->delete();

        return 'deleted';
    }
}
