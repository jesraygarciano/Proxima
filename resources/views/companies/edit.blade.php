@extends('layouts.app')

@section('content')

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
                }

                .cover-info .picture img{
                    width: 100%;
                }

                .cover-info{
                }

                .cover-info img{
                    border:none!important;
                }
            </style>
            {!!Form::open(['action' => 'CompaniesController@update', 'method' => 'PATCH', 'files' => true, 'enctype' => 'multipart/form-data']) !!}            
            <div class="row text-center">

                <div class="col-md-12 cover-info">
                    <div class="cover-image">
                        <img src="{{ $company->company_logo }}" alt="{{ $company->company_name}}" />
                    </div>
                    <div class="row cover-info" id="openings-title" style="margin:0px; margin-top:-100px;">
                        <div class="col-sm-2">
                            <div class="picture">
                                <div class="photo-wrapper">
                                    <img src="{{asset('img/bg-img.png')}}" class="bg-img">
                                    <img class="_image" src="{{ $company->company_logo }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="row" style="text-align:left;">
                                <div class="col-sm-6">
                                    <h1>
                                        <a href="{{ url('companies', $company['id']) }}">
                                            {{ $company->company_name }}
                                            <br>
                                        </a>
                                    </h1>
                                </div>
                                <div class="col-sm-6">
                                      <div class="row">
                                          <div class="form-group">
                                              {!! Form::label('address1', 'Primary address:', ['class' => 'col-sm-3 control-label']) !!}
                                              <div class = "col-sm-7">
                                                {!! Form::text('address1', old('address1'), ['class' => 'form-control', 'placeholder'=>$company->address1]) !!}
                                              </div>
                                          </div>                                    
                                      </div>

                                      <div class="row" style="padding-top: 1rem;">
                                          <div class="form-group">
                                              {!! Form::label('established_at', 'Established date:', ['class' => 'col-sm-3 control-label']) !!}
                                              <div class = "col-sm-7">
                                                {!! Form::date('established_at', old('established_at'), ['class' => 'form-control', 'placeholder'=>$company->established_at, 'onfocus' => "(this.type='established_at')", 'onblur' => "(this.type='established_at')"]) !!}
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
                <div class="col-md-6">
                      <div class="form-group">
                        <h3>About Us:</h3>
                            <div class="form-group">
                                {!!Form::textarea('what', old('what'), ['class' => 'form-control'])!!}
                            </div>
                      </div>

                      <div class="form-group">
                            <h3>Why join us?:</h3>

                            <div class = "row">
                                  <div class="form-group">
                                      <div class = "col-md-7">
                                        <div class="crop-control" style="height: 200px; width: 200px;">
                                          <div class="image-container">
                                            <img src="https://grangeprint.com/image/cache/placeholder-750x750-nofill-255255255.png">
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
                                        {!!Form::textarea('what_photo1_explanation', old('what_photo1_explanation'), ['class' => 'form-control'])!!}
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
                                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder'=>$company->email]) !!}
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
                                {!! Form::text('company_size', old('company_size'), ['class' => 'form-control', 'placeholder'=>$company->company_size]) !!}
                            </div>
                          </div>


                        </li>
                        <li>

                          <div class="row">
                            <div class="col-sm-4">
                              {!! Form::label('tel', 'Company Tel#') !!}
                            </div>

                            <div class="col-sm-7">
                               {!! Form::text('tel', old('tel'), ['class' => 'form-control', 'placeholder'=>$company->tel]) !!}
                            </div>
                          </div>

                        </li>
                        <li>

                          <div class="row">
                            <div class="col-sm-4">
                              {!! Form::label('address1', 'Company address') !!}
                            </div>
                            <div class="col-sm-7">
                                {!! Form::text('address1', old('address1'), ['class' => 'form-control', 'placeholder'=> 'Street, Unit, Floor']) !!}
                            </div>
                          </div>


                        </li>
                        <li>

                          <div class="row">
                            <div class="col-sm-4">
                              {!! Form::label(null, null) !!}
                            </div>
                            <div class="col-sm-7">
                                {!! Form::text('city', old('city'), ['class' => 'form-control', 'placeholder'=>$company->city]) !!}
                            </div>
                          </div>

                        </li>

                        <li>

                          <div class="row">
                            <div class="col-sm-4">
                              {!! Form::label(null, null) !!}
                            </div>
                            <div class="col-sm-7">
                                {!! Form::text('country', old('country'), ['class' => 'form-control', 'placeholder'=>$company->country]) !!}
                            </div>
                          </div>

                        </li>

                        <li>

                          <div class="row">
                            <div class="col-sm-4">
                              {!! Form::label('language', 'Spoken language') !!}
                            </div>
                            <div class="col-sm-7">
                                {!! Form::text('language', old('language'), ['class' => 'form-control', 'placeholder'=> 'e.g. English']) !!}
                            </div>
                          </div>

                        </li>

                    </ul>
                </div>
            </div>

            <div class="container"></div>
<!--             <div class="container text-center" style="padding-top:3rem;height:500px;width:100%;">
                    {!! Mapper::render() !!}
            </div> -->

            {{--@if (!Auth::guest())
                @if (Auth::user()->role == 1)
                    @if (in_array(Auth::user()->id, $companies_ids))
                        <br/>
                        {!! link_to(action('CompaniesController@edit', [$company->id]), '編集', ['class' => 'btn btn-primary']) !!}
                        <br/>
                        {!! Form::open(['method' => 'DELETE', 'url' => ['companies', $company->id]]) !!}
                        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endif
                @endif
            @endif
            --}}
        <div class="row text-center">
            <div class="form-group">
                {!!Form::submit('Update Company', ['class' => 'btn btn-primary'])!!}
            </div>
        </div>
    {!!Form::close()!!}
        </div> {{-- END COMPANY INFO --}}
</div>
@endsection