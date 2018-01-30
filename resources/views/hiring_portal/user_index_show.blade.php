@extends('layouts.app')

@section('content')

@include('inc.message')

<div class="container">
@if (count($companies_array)>0)
    @foreach ($companies_array as $company_information)
        <div class="alert alert-success">
            You scouted this user already as
            <strong>{{ $company_information->company_name }}</strong>
        </div>
    @endforeach
@endif

<div class="row user_index_show">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <h3>
                    {{ $users->f_name }} {{ $users->m_name }} {{ $users->l_name }}
                </h3>                
            </div>
            <div class="col-md-4">
                <h3>
                    <i class="fa fa-envelope fa-md" aria-hidden="true"></i>            
                    {{ $users->email }}
                </h3>
            </div>
        </div>
                 <div class="row">
                    <div class="col-md-6">
                         <h4 class="resume-info-sub-title">
                            <i class="fa fa-user" aria-hidden="true"></i>
                                Applicant basic info: 
                         </h4>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">First name</label>
                          <div class="col-sm-8">
                            {{ $users->f_name }}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Middle name</label>
                          <div class="col-sm-8">
                            {{ $users->m_name }}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Last name</label>
                          <div class="col-sm-8">
                            {{ $users->l_name }}
                          </div>
                        </div>                                                
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Gender</label>
                          <div class="col-sm-8">
                            {{ $users->gender }}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Birth date</label>
                          <div class="col-sm-8">
                            {{ $users->birth_date }}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Address</label>
                          <div class="col-sm-8">
                            {{ $users->address1 }}
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <h4 class="resume-info-sub-title">
                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                Education 
                         </h4>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">University</label>
                          <div class="col-sm-8">
                            {{ $users->university }}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Field of study</label>
                          <div class="col-sm-8">
                            {{ $users->field_of_study }}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Program of study</label>
                          <div class="col-sm-8">
                            {{ $users->program_of_study }}
                          </div>
                        </div>                        
                    </div>
                 </div>
          </div>
</div>
<hr>
<h3>Objective:</h3>

{{ $users->objective }}

<h3>Applicant details:</h3>
<div class = "body">email : {{ $users->email }}</div>
<div class = "body">Home Address : {{ $users->address1 }}</div>
<div class = "body">Permanent Address : {{ $users->address2 }}</div>
<div class = "body">Postal : {{ $users->postal }}</div>
<div class = "body">Birthdate : {{ $users->birth_date }}</div>
<div class = "body">nationality : {{ $users->nationality }}</div>
<div class = "body">country : {{ $users->country }}</div>
<div class = "body">phone_number : {{ $users->phone_number }}</div>
<div class = "body">Gender : {{ $users->gender }}</div>

<br>
{{-- {!! link_to(action('ScoutsController@create', $users->id), 'Scout', ['class' => 'btn btn-primary']) !!} --}}
{!! link_to(route('scouts.create', $users->id), 'Scout', ['class' => 'btn btn-primary']) !!}
</div>

@endsection
