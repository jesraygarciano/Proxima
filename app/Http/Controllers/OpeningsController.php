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
use Mapper;
use Carbon\Carbon;

// use Common;


class OpeningsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'searched_index_general','search_opening_with_language', 'searched_index_advance', 'show']]);
        $this->middleware('onlyhiring', ['except' => ['index', 'edit_opening_bookmark', 'search_opening_with_language', 'searched_index_general', 'searched_index_advance', 'show', 'bookmark_openings_index','bookmark_lists', 'unbookmark_openings_index']]);
        $this->middleware('navbar');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function searched_index_general(Request $request)
    {
        return view('openings.index', compact('openings'));
    }


    // uelmar's
    public function edit_opening_bookmark(Request $request){

        if(Auth::user()->is_bookmarking($request->opening_id)){
            Auth::user()->unbookmark($request->opening_id);
            return ['result'=>'unbookmarked','bookmarks'=>Opening::find($request->opening_id)->bookmark_count()];
        }
        else{
            Auth::user()->bookmark($request->opening_id);
            return ['result'=>'bookmarked','bookmarks'=>Opening::find($request->opening_id)->bookmark_count()];
        }
    }
    public function index(Request $request)
    {

        // revise

        $openings = Opening::query()->where('is_active', 1)->orderBy('created_at','desc');
        $provinces = \DB::table('provinces')->get();

        /*$language_lang = strtoupper($request->language);
        
        if($language_lang){
            $openings = collect();
            $openings_skills = \App\Opening_skill::where('language',$request->language)->get();

            foreach ($openings_skills as $skill) {
                $openings = $openings->merge($skill->openings);
            }
        return view('openings.index',compact('provinces','openings'));
        }*/


        // $curr_date = date('Y-m-d H:i:s');
        // dd($curr_date);
        // if ($openings->from_post, '>=', date(' M. j, Y h:i:s A')) {
        //     # code...
        // }

        // $post_active = Opening::where('from_post', '>=', $curr_date);

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

        // $openings = $openings->paginate(6);->where('is_active', 1)

        $openings = $openings->where('is_active', 1)
        // ->where('until_post', '>', date('Y-m-d\TH:i'))
        ->where(function($query)
                    {
                        $query->where('from_post', '<', date('Y-m-d\TH:i'))
                              ->where('until_post', '>', date('Y-m-d\TH:i'));
                    })
        ->paginate(6);

        // $openings = $openings->where(function($query)
        //     {
        //         $query->where('from_post', '<', date('Y-m-d\TH:i'))
        //               ->where('until_post', '>', date('Y-m-d\TH:i'));
        //     })
        // ->paginate(6);
        // dd($openings);

        // $expiredate = $openings->where('is_active', 1)->where( 'created_at', '>', Carbon::now()->addDays(30))->get();

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
    public function create(Request $request)
    {
        $company_id = $request->company_id;
        $opening = $request->opening_id ? Opening::find($request->opening_id) : false;
        $provinces = \DB::table('provinces')->get();
        $countries = \DB::table('countries')->get();

        $country_array = Common::return_country_array();
        return view('openings.create', compact('countries','company_id','opening','post_active','provinces'));
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
            // 'picture' => 'required',
            'skills' => 'required',
            'salary_range' => 'required',
            'details' => 'required',
            'requirements' => 'required',
        ]);

        // Handle file upload
        // if($request->hasFile('picture')){
        //     //  Get filename with the extension
        //     $filenameWithExt = $request->file('picture')->getClientOriginalName();
        //     //  Get just filename
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     // Get just text
        //     $extension = $request->file('picture')->getClientOriginalExtension();
        //     // Filename to store
        //     $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //     // Upload Image
        //     $path = $request->file('picture')->move(public_path(). '/storage' , $fileNameToStore);
        // }

        /*foreach ($openings_skills as $skill) {
            $openings = $openings->merge($skill->openings);
        }*/

        // Create Opening
        $opening = $request->opening_id ? Opening::find($request->opening_id) : new Opening;

        if($request->picture){
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->picture));
            $fileNameToStore = time().'.png';
            file_put_contents(public_path('/storage/').$fileNameToStore, $data);
            $opening->picture = $fileNameToStore;
        }

        $opening->title = $request->title;
        $opening->from_post = $request->from_post;
        $opening->until_post = Carbon::parse($request->from_post)->AddDays(30);

        // $expiredate = date(strtotime($request->from_post. "+30 days"))
        // $opening->until_post = $request->from_post;

        if(!$request->opening_id)
        {
            $opening->company_id = $request->company_id;
        }

        $opening->salary_range = $request->salary_range;
        $opening->requirements = $request->requirements;
        $opening->details = $request->details;
        $opening->save();
        $opening->register_skill($request->skills);

        if(!$request->opening_id)
        {
            $opening->notifySubscribedApplicants();
        }

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

        /*Mapper::location($opening->$company->address1. " ". $opening->$company->city. " ". $opening->$company->country)->map(['zoom' => 18, 'markers' => ['title' => 'My Location', 'animation' => 'DROP'], 'clusters' => ['size' => 10, 'center' => true, 'zoom' => 30]]);*/
        
        return view('openings.show', compact('opening','company', 'resume', 'more_openings'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $company_id = $request->company_id;
        $opening = $request->opening_id ? Opening::find($request->opening_id) : false;
        $provinces = \DB::table('provinces')->get();
        $countries = \DB::table('countries')->get();

        $country_array = Common::return_country_array();
        return view('openings.edit', compact('country_array','company_id','opening','post_active','provinces','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        {

        if (!$request->has('skills')) {
            $request->skills = "";
        }

        $this->validate($request, [
            'title' => 'required',
            // 'picture' => 'required',
            'skills' => 'required',
            'salary_range' => 'required',
            'details' => 'required',
            'requirements' => 'required',
        ]);

        // Handle file upload
        // if($request->hasFile('picture')){
        //     //  Get filename with the extension
        //     $filenameWithExt = $request->file('picture')->getClientOriginalName();
        //     //  Get just filename
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     // Get just text
        //     $extension = $request->file('picture')->getClientOriginalExtension();
        //     // Filename to store
        //     $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //     // Upload Image
        //     $path = $request->file('picture')->move(public_path(). '/storage' , $fileNameToStore);
        // }

        /*foreach ($openings_skills as $skill) {
            $openings = $openings->merge($skill->openings);
        }*/

        // Create Opening
        $opening = $request->opening_id ? Opening::find($request->opening_id) : new Opening;

        if($request->picture){
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->picture));
            $fileNameToStore = time().'.png';
            file_put_contents(public_path('/storage/').$fileNameToStore, $data);
            $opening->picture = $fileNameToStore;
        }

        $opening->title = $request->title;
        $opening->from_post = $request->from_post;
        $opening->until_post = Carbon::parse($request->from_post)->AddDays(30);

        // $expiredate = date(strtotime($request->from_post. "+30 days"))
        // $opening->until_post = $request->from_post;

        if(!$request->opening_id)
        {
            $opening->company_id = $request->company_id;
        }

        $opening->salary_range = $request->salary_range;
        $opening->requirements = $request->requirements;
        $opening->details = $request->details;
        $opening->save();
        $opening->register_skill($request->skills);

        // $openings_skills = \App\Opening_skill::where('language',$request->language)->get();

        return redirect('hiring_portal');
        // return redirect()->action('HiringPortalController@show', [$request->input('company_id')]);
        }

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