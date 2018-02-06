@extends('layouts.app')

@section('content')
    @include('errors.form_errors')
    <div class="container">
        <div id="compinfo"> {{--START COMPANYINFO --}}
        <style type="text/css">
        .cover-image{
            position: relative;
            height: 300px;
            background: #c8c8c8;
            overflow: hidden;
            border: 1px solid #cecece;
        }

        .cover-image img{
            position: absolute;
            top: 50%;
            transform:translateY(-50%);
            width: 100%;
            left: 0px;
        }

        .cover-info .picture{
            padding: 5px;
            background: white;
            border: 1px solid #cecece;
            position: relative;
            width: 200px;
        }

        .cover-info .picture img{
            width: 100%;
        }

        .cover-info{
        }

        .cover-info img{
            border:none!important;
        }

        .ui.form{
            font-size: 16px;
        }

        </style>

        {!!Form::open(['route' => 'companies.update', 'method' => 'PATCH', 'files' => true, 'enctype' => 'multipart/form-data']) !!}

        {!! csrf_field() !!}
        <div class="row text-center">

            <div class="col-md-12 cover-info">
                <div class="cover-image">
                    {{-- <img src="{{ $company->company_logo }}" alt="{{ $company->company_name}}" /> --}}
                    <div class="crop-control">
                        <div class="image-container-cover">
                            @if(!empty($company->background_photo))
                                <img src="{{ $company->background_photo }}" alt="{{ $company->company_name}} Cover photo" />
                            @else
                                <img src="{{ asset('img/default-opening.jpg') }}" class="bg-img">
                            @endif
                            <label for="background_photo" class="input-trigger hover-div">
                                <p>
                                    <i class="fa fa-file-image-o fa-5x" aria-hidden="true"></i>
                                    <br>
                                    Upload Cover photo
                                </p>
                            </label>
                        </div>
                        <div class="input-container">
                            <input type="file" id="background_photo" name="background_photo" accept="image/*" />
                        </div>
                    </div>
                </div>
                <div class="row cover-info" id="openings-title" style="margin:0px; margin-top:-100px;">
                    <div class="col-sm-2">
                        <div class="picture">
                            <div class="photo-wrapper">
                                <div class="crop-control" style="height: 200px; width: 200px;">
                                    <div class="image-container">
                                        <img src="{{ $company->company_logo }}" alt="{{ $company->company_name}}" />
                                        <label for="company_logo" class="input-trigger hover-div">
                                            <p>
                                                <i class="fa fa-file-image-o fa-5x" aria-hidden="true"></i>
                                                <br>
                                                Upload Logo
                                            </p>
                                        </label>
                                    </div>
                                    <div class="input-container">
                                        <input type="file" id="company_logo" name="company_logo" accept="image/*" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row" style="text-align:left;">
                            <div class="col-sm-7">
                                <h2 style="padding-top: 1rem;font-weight: 600;">
                                    <a href="{{ url('companies', $company['id']) }}">
                                        {{ $company->company_name }}
                                        <br>
                                    </a>
                                </h2>
                            </div>
                            <div class="col-sm-5">
                                <div class="row">
                                    <div class="form-group">

                                        {!! Form::label('address1', 'Primary address:', ['class' => 'col-sm-4 control-label']) !!}
                                        <div class = "col-sm-7">
                                            <div class="ui form">

                                                {!! Form::text('address1', old('address1'), ['class' => 'form-control', 'placeholder'=>$company->address1]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="padding-top: 1rem;">
                                    <div class="form-group">
                                        {!! Form::label('established_at', 'Established date:', ['class' => 'col-sm-4 control-label']) !!}
                                        <div class = "col-sm-7">
                                            {{-- {!!Form::label('birth_date', 'Birth Date:')!!} --}}
                                            {!!Form::date('established_at', old('established_at'), ['class' => 'form-control', 'placeholder'=>$company->established_at])!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <h3>About Us:</h3>
                    <div class="form-group">
                        <div class="ui form">
                            {!!Form::textarea('what', old('what'), ['class' => 'form-control', 'placeholder' => $company->what  ])!!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <h3>Why join us?:</h3>
                    <div class = "row">
                        <div class="form-group">

                            <div class = "col-md-7">
                                <div class="crop-control" style="height: 200px; width: 400px;">
                                    <div class="image-container">
                                        <img src="http://www.pek-cy.com/sites/default/files/default-image.png">
                                        <label for="what_photo1" class="input-trigger hover-div">
                                            <p>
                                                <i class="fa fa-file-image-o fa-5x" aria-hidden="true"></i>
                                                <br>
                                                Upload
                                            </p>
                                        </label>
                                    </div>
                                    <div class="input-container">
                                        <input type="file" id="what_photo1" name="what_photo1" accept="image/*" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="padding-top: 1rem;">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!!Form::textarea('what_photo1_explanation', old('what_photo1_explanation'), ['class' => 'form-control ui form'])!!}
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-md-5">
                <h3>Company details:</h3>
                <ul class="company-list-info">
                    <li>
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Form::label('email', 'E-Mail Address') !!}
                            </div>
                            <div class="col-sm-7">
                                <div class="ui form">
                                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder'=>$company->email]) !!}
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Form::label('ceo_name', 'CEO name:') !!}
                            </div>
                            <div class="col-sm-7">
                                {!! Form::text('ceo_name', old('ceo_name'), ['class' => 'form-control', 'placeholder'=>$company->ceo_name]) !!}
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Form::label('url', 'Company website URL') !!}
                            </div>
                            <div class="col-sm-7">
                                {!! Form::text('url', old('url'), ['class' => 'form-control', 'placeholder'=>$company->url]) !!}
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Form::label('company_size', 'Company size') !!}
                            </div>

                            <div class="col-sm-7">
                                <div class="ui form">
                                    {!! Form::text('company_size', old('company_size'), ['class' => 'form-control', 'placeholder'=>$company->company_size]) !!}
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Form::label('tel', 'Company Tel#') !!}
                            </div>
                            <div class="col-sm-7">
                                <div class="ui form">
                                    {!! Form::text('tel', old('tel'), ['class' => 'form-control', 'placeholder'=>$company->tel]) !!}
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Form::label('city', 'City address') !!}
                            </div>
                            <div class="col-sm-7">
                                <div class="ui form">
                                    {!! Form::text('city', old('city'), ['class' => 'form-control', 'placeholder'=>$company->city]) !!}
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Form::label('country', 'Country') !!}
                            </div>
                            <div class="col-sm-7">
                                <div class="ui form">
                                    {!! Form::text('country', old('country'), ['class' => 'form-control', 'placeholder'=>$company->country]) !!}
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Form::label('language', 'Spoken language') !!}
                            </div>
                            <div class="col-sm-7">
                                {!! Form::text('language', old('language'), ['class' => 'form-control ui form', 'placeholder'=> 'e.g. English']) !!}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container"></div>
        <div class="row text-center">
            <div class="form-group">
                {!!Form::submit('Update company', ['class' => 'btn btn-primary'])!!}
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>
@endsection
