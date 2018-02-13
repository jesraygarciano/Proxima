<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libs\Common;
use App\Company;
use App\Opening;
use Auth;
use Mapper;

class CompaniesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('onlyhiring', ['except' => ['edit_company_follow', 'index', 'show','follow_companies_index','unfollow_companies_index','follow_company_lists']]);
        $this->middleware('navbar');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $searchData = $request->company_name;
        $w_hiring_info = $request->w_hiring_info;
        $openings = Opening::query()->where('is_active', 1)->orderBy('created_at','desc');

        if(!empty($searchData)){
            if(!empty($w_hiring_info)){

                // Displays lists of companies have current hiring information
                /*if(count($openings) > 0){
                }*/
                    /*foreach($w_hiring_info as $w_hiring_infos) {
                        $w_hiring_infos->attach($w_hiring_infos);
                    }*/
                // $wordCount = count($openings->title);
                // dd($openings);
                $companies = Company::where('company_name', 'LIKE', '%'. $searchData . '%')->paginate(10);
            }
            else{
                $companies = Company::where('company_name', 'LIKE', '%'. $searchData . '%')->paginate(10);
            }
        }else{
            $companies = Company::latest('created_at')->where('is_active', "1")->paginate(10);
        }

        return view('companies.index', compact('companies'));
        // return view('companies.index', compact('companies','opening_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) {  //
        $rules = [    // ②
            'company_name' => 'required',
            'email' => 'required|unique:companies',
            // 'url' => 'required',
            'company_logo' => 'required',
            // 'background_photo' => 'required',
            'tel' => 'required',
        ];
        // $request->user_id = Auth::user()->id;

        if($request->company_logo){
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->company_logo));
            $fileNameToStore = time().'.png';
            file_put_contents(public_path('/storage/').$fileNameToStore, $data);
        }

        $this->validate($request, $rules);  // ③

        // Company::create($request->all());
        $request->user()->companies()->create([
            'company_name' => $request->company_name,
            'email' => $request->email,
            'is_active' => '1',
            // 'url' => $request->url,
            'company_logo' => $fileNameToStore,
            // 'background_photo' => $fileNameToStoreCover,
            'tel' => $request->tel,
        ]);

        \Session::flash('flash_message', 'created company information');

        // return redirect('companies');
        return redirect('/hiring_portal');
    }


