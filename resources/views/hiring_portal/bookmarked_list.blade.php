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
                @for ($i=0; $i < count($applicants); $i++)
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
                                        <div class="applicant-name"><a href="{{ url('hiring_portal/user_index_show', $applicants[$i]->id) }}">{{$applicants[$i]->f_name.' '.$applicants[$i]->l_name}}</a></div>
                                        <ul class="feature-info-list">
                                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{$applicants[$i]->country.', '.$applicants[$i]->city}} </li>
                                            <li>
                                                <i class="fa fa-code" aria-hidden="true"></i>
                                                <div class="label label-warning java">
                                                    Java
                                                </div>
                                                <div class="label label-primary python">
                                                    Python
                                                </div>
                                                <div class="label label-info javascript">
                                                    <div class="hover-info">
                                                        <div class="pointer"></div>
                                                        <div class="content">
                                                            <ul>
                                                                <li>JQuery</li>
                                                                <li>Angular</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    Javascript
                                                </div>
                                                <div class="label label-info html">
                                                    HTML
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    @include('hiring_portal.saved_applicants.save_applicant_bttn')
                                </div>
                            </div>
                        </div>
                @endfor
            @endif
            </div>
        </div>

        <div class="col-md-2 well">
            <h4>Advertisement</h4>
        </div>
    </div>
</div>
@endsection
