@extends('layouts.app')

@section('content')

<div class="container">
    <article>
        <h3>
            <h1>List of your Application</h1>
        </h3>
    </article>

    <hr>

    @include('inc.message')

    <div class="col-md-10">
        <div class="row">
        {{-- {{ $applied_application_openings }} --}}
        @if (count($applied_application_openings) > 0)
            @foreach ($applied_application_openings as $applied_application_opening)
            <div class="col-md-6">
                    <div class="job-tile">
                        <div>
                            <span class="job-position featured">Featured</span>
                            <span class="job-position regular">Regular</span>
                            <span class="job-position intern">Intern</span>
                        </div>
                        <div class="title">
                            <div class="job-title">
                                <div class="ellipsis">
                                    <a href="{{ url('openings', $applied_application_opening->id) }}"> {{ $applied_application_opening->title }} </a>
                                </div>
                            </div>
                            <div class="company-name">
                                <div class="ellipsis">
                                    <a href="{{ url('companies', $applied_application_opening->company->id) }}"> {{$applied_application_opening->company->company_name}} </a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div style="height: 125px; width: 125px;" class="photo-wrapper pull-right">
                            <img src="{{asset('img/bg-img.png')}}" class="bg-img">
                            <img class="_image" src="{{ $applied_application_opening->company->company_logo }}">
                        </div>
                        <ul class="feature-info-list">
                            <li class="ellipsis-li"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $applied_application_opening->company->address1 }} </li>
                            <li class="ellipsis-li"><i class="fa fa-dollar" aria-hidden="true"></i> PHP 10,000 - 15,000 </li>
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
                            <li class="ellipsis-li" title="{{ date(' M. j, Y ',strtotime($applied_application_opening->pivot->created_at)) }} Submited">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                {{ date(' M. j, Y ',strtotime($applied_application_opening->pivot->created_at)) }} Submited
                            </li>
                        </ul>
                        <hr style="margin-top: 7px; margin-bottom: 7px;">
                        <div class="footer">
                            <div class="pull-left">
                                <div class="foggy-text"> {{ date(' M. j, Y ',strtotime($applied_application_opening->created_at)) }} </div>
                            </div>
                            <div class="pull-right">
                                <div class="foggy-text">
                                    {!! link_to( url('applications', $applied_application_opening->pivot->id) , 'application info', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- {!! $applied_application_openings->render() !!} --}}
        </div>
        @else
            <h4>
                You haven't submited any application yet.
            </h4>
        @endif
    </div>

    @if (count($applied_application_openings) > 0)
        <div class="col-md-2 well">
    @else        
        <div class="col-md-2 col-md-offset-10 well">
    @endif
            <h4>Advertisement</h4>
        </div>
</div>
@endsection
