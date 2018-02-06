@extends('layouts.app')

@section('content')

<div class="container">
    <article>
        <h3>
            <h1>Lists of applicants</h1>
        </h3>
    </article>
    <hr>
    <div class="row">
        <div class="col-md-3 well" id="opening-search">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>Applicant Search:</h4>
                        <form method="GET" action="{{Request::url()}}">
                            <div class="form-group">
                                {{-- {!!Form::label('applicant_search', '')!!} --}}
                                <div class="table-display">
                                  <input type="text" class="form-control cell-display no-b-radius-right" name="applicant_search" value="{{$_GET['applicant_search'] ?? ''}}" placeholder="Applicants">
                                  <span class="input-group-btn cell-display">
                                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                  </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <form method="GET" action="{{Request::url()}}">
                            <div id="advance_search" class="collapse" style="overflow: hidden;">
                                <br/>
                                <h4>Advanced Search:</h4>

                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Applicant:</label>
                                    <input type="text" class="form-control" name="company_name" value="{{$_GET['company_name'] ?? ''}}" placeholder="Applicant name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Programming Languages:</label>

                                    <select multiple="" id="languages" name="languages[]" class="ui fluid normal dropdown multi-select">
                                        <option value="">Select Languages</option>
                                        <option value="php">PHP</option>
                                        <option value="ruby">Ruby</option>
                                        <option value="java">Java</option>
                                        <option value="c++">C++</option>
                                        <option value="python">Python</option>
                                        <option value="swift">Swift</option>
                                        <option value="go">Go</option>
                                        <option value="c#">C#</option>
                                        <option value="javascript">Javascript</option>
                                        <option value="node">NodeJS</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Province:</label>
                                    <select class="form-control" name="province" id="province">
                                        <option value="" checked>Select Province</option>

                                        @foreach($provinces as $province)
                                        <option value="{{$province->iso_code}}">{{$province->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="">Select type</option>
                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Salary Range Here -->
                                <hr>
                            <button style="margin-bottom: 10px;" type="submit" class="btn btn-primary form-control">Advanced search</button>
                            </div>
                            <center><a href="javascript:void(0)" id="as_bttn" data-toggle="collapse" data-target="#advance_search">Show Advance Search</a></center>
                            <input type="hidden" name="show_advance_search" value="{{$_GET['show_advance_search'] ?? ''}}">
                            <script type="text/javascript">
                                $(document).ready(function(){

                                    var prevent_reoccur = false;

                                    $('#languages').val(JSON.parse('{{ json_encode($_GET['languages'] ?? '')}}'.replace(/&quot;/g,'"')));
                                    $('#province').val("{{$_GET['province'] ?? ''}}");
                                    $('#gender').val("{{$_GET['gender'] ?? ''}}");
                                    $('#salary_range').val("{{$_GET['salary_range'] ?? ''}}");
                                    $('#as_bttn').click(function(){

                                        if(prevent_reoccur){

                                            $('#advance_search' ).animate({ height : "0px" }, 400 );
                                            
                                            $('[name=show_advance_search]').val('closed');
                                            prevent_reoccur = false;
                                            return false;
                                        }

                                        if($('#advance_search').attr('aria-expanded') == 'true')
                                        {
                                            $('[name=show_advance_search]').val('closed');
                                            $('#as_bttn').html('Show Advance Search');
                                        }
                                        else
                                        {
                                            $('[name=show_advance_search]').val('open');
                                            $('#as_bttn').html('Hide Advance Search');
                                        }
                                    });
                                    if($('[name=show_advance_search]').val()=='open'){
                                        prevent_reoccur = true;
                                        $('#as_bttn').html('Hide Advance Search');
                                        $('#advance_search').show();
                                        $('#advance_search').attr('aria-expanded',true);
                                        $('#as_bttn').attr('aria-expanded',true);
                                    }
                                });
                            </script>
                        </form>
                    </div>

                </div>
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

                                      @if(empty($applicants[$i]->photo)) <!-- Should be !empty -->
                                           <img src="{{ $applicants[$i]->photo }}" alt="{{ $applicants[$i]->f_name }}" />
                                      @else
                                          <img class="_image" src="{{asset('img/member-placeholder.png')}}">
                                      @endif

                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="applicant-name">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href="{{ url('hiring_portal/user_index_show', $applicants[$i]->id) }}">{{$applicants[$i]->f_name.' '.$applicants[$i]->l_name}}</a></div>
                                    <ul class="feature-info-list">
                                        <li>
                                            <i class="fa fa-map-marker fa-lg" aria-hidden="true"></i>
                                             {{$applicants[$i]->country.', '.$applicants[$i]->city}}
                                        </li>
                                        <br />
                                         <li>
                                            
                                        </li>
                                    </ul>
                            </div>
                        </div>
                        <hr class="opening-top-date-hr" style="margin-top: 7px; margin-bottom: 7px;">
                        <div class="footer">
                            <div class="pull-left">
                                <div class="foggy-text"><b>Date registered</b>: {{ date(' M. j, Y ',strtotime($applicants[$i]->created_at)) }} </div>
                            </div>
                            <div class="pull-right">
                                <div class="foggy-text">
                                @include('hiring_portal.saved_applicants.save_applicant_bttn', ['applicants' => $applicants])
                                </div>
                            </div>
                        </div>
                        {{-- @include('hiring_portal.saved_applicants.save_applicant_bttn') --}}
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
