@extends('layouts.app')

@section('content')

<div class="container tall single-page">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#jobinfo" role="tab" data-toggle="tab">
                Job Information
            </a>
        </li>
        <li role="presentation">
            <a href="#companyinfo" role="tab" data-toggle="tab">
                Company Information
            </a>
        </li>
        <li role="presentation">
            <a href="#morehiring" role="tab" data-toggle="tab">
                More job hiring
            </a>
        </li>
    </ul>

   <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="jobinfo">
          <div class="row">
            <div class="col-sm-12">
                <h2>Job Information</h2>
            </div>
          </div>
        <div id="show_opening"> {{-- START OF SHOW OPENING --}}
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
                    <hr>
                    <div class="row" id="openings-body" style="margin:0px;">
                        <div class="col-md-7">
                            <div class="job-description">
                                <h4>
                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                    Job description:
                                </h4>
                                <hr class="hr-desc" />
                                {{ $opening->details }}
                            </div>
                            <div class="job-qualify" >
                                <h4>
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    Job Qualifications:
                                </h4>
                                <hr />
                                <p>{{ $opening->requirements }}</p>
                            </div>

                        </div>

                        <div class="col-md-5">
                            <h4>
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                Company Profile:
                            </h4>
                            <hr>

                            <div class="row">
                                <div class="col-xs-6">
                                    Company size:
                                    <h5>
                                        <b>
                                            {{ $company->number_of_employee }}
                                        </b>
                                        Employees
                                    </h5>
                                    Telephone no.
                                    <h5>
                                        <b>
                                            {{ $company->tel }}
                                        </b>
                                    </h5>
                                    Country
                                    <h5>
                                        <b>
                                            {{ $company->country }}
                                        </b>
                                    </h5>
                                </div>
                                <div class="col-xs-6">
                                    Postal no.
                                    <h5>
                                        <b>
                                            {{ $company->postal }}
                                        </b>
                                    </h5>
                                    CEO:
                                    <h5>
                                        <b>
                                            {{ $company->ceo_name }}
                                        </b>
                                    </h5>
                                    Bill company name:
                                    <h5>
                                        <b>
                                            {{ $company->bill_company_name }}
                                        </b>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    {!! link_to(action('ApplicationController@create', [$opening->id]), 'Application Form', ['class' => 'btn btn-danger']) !!}
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="companyinfo">

        <div class="row text-center">
            <div class="col-md-12 cover-info">
                <div class="cover-image">
                    <img src="{{ $opening->picture }}" alt="{{ $company->company_name}}" />
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
                                <h5>
                                    <i class="fa fa-map-marker fa-lg" aria-hidden="true"></i>
                                    &nbsp; {{ $opening->city }}, {{ $opening->country }}
                                </h5>
                                <h5>
                                    <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
                                    &nbsp; {{ $opening->created_at }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="company-opening-body">
            <div class="col-md-7">

                <div class="row">
                    <div class="col-md-12">
                        <h3>
                            <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                Company overview:
                        </h3>
                        <p>
                            {{ $company->company_introduction }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        
                        <h3>
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                                Why join us?
                        </h3>
                        <p>
                            {{ $company->what }}
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-md-5">
                <h3>
                    <i class="fa fa-signal" aria-hidden="true"></i>
                    Company snapshots:
                </h3>
                <div>
                    Email address :
                     <h5>
                        <b>{{ $company->email }}</b>
                     </h5>
                     <br />
                 </div>
                <div>
                    Company Tel. no :
                     <h5>
                        <b>{{ $company->tel }}</b>
                     </h5>
                     <br />
                 </div>                 
                <div>
                    Company address :
                     <h5>
                        <b>{{ $company->address1 }}</b>
                     </h5>
                     <br />
                 </div>
                <div>
                    Company website :
                     <h5>
                        <b>{{ $company->url }}</b>
                     </h5>
                     <br />
                 </div>
                <div>
                    Company size :
                     <h5>
                        <b>{{ $company->url }}</b>
                     </h5>
                     <br />
                 </div>                 
                <div>in_charge : {{ $company->in_charge }}</div>
                <div>ceo_name : {{ $company->ceo_name }}</div>
                <div>number_of_employee : {{ $company->number_of_employee }}</div>                
            </div>
        </div>

    </div>

    <div id="morehiring" class="tab-pane fade">

      <h3>Company hiring jobs</h3>
      <div class="row">
            <div class="col-md-10">
                {{ count($more_openings) ? ' ' : 'No other current hiring.'}}
                   @if (count($more_openings) > 0)
                    @foreach ($more_openings as $moreopening)
                        <div class="job-tile">
                            <div>
                                @if($moreopening->featured_status == 1)
                                    <span class="job-position featured">Featured</span>
                                @endif
                                @if($moreopening->hiring_type == 0)
                                    <span class="job-position intern">Intern</span>
                                @elseif($moreopening->hiring_type == 1)
                                    <span class="job-position regular">Regular</span>
                                @elseif($moreopening->hiring_type == 2)
                                    <span class="job-position intern">Temporary</span>
                                @endif
                            </div>
                            <div class="job-title">
                                <a href="{{ url('openings', $moreopening->id) }}" class="ellipsis padding-right-110" style="display: block;"> {{ $moreopening->title }} </a>
                                {{-- <img class="pull-right" src="{{ $moreopening->company->company_logo }}" alt="" border="0" height="100" width="130" style="max-width: 130px;"> --}}
                                <span class="contain pull-right photo-adjust" style="background-image: url('{{ $moreopening->company->company_logo }}')"></span>
                                {{-- <div class="clear"></div> --}}
                            </div>
                            <div class="company-name_opening_list ellipsis padding-right-110"><a href="{{ url('companies', $moreopening->company->id) }}"> {{$moreopening->company->company_name}} </a>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <ul class="opening-feature-info-list">
                                        <li class="ellipsis padding-right-110"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $moreopening->company->address1 }}
                                        </li>
                                        <li class="ellipsis padding-right-110"><i class="fa fa-dollar" aria-hidden="true"></i>
                                            {!! salary_ranges()[$moreopening->salary_range] !!}
                                        </li>
                                        <li>
                                            <i class="fa fa-code" aria-hidden="true"></i>
                                            @foreach(main_languages() as $main_language)
                                                @if($match_array = array_intersect($moreopening->has_skill->lists('id')->toArray(), get_language_ids($main_language)))
                                                    {{-- have to take away original key from $match_array --}}
                                                    <?php $match_array = array_values($match_array); ?>

                                                    @for($i=0; $i < count($match_array) ; $i++)
                                                        @if($i == 0)
                                                            <a href="#!" role="button" class="btn label label-warning {{main_languages_class_convert()[$main_language]}}" data-toggle="tooltip" data-placement="bottom" data-html="true" title="
                                                            <ul>
                                                                <li>{{return_category($match_array[$i])}}</li>                    
                                                        @else
                                                            <li>{{return_category($match_array[$i])}}</li> 
                                                        @endif

                                                        @if($i == count($match_array) - 1)
                                                            </ul>">
                                                            {{$main_language}}<span class="caret"></span>
                                                        @endif
                                                        </a>
                                                    @endfor
                                                @endif
                                            @endforeach
                                        </li>
                                    </ul>                                    
                                </div>
                                <div class="col-sm-4">
                                    <ul class="opening-feature-info-list">
                                        <li>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            {{ $moreopening->requirements }}
                                        </li>
                                        <li>
                                            <i class="fa fa-file-text" aria-hidden="true"></i>
                                            {{ $moreopening->details }}
                                        </li>                                         
                                    </ul>                                    
                                </div>
                            </div>

                            <hr class="opening-top-date-hr" style="margin-top: 7px; margin-bottom: 7px;">
                            <div class="footer">
                                <div class="pull-left">
                                    <div class="foggy-text"> {{ date(' M. j, Y ',strtotime($moreopening->created_at)) }} </div>
                                </div>
                                <div class="pull-right">
                                    <div class="foggy-text">
                                        @include('openings.opening_bookmark.bookmark_button', ['opening' => $moreopening])
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
                <div class="col-md-2 well">
                    <h4>Advertisement</h4>
                </div>
            </div> 
             {{-- END OF ROW --}}

    </div>

    </div> <!-- END TAB CONTENT -->
</div>

@endsection
