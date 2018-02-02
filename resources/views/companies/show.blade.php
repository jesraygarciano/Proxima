@extends('layouts.app')

@section('content')
<div class="container">
    <div class="single-page" class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a data-toggle="tab" href="#compinfo">
                    Company Information
                </a>
            </li>
            <li role="presentation">
                <a data-toggle="tab" href="#joblists">
                    Opening Job lists
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" id="compinfo" class="tab-pane active"> {{--START COMPANYINFO --}}
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Company Information</h2>
                    </div>
                </div>
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
            <div class="row text-center">
                <div class="col-md-12 cover-info">
                    <div class="cover-image">
                        <img src="{{ $company->background_photo }}" alt="{{ $company->company_name}}" />
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
                                        &nbsp; {{ $company->address1 }}, {{ $company->city }}, {{ $company->country }}
                                    </h5>
                                    <h5>
                                        <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
                                        &nbsp; {{ $company->established_at }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-8">

                    <h3>About us:</h3>
                    <p>
                        {{ $company->what }}
                    </p>
                    <h3>Why join us?:</h3>
                        <img src="{{ $company->what_photo1 }}" alt="{{ $company->company_name}}" />
                    <p>
                        {{ $company->what_photo1_explanation }}
                    </p>

                </div>
                <div class="col-md-4">
                    <h3>Company details:</h3>
                    <ul class="company-list-info">
                        <li>
                            <div class="field-name">Email</div>
                            <div class="field-value">{{ $company->email }}</div>
                        </li>
                        <li>
                            <div class="field-name">CEO</div>
                            <div class="field-value">{{ $company->ceo_name }}</div>
                        </li>
                        <li>
                            <div class="field-name">Company website URL</div>
                            <div class="field-value">{{ $company->url }}</div>
                        </li>
                        <li>
                            <div class="field-name">Company size</div>
                            <div class="field-value">{{ $company->company_size }}</div>
                        </li>
                        <li>
                            <div class="field-name">Company Tel#</div>
                            <div class="field-value">{{ $company->tel }} (Tel)</div>
                        </li>
                        <li>
                            <div class="field-name">Company address</div>
                            <div class="field-value">{{ $company->address1 }}, {{ $company->city }}, {{ $company->country }}</div>
                        </li>
                        <li>
                            <div class="field-name">Language spoken</div>
                            <div class="field-value">{{ $company->language }}</div>
                        </li>
                    </ul>
                </div>
            </div>

            @if(!empty($company->address1))
                <div class="container text-center" style="padding-top:3rem;height:500px;width:100%;">
                        {!! Mapper::render() !!}
                </div>
            @endif
<!--             <style>
              #map { position:absolute; top:0; bottom:0; width:100%; height: 500px; }
            </style>
            <div class="row text-center">
                <div class="col-md-12">
                    <div id='map'></div>
                    <script>
                    L.mapbox.accessToken = 'pk.eyJ1IjoibGFib25ldHdvcmsiLCJhIjoiY2pkMnFzcXN6MmNnYzJ5cW9kN2FwYXBrdiJ9.yIp-cDl8ipzrnO_9NGtXVA';
                    var map = L.mapbox.map('map', 'mapbox.streets')
                        .setView([40, -74.50], 9);
                    </script>                
                </div>
            </div>  -->


            @if (!Auth::guest())
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

        </div> {{-- END COMPANY INFO --}}

        <div id="joblists" class="tab-pane fade">
            <h3>Opening Job lists</h3>
            <div class="row">
                <div class="col-md-10">
                    @if (count($openings) > 0)
                    @foreach ($openings as $opening)
                    <div class="job-tile">
                        <div>
                            @if($opening->hiring_type == 0)
                            <span class="job-position intern">Intern</span>
                            @elseif($opening->hiring_type == 1)
                            <span class="job-position regular">Regular</span>
                            @elseif($opening->hiring_type == 2)
                            <span class="job-position intern">temporary/partime</span>
                            @endif
                        </div>
                        <div class="job-title">
                            <a href="{{ url('openings', $opening->id) }}"> {{ $opening->title }} </a>
                            <img class="pull-right" src="/storage/{{ $opening->company->company_logo }}" alt="" border="0" height="100" width="130" style="max-width: 130px;">
                        </div>
                        <div class="company-name_opening_list"><a href="{{ url('companies', $opening->company->id) }}"> {{$opening->company->company_name}} </a>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <ul class="opening-feature-info-list">
                                    <li>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        {{ $opening->company->address1 }}
                                    </li>
                                    <li>
                                        <i class="fa fa-dollar" aria-hidden="true"></i>
                                        {!! salary_ranges()[$opening->salary_range] !!}
                                    </li>                                                                
                                    <li>
                                        <i class="fa fa-code" aria-hidden="true"></i>
                                        @foreach(main_languages() as $main_language)
                                        @if($match_array = array_intersect($opening->has_skill->lists('id')->toArray(), get_language_ids($main_language)))
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
                            </div> <!-- col-sm-6 -->

                            <div class="col-sm-4">
                                <ul class="opening-feature-info-list">
                                    <li>
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                        {{ $opening->requirements }}
                                    </li>
                                    <li>
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                        {{ $opening->details }}
                                    </li>                                         
                                </ul>
                            </div> <!-- col-sm-4 -->
                        </div>

                    <hr class="opening-top-date-hr" style="margin-top: 7px; margin-bottom: 7px;">
                    <div class="footer">
                        <div class="pull-left">
                            <div class="foggy-text"> {{ date(' M. j, Y ',strtotime($opening->created_at)) }} </div>
                        </div>
                        <div class="pull-right">
                            <div class="foggy-text">
                                @include('openings.opening_bookmark.bookmark_button', ['opening' => $opening])
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
        </div> {{-- END OF ROW --}}

    </div>

    </div>

    </div>
</div>
@endsection
