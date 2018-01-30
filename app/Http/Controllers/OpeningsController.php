<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Opening;
use App\Company;
use App\Resume;
use App\Libs\Common;
use Auth;
use App\User;

// use Common;


class OpeningsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'searched_index_general','search_opening_with_language', 'searched_index_advance', 'show']]);
        $this->middleware('onlyhiring', ['except' => ['index', 'search_opening_with_language', 'searched_index_general', 'searched_index_advance', 'show', 'bookmark_openings_index','bookmark_lists', 'unbookmark_openings_index']]);
        $this->middleware('navbar');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//     public function index()
//     {
//         // dd(Auth::user());
//         // $openings = Opening::latest('created_at')->where('is_active', 1)->get();
// /*
//         $companies = Company::find(1);
//         // $companies = Company::where('id', $openings->company_id)->get();
//
//         $openings = Opening::latest('created_at')->where('company_id', $companies->id)->where('is_active', 1)->paginate(6);
//         // dd($openings);
// */
//         $openings = Opening::latest('created_at')->where('is_active', 1)->paginate(6);
//
//         return view('openings.index', compact('openings'));
//         // return view('openings.index', compact('openings','companies'));
//     }

    public function searched_index_general(Request $request)
    {
        return view('openings.index', compact('openings'));

    }

    public function search_opening_with_language(Request $request){
        $openings = collect();
        $language = ucfirst($request->language);
        $openings_skills = \App\Opening_skill::where('language',$request->language)->get();

        foreach ($openings_skills as $skill) {
            $openings = $openings->merge($skill->openings);
        }

        return view('openings.language-search',compact('openings','language'));
    }

    public function index(Request $request)
    {

        // revise
        $openings_lang = collect();
        $language_opeindex = ucfirst($request->languagesearch);
        // dd($language_opeindex);
        $openings_skills = \App\Opening_skill::where('language',$request->language)->get();

        foreach ($openings_skills as $skill) {
            $openings_lang = $openings_lang->merge($skill->openings);
        }

        $openings = Opening::query()->where('is_active', 1)->orderBy('created_at','desc');
        $provinces = \DB::table('provinces')->get();

/*        $skill_ids = array();
        $skill_ids = Common::resume_skill_ids_get($resume);
*/        

        if($request->languages && strlen($request->languages[0]) > 0)
        {
            $resume_skills = \App\Opening_skill::whereIn('language',$request->languages)->lists('id');

            $pivot_opening_skills = \DB::table('joining_opening_skills')->whereIn('opening_skill_id',$resume_skills)->lists('opening_id');

            $openings->whereIn('id',$pivot_opening_skills);
        }

        if($request->languages && strlen($request->languages[0]) > 0)
        {
            $resume_skills = \App\Opening_skill::whereIn('language',$request->languages)->lists('id');

            $pivot_opening_skills = \DB::table('joining_opening_skills')->whereIn('opening_skill_id',$resume_skills)->lists('opening_id');

            $openings->whereIn('id',$pivot_opening_skills);
        }

        if($request->opening_search){
            $company_search_ids = Company::where('company_name','like','%'.$request->opening_search.'%')->lists('id');
            $openings->where('title','like','%'.$request->opening_search.'%')->orWhereIn('company_id',$company_search_ids);
        }

        if($request->company_name){
            $company_search_ids = Company::where('company_name','like','%'.$request->company_name.'%')->lists('id');
            $openings->whereIn('company_id',$company_search_ids);
        }

        if($request->province){
            $provinces_search = \DB::table('provinces')->whereRaw('name like "%'.$request->province.'%" or iso_code like "%'.$request->province.'%"')->lists('iso_code');
            $openings->whereIn('province_code',$provinces_search);
        }

        if($request->hiring_type){
            $openings->where('hiring_type',$request->hiring_type);
        }

        if($request->salary_range){
            $openings->where('salary_range',$request->salary_range);
        }

        $openings = $openings->paginate(6);

        return view('openings.index',compact('provinces','openings'));
    }

    public function bookmark_openings_index($opening_id)
    {

        Auth::user()->bookmark($opening_id);
        return redirect()->back();

    }

    public function unbookmark_openings_index($opening_id)
    {

        Auth::user()->unbookmark($opening_id);

        return redirect()->back();

    }

    public function bookmark_lists(){

        $bookmarks = Auth::user()->bookmarkings;
        return view('openings.bookmarked_list')->with('bookmarks', $bookmarks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id)
    {
        $country_array = Common::return_country_array();
        return view('openings.create', compact('country_array','company_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('skills')) {
            $request->skills = "";
        }

        $this->validate($request, [
            'title' => 'required',
            'requirements' => 'required',
            // 'picture' => 'required',
            'skills' => 'required',

        ]);

        // Handle file upload
        if($request->hasFile('picture')){
            //  Get filename with the extension
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            //  Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just text
            $extension = $request->file('picture')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('picture')->move(public_path(). '/storage' , $fileNameToStore);
        }

/*        foreach ($openings_skills as $skill) {
            $openings = $openings->merge($skill->openings);
        }*/

        // Create Opening
        $opening = new Opening;
        $opening->title = $request->input('title');
        $opening->company_id = $request->input('company_id');
        $opening->requirements = $request->input('requirements');
        if($request->hasFile('picture')){
            $opening->picture = $fileNameToStore;
        }
        $opening->save();
        $opening->register_skill($request->input('skills'));

        // $openings_skills = \App\Opening_skill::where('language',$request->language)->get();

        return redirect('hiring_portal');
        // return redirect()->action('HiringPortalController@show', [$request->input('company_id')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {

        $opening = Opening::findOrFail($id);

        $company = Company::where('id', $opening->company_id)->get()->first();

        $more_openings = Opening::where('id', '!=', $opening->id)->where('company_id', $company->id)->get();
        // $more_openings = Opening::where('id', '!=', $opening->id)->where('company_id', $company->id)->get();
        
        // dd($more_openings);
        $resume = array();
        if(Auth::check()){
            $resume = Resume::where('user_id', Auth::user()->id)->where('is_master', 1)->where('is_active', 1)->get()->first();
        }
        // dd($resume);

        return view('openings.show', compact('opening','company', 'resume', 'more_openings'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
