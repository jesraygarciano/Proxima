<?php

namespace App\Http\Controllers;

use App\Resume;
use App\Resume_skill;
use App\User;
use App\Experience;
use App\Education;
use App\Libs\Common;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ResumesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('onlyapplicant', ['except' => ['index', 'show']]);
        $this->middleware('navbar');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = \Auth::user();
        $skills = Resume_skill::all();

        return view('resumes.create', compact('user', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->skills);
        $this->validate($request, [
            // 'f_name' => 'required',
            // 'm_name' => 'required',
            // 'l_name' => 'required',
            // 'email' => 'required',
        ]);


        if($request->photo){
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->photo));
            $fileNameToStore = time().'.png';
            file_put_contents(public_path('/storage/').$fileNameToStore, $data);
        }


        // // Handle file upload
        // if($request->hasFile('photo')){
        //     //  Get filename with the extension
        //     $filenameWithExt = $request->file('photo')->getClientOriginalName();
        //     //  Get just filename
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     // Get just text
        //     $extension = $request->file('photo')->getClientOriginalExtension();
        //     // Filename to store
        //     $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //     // Upload Image
        //     $path = $request->file('photo')->move(public_path(). '/storage' , $fileNameToStore);
        // }

        // dd($request);
        $input = $request->except('photo','skills', '_token');
        // dd($input);
        // Resume::create($input);
        $resume = Resume::where('user_id',\Auth::user()->id)->first() ?? new Resume;
        // dd($resume);

        $resume->photo = $fileNameToStore;

        $resume->fill($input)->save();

        if (\Input::has('ex_company')){
            $experience = new Experience;
            $experience->resume_id = $resume->id;
            $experience->fill($input)->save();
        }

        $education = new Education;
        $education->resume_id = $resume->id;
        $education->fill($input)->save();
        // $resume->email = $request->input('email');
        // $resume->user_id = \Auth::id();
        // $resume->civil_status = $request->input('civil_status');
        // $resume->is_active = 1;
        // $resume->is_master = 1;
        // $resume->save();
        // $saved_resume_id = Resume::where('user_id', \Auth::id())->where('is_active', 1)->where('is_master', 1)->get()->first()->id;
        // $resume = Resume::findOrFail($saved_resume_id);
        if ($request->has('skills')) {
            $resume_skill_ids = $request->input('skills');
            foreach($resume_skill_ids as $resume_skill_id) {
                $resume->has_skill()->attach($resume_skill_id);
            }
        }

        return redirect('resumes/show')->with('success', 'Registerd you resume');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $user = \Auth::user();
        $resume = Resume::where('user_id', \Auth::id())->where('is_active', 1)->where('is_master', 1)->get()->first();
        $skill_ids = array();
        // if ($resume->has_skill() != null) {
        $skill_ids = Common::resume_skill_ids_get($resume);
        // }

        // $skills = $resume->has_skill()->get();
        // $skills = $resume->has_skill()->get()->where('language', 'PHP')->get();

        $age = Common::cal_age($resume->birth_date);
        $birth_date = Common::month_converted_date($resume->birth_date);

        return view('resumes/show', compact('resume', 'user', 'skill_ids', 'skills', 'age', 'birth_date'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function edit($resume_id)
    public function edit()
    {
/*        $resume = Resume::findOrFail($resume_id);
        $languages_ids = $resume->has_skill()->get()->lists('id')->toArray();
        return view('resumes.edit', compact('resume', 'languages_ids'));
*/
        $user = \Auth::user();
        $skills = Resume_skill::all();
        $resume = Common::get_master_resume();
        $educations = $resume->educations();

        if($resume){
            // $resume = Resume::where('user_id', $user->id)->where('is_active', 1)->where('is_master', 1)->get()->first();
            $languages_ids = $resume->has_skill()->get()->lists('id')->toArray();
        }else{
            $resume = new Resume;
            $languages_ids = array();
        }

        return view('resumes.edit', compact('user', 'skills', 'resume', 'languages_ids', 'educations'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $resume_id)
    {

        $this->validate($request, [
            'f_name' => 'required',
            'm_name' => 'required',
            'l_name' => 'required',
            'email' => 'required',
        ]);

        $input = $request->except('photo', 'skills', '_token');
        $resume = Resume::findOrFail($resume_id);

        $resume->photo = $fileNameToStore;

        $resume->fill($input)->save();

        $resume->has_skill()->detach();
        $resume_skill_ids = $request->input('skills');
        foreach($resume_skill_ids as $resume_skill_id){
            $resume->has_skill()->attach($resume_skill_id);
        }

        return redirect('resumes/show')->with('success', 'Updated your resume');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
