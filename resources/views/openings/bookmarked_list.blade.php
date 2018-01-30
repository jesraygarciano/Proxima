@extends('layouts.app')

@section('content')

<div class="container">
    <article>
        <h3>
            <h1>List of bookmarks</h1>
        </h3>
    </article>

    <hr>
    
    <div class="row">
        <div class="col-md-10">
            <div class="row">
                @if (count($bookmarks) > 0)
                        @foreach ($bookmarks as $opening)
                            <div class="col-md-6">
                            <ul class="media-list">                        
                            <div class="job-tile">
                                <div>
                                    <span class="job-position featured">Featured</span>
                                    <span class="job-position regular">Regular</span>
                                    <span class="job-position intern">Intern</span>
                                </div>
                                <div class="job-title">
                                    <a href="{{ url('openings', $opening->id) }}"> {{ $opening->title }} </a>
                                </div>
                                <div style="height: 130px; width: 130px; position:absolute; right:30px; top:100px;" class="photo-wrapper pull-right">
                                    <img src="http://localhost:8000/img/bg-img.png" class="bg-img">
                                    <img class="_image" src="{{ $opening->company->company_logo }}">
                                </div>
                                <div class="company-name ellipsis" style="padding-right: 140px;"><a href="{{ url('companies', $opening->company->id) }}"> {{$opening->company->company_name}} </a></div>
                                <ul class="feature-info-list" style="padding-right: 140px;">
                                    <li class="ellipsis-li"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $opening->company->address1 }} </li>
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
                                </ul>
                                <hr>
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
                        </ul>
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
