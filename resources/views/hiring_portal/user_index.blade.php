@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Lists of applicants:</h1>

    <div class="row">
        <div class="col-md-3 well" id="opening-search">
            <h4>Search criteria:</h4>
            {!!Form::open(['action' => 'ResumesController@store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{-- {!!Form::label('opening_search', '')!!} --}}
                {!!Form::text('opening_search', null, ['class' => 'form-control', 'placeholder' => 'Search'])!!}
            </div>
            <div class="form-group">
                {!!Form::submit('Search', ['class' => 'btn btn-primary form-control'])!!}
            </div>
            {!!Form::close()!!}

            <br />

            <form method="GET" action="{{Request::url()}}">
                <h4>Advanced search criteria:</h4>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Applicant:</label>
                    <input type="text" class="form-control" name="name" id="formGroupExampleInput2" value="{{$_GET['name'] ?? ''}}" placeholder="Applicant name">
                </div>

                <div class="form-group">
                    <label for="exampleSelect1">Location:</label>
                    <select class="form-control" id="exampleSelect1">
                        <option>Cebu</option>
                        <option>Manila</option>
                        <option>Davao</option>
                        <option>Bohol</option>
                        <option>Leyte</option>
                    </select>
                </div>

                <div class="form-check">
                    <label for="exampleSelect1">Languages:</label>
                    <div class="form-row">
                        <div class="col-xs-6">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                PHP
                            </label>
                        </div>
                        <div class="col-xs-6">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Java
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-xs-6">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Ruby
                            </label>
                        </div>
                        <div class="col-xs-6">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Python
                            </label>
                        </div>
                    </div>
                </div>
                <br />
                <br />
                <br />
                <div class="form-group">
                    <label for="exampleSelect1">Submitted application:</label>
                    <select class="form-control" id="exampleSelect1">
                        <option>Past 24 hours</option>
                        <option>Past Week</option>
                        <option>Past Month</option>
                        <option>Anytime</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary form-control">Advanced search</button>
            </form>
        </div>
        <!-- #f4b400 -->
        <div class="col-md-7">
            @if (count($applicants) > 0)
                @for ($i=0; $i < count($applicants); $i++)
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
                        </div>
                        @include('hiring_portal.saved_applicants.save_applicant_bttn')
                    </div>
                @endfor
                {!! $applicants->render() !!}
            @endif
        </div>
        <div class="col-md-2 well">
            <h4>Advertisement</h4>
        </div>
    </div>
</div>

@endsection