// FOLLOW COMPANIES METHOD
    public function follow_companies_index($company_id)
    {

        Auth::user()->follow($company_id);
        return redirect()->back();

    }

    // uelmar's
    public function edit_company_follow(Request $request){

        if(Auth::user()->is_following($request->company_id)){
            Auth::user()->unfollow($request->company_id);
            return 'unfollowed';
        }
        else
        {
            Auth::user()->follow($request->company_id);
            return 'followed';
        }

    }

    public function unfollow_companies_index($company_id)
    {

        Auth::user()->unfollow($company_id);

        return redirect()->back();

    }

    public function follow_company_lists(){

        $follows = Auth::user()->followings;
        return view('companies.followed_list')->with('follows', $follows);

    }

    // FOLLOW COMPANIES METHOD
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $company = Company::findOrFail($id);

        $openings = Opening::where('company_id', $company->id)->get();

        //getting ids of companies that auth user created.
        $companies_ids = Common::company_ids_that_user_have();

        /*Mapper::map(53.381128999999990000, -1.470085000000040000, ['zoom' => 10, 'markers' => ['title' => 'My Location', 'animation' => 'DROP']]);*/

        /*$company_location = Company::select('id', \DB::raw('CONCAT(address1, " ", city, " ", country) AS company_google_map'))
            ->orderBy('address1')
            ->lists('company_google_map', 'id');*/
        // dd($company_location);

        if (!empty($company->address1)){
        // Mapper::location($company->city, $company->country); //company_location
        //$company->address1. " ". $company->city. " ".             
        Mapper::location($company->country)->map(['zoom' => 17, 'markers' => ['title' => 'My Location', 'animation' => 'DROP'], 'clusters' => ['size' => 10, 'center' => true, 'zoom' => 30]]);
        }

        /*Mapper::map(53.381128999999990000, -1.470085000000040000, ['eventBeforeLoad' => 'console.log("before load");']);*/

        return view('companies.show', compact('company', 'openings', 'companies_ids'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('companies.edit', compact('company'));
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

        // $this->validate($request, [
        //     'what' => 'required',
        //     'url' => 'required',
        //     'tel' => 'required',
        //     'address1' => 'required',
        // ]);

        // $input = $request->except('photo', 'skills', '_token');

        // $company = Company::findOrFail($id);
        //
        // $company->update($request->all());

        // \Session::flash('flash_message', 'edited company information' );

        // return redirect(url('companies', [$company->id]));
        // return redirect()->route('companies.show', [$company->id]);
        // return redirect('companies/show')->with('success', 'Updated your resume');

        // dd($request);

        // $rules = [
        //     'company_name' => 'required',
        //     'email' => 'required|unique:companies',
        //     'company_logo' => 'required',
        //     'tel' => 'required',
        // ];

        // $company = new Company;

        // if($request->company_logo){
        //     $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->company_logo));
        //     $fileNameToStoreLogo = time().'.png';
        //     file_put_contents(public_path('/storage/').$fileNameToStoreLogo, $data);
        //     $company->company_logo = $fileNameToStoreLogo;
        // }

        // // if($request->background_photo){
        // //     $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->background_photo));
        // //     $fileNameToStorePhoto = time().'.png';
        // //     file_put_contents(public_path('/storage/').$fileNameToStorePhoto, $data);
        // //     $company->background_photo = $fileNameToStorePhoto;
        // // }

        // // if($request->what_photo1){
        // //     $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->what_photo1));
        // //     $fileNameToStorePhoto1 = time().'.png';
        // //     file_put_contents(public_path('/storage/').$fileNameToStorePhoto1, $data);
        // //     $company->what_photo1 = $fileNameToStorePhoto1;
        // // }

        // // $company->company_name = $request->company_name;
        // $company->address1 = $request->address1;
        // $company->established_at = $request->established_at;
        // $company->what = $request->what;
        // $company->what_photo1_explanation = $request->what_photo1_explanation;
        // // $company->email = $request->email;
        // // $company->ceo_name = $request->ceo_name;
        // // $company->url = $request->url;
        // // $company->company_size = $request->company_size;
        // // $company->tel = $request->tel;
        // // $company->city = $request->city;
        // // $company->country = $request->country;
        // // // $company->spoken_language = $request->spoken_language;

        // $company->save();

        // // $this->validate($request, $rules);

        // // // Company::create($request->all());
        // // $request->user()->companies()->update([
        // //     'company_name' => $request->company_name,
        // //     'email' => $request->email,
        // //     'ceo_name' => $request->ceo_name,
        // //     'is_active' => '1',
        // //     'company_logo' => $fileNameToStore,
        // //     'tel' => $request->tel,
        // // ]);

        // // \Session::flash('flash_message', 'created company information');

        // // return redirect('companies');
        // return redirect('/');
        $rules = [    // ②
            // 'company_name' => 'required',
            // 'email' => 'required|unique:companies',
            'email' => 'required',        
            'url' => 'required',
            'company_logo' => 'required',
            'background_photo' => 'required',
            'what_photo1' => 'required',            
            'tel' => 'required',
        ];
        // $request->user_id = Auth::user()->id;

        if($request->company_logo){
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->company_logo));
            $fileNameToStore = time().'.png';
            file_put_contents(public_path('/storage/').$fileNameToStore, $data);
        }
        if($request->background_photo){
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->background_photo));
            $fileNameToStoreCover = time().'cover'.'.png';
            file_put_contents(public_path('/storage/').$fileNameToStoreCover, $data);
        }
        if($request->what_photo1){
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->what_photo1));
            $fileNameToStoreWhat = time().'what'.'.png';
            file_put_contents(public_path('/storage/').$fileNameToStoreWhat, $data);
        }

        $this->validate($request, $rules);  // ③

        // Company::create($request->all());
        $request->user()->companies()->update([
            // 'company_name' => $request->company_name,
            'email' => $request->email,
            'is_active' => '1',
            // 'url' => $request->url,

            'company_logo' => $fileNameToStore,
            'background_photo' => $fileNameToStoreCover,
            'what_photo1' => $fileNameToStoreWhat,

           // 'background_photo' => $fileNameToStoreCover,
            'tel' => $request->tel,
            'address1' => $request->address1,
            'established_at' => $request->established_at,
            'what' => $request->what,
            'what_photo1_explanation' => $request->what_photo1_explanation,
            'ceo_name' => $request->ceo_name,
            'url' => $request->url,
            'company_size' => $request->company_size,
            'city' => $request->city,
            'country' => $request->country,
            'spoken_language' => $request->spoken_language,

        ]);

        \Session::flash('flash_message', 'Updated company information');

        // return redirect('companies');
        return redirect('/hiring_portal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        $company->delete();

        \Session::flash('flash_message', 'deleted company information');

        return redirect('companies');
    }
}
