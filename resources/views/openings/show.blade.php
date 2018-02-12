@extends('layouts.app')

@section('content')

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

.info{
    font-size: 15px;
    padding-bottom: 20px;
}

.ui.form{
    font-size: 12px;
}

.page-header .fa{
    color: #0f739b;
}


</style>

<?php $skills = return_resume_Skills(); ?>

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
                More job offer
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">

        <div role="tabpanel" class="tab-pane active" id="jobinfo" style="padding-top:30px;">
            @if(\Auth::user() ? \Auth::user()->canEdit($opening) : false)
                <a class="ui blue button massive" href="{{url('openings/edit').'/?opening_id='.$opening->id}}"> Edit </a>
            @endif
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-6">
                    <h4 class="page-header"><i class="fa fa-file-text" aria-hidden="true"></i> Basic Job Info</h4>
                    <div class="ui form">
                        <label>Job Title</label>
                        <div class="info">{{$opening->title}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="ui form">
                                <label>Salary Range</label>
                                <div class="info">{!! salary_ranges()[$opening->salary_range] !!}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="ui form">
                                <label>Hiring Type</label>
                                <div class="info">
                                    @if($opening->hiring_type == 0)
                                        Intern
                                    @elseif($opening->hiring_type == 1)
                                        Regular
                                    @elseif($opening->hiring_type == 2)
                                        Temporary
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ui form">
                        <label>Date posted:</label>
                        <div class="info">
                                 {{ date(' M. j, Y ',strtotime($opening->created_at)) }}
                        </div>
                    </div>

                    <div class="ui form">
                        <label>Address</label>
                        <div class="info">

                        {{$opening->address1}},
                        {{$opening->address2}},
                        {{$opening->province_code}},
                        {{$opening->country_code}}

                        </div>
                    </div>

                    <div class="ui form">
                        <label>Details</label>
                        <div class="info">{!! $opening->details != '' ? $opening->details : '<span style="color:gray;">No info.</span>' !!}</div>
                    </div>


                    <div class="ui form">
                        <label>Requirements</label>
                        <div class="info">{!! $opening->requirements != '' ? $opening->requirements :  '<span style="color:gray;">No info.</span>' !!}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="page-header">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        Skill Requirements
                        <span style="color:#a94442;"></span>
                    </h4>
                    <div class="row" id="skill_required">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                        </div>
                        <script type="text/javascript">
                        $(function(){
                            var skill_requirements = JSON.parse("{{json_encode($opening->skill_requirements)}}".replace(/&quot;/g,'"'));

                            var skills_container = $('#skill_required');
                            skills_container.find('.col-md-4').html('');
                            var language_added = [];
                            var x = 0;

                            for(var i = 0; i < skill_requirements.length; i++){
                                if(x > 2){
                                    x = 0;
                                }

                                var lang = skill_requirements[i].language.toLowerCase() == 'c++' ? 'cplus2' : (skill_requirements[i].language.toLowerCase() == "c#" ? 'csharp' : (skill_requirements[i].language.toLowerCase() == 'node.js' ? 'node-js' : skill_requirements[i].language.toLowerCase()) );

                                if(language_added.includes(lang)){
                                    skills_container.find('.'+lang).parent().find('.body').append('<div class="ellipsis">'+skill_requirements[i].category+'</div>');
                                }
                                else
                                {
                                    skills_container.find('.col-md-4').eq(x).append(
                                        '<div class="job-card">'
                                        +'    <div class="header ellipsis '+lang+'">'+skill_requirements[i].language+'</div>'
                                        +'    <div class="body"><div class="ellipsis">'+skill_requirements[i].category+'</div> </div>'
                                        +'</div>'
                                    );
                                    language_added.push(lang)
                                    x++;
                                }
                            }

                            if(skill_requirements.length < 1){
                                skill_requirements.html('<div class="col-md-4" style="color:gray;">No skill requirements.</div>');
                            }
                        });
                        </script>
                    </div>
                </div>
                @if (!Auth::guest())
                    @if (Auth::user()->role == 0)
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{action('ApplicationController@create', $opening->id)}}" class="ui button red big" >
                                    Apply to this Job
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
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
            <!--div class="container text-center" style="padding-top:3rem;height:500px;width:100%;">
            {{-- {!! Mapper::render() !!} --}}
        </div> -->
        </div>

        <div id="morehiring" class="tab-pane fade">
            <h3>Company hiring jobs</h3>
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        {{ count($more_openings) ? ' ' : 'No other current hiring.'}}
                        @if (count($more_openings) > 0)
                            @foreach ($more_openings as $moreopening)
                                <div class="col-md-6">
                                    @include('inc.job-container',['opening'=>$moreopening])
                                </div>
                            @endforeach
                        @endif
                    </div>
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
