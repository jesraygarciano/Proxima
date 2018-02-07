@extends('layouts.app')

@section('content')
<div class="container">
    <article>
        <h3>
            <h1>List of bookmarked users</h1>
        </h3>
    </article>

    <hr>
    <style type="text/css">
        .applicant-info-panel .fa-bookmark{
            position: absolute;
            right: 10px;
            top:0px;
            color: #a3a3a3;
            cursor: pointer;
        }
    </style>

    <div class="row">
        <div class="col-md-10">
            <div class="row">
           @if (count($applicants) > 0)
                @foreach ($applicants as $applicant)
                        <div class="col-md-6">
                            <div class="applicant-tile">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="applicant-image">
                                            <img src="{{asset('img/bg-img.png')}}" class="bg-img">
                                            <img class="_image" src="{{asset('img/member-placeholder.png')}}">
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="applicant-name"><a href="{{ url('hiring_portal/user_index_show', $applicant->id) }}">{{$applicant->f_name.' '.$applicant->l_name}}</a></div>
                                        <ul class="feature-info-list">
                                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{$applicant->country.', '.$applicant->city}} </li>
                                            <li>
                                                <!-- Language -->

                                            @foreach(main_languages() as $main_language)
                                                @if (return_master_resume($applicant))

                                                    @if($match_array = array_intersect(return_master_resume($applicant)->has_skill->lists('id')->toArray(), get_language_ids($main_language)))
                                                        {{-- @if($x < 3) --}}
                                                            {{-- have to take away original key from $match_array --}}
                                                            <?php $match_array = array_values($match_array); ?>
                                                            @for($j=0; $j < count($match_array) ; $j++)
                                                                @if($j == 0)
                                                                    <a href="#!" role="button" class="btn label label-warning {{main_languages_class_convert()[$main_language]}}" data-toggle="tooltip" data-placement="bottom" data-html="true" title="
                                                                    <div>{{return_category($match_array[$j])}}</div>
                                                                @else
                                                                    <div>{{return_category($match_array[$j])}}</div>
                                                                @endif

                                                                @if($j == count($match_array) - 1)
                                                                    ">
                                                                    {{$main_language}}<span class="caret"></span>
                                                                @endif
                                                                </a>
                                                            @endfor
                                                        {{-- @endif --}}

                                                    @endif
                                                @endif
                                            @endforeach
                                                
                                            </li>
                                        </ul>
                                        @include('hiring_portal.saved_applicants.save_applicant_bttn')
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            @endif
            </div>
        </div>

        <div class="col-md-2 well">
            <h4>Advertisement</h4>
        </div>
    </div>
</div>
@endsection
