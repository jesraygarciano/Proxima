@extends('layouts.app')

@section('content')

<div class="container">
    <article>
        <h3>
            <h1>Search Jobs</h1>
        </h3>
    </article>
    <hr>
    <div class="container-fluid" id="opening">
        <div class="row">
            <div class="col-md-3" id="opening-search">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>General Search:</h4>
                        <form method="GET" action="{{Request::url()}}">
                            <div class="form-group">
                                {{-- {!!Form::label('opening_search', '')!!} --}}
                                <div class="table-display">
                                  <input type="text" class="form-control cell-display no-b-radius-right" name="opening_search" value="{{$_GET['opening_search'] ?? ''}}" placeholder="Job title">
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
                                    <label for="formGroupExampleInput2">Company:</label>
                                    <input type="text" class="form-control" name="company_name" value="{{$_GET['company_name'] ?? ''}}" placeholder="Company name">
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
                                    <div class="form-group">
                                        <label>Hiring Type</label>
                                        <select class="form-control" name="hiring_type" id="hiring_type">
                                            <option value="">Select type</option>
                                            <option value="0">Internship</option>
                                            <option value="1">Regular</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Salary Range</label>
                                        {!!Form::select('salary_range', salary_ranges(), null, ['class' => 'form-control', 'id' => 'salary_range'])!!}
                                    </div>
                                </div>
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
                                    $('#hiring_type').val("{{$_GET['hiring_type'] ?? ''}}");
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

            <div class="col-md-7">
                @if (count($openings) > 0)
                    @foreach ($openings as $opening)
                        <div class="job-tile">
                            <div>
                                <ul class="ribbon_style_list">
                                @if($opening->featured_status == 1)
                                    <li class="job-position featured">Featured</li>
                                @endif
                                @if($opening->hiring_type == 0)
                                    <li class="job-position intern">Intern</li>
                                @elseif($opening->hiring_type == 1)
                                    <li class="job-position regular">Regular</li>
                                @elseif($opening->hiring_type == 2)
                                    <li class="job-position intern">Temporary</li>
                                @endif
                                </ul>
                            </div>
                            <div class="job-title">
                                <a href="{{ url('openings', $opening->id) }}" class="ellipsis padding-right-110" style="display: block;"> {{ $opening->title }} </a>
                                {{-- <img class="pull-right" src="{{ $opening->company->company_logo }}" alt="" border="0" height="100" width="130" style="max-width: 130px;"> --}}
                                <span class="contain pull-right photo-adjust" style="background-image: url('{{ $opening->company->company_logo }}')"></span>
                                {{-- <div class="clear"></div> --}}
                            </div>
                            <div class="company-name_opening_list ellipsis padding-right-110"><a href="{{ url('companies', $opening->company->id) }}"> {{$opening->company->company_name}} </a>
                            </div>
                            <ul class="opening-feature-info-list">
                                <li class="ellipsis padding-right-110"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $opening->company->address1 }}
                                </li>
                                <li class="ellipsis padding-right-110"><i class="fa fa-dollar" aria-hidden="true"></i>                                    
                                    <!-- Salary range -->
                                    {!! salary_ranges()[$opening->salary_range] !!}
                                </li>
                                <li>
                                    <i class="fa fa-code" aria-hidden="true"></i>
                                    <?php $x = 0; ?>
                                    @foreach(main_languages() as $main_language)
                                        @if($match_array = array_intersect($opening->has_skill->lists('id')->toArray(), get_language_ids($main_language)))
                                            @if($x < 3)
                                                {{-- have to take away original key from $match_array --}}
                                                <?php $match_array = array_values($match_array); ?>

                                                @for($i=0; $i < count($match_array) ; $i++)
                                                    @if($i == 0)
                                                        <a href="#!" role="button" class="btn label label-warning {{main_languages_class_convert()[$main_language]}}" data-toggle="tooltip" data-placement="bottom" data-html="true" title="
                                                        <div>{{return_category($match_array[$i])}}</div>                    
                                                    @else
                                                        <div>{{return_category($match_array[$i])}}</div> 
                                                    @endif

                                                    @if($i == count($match_array) - 1)
                                                        ">
                                                        {{$main_language}}<span class="caret"></span>
                                                    @endif
                                                    </a>
                                                @endfor
                                            @endif
                                            <?php $x++; ?>
                                        @endif
                                    @endforeach

                                    @if($x > 3)
                                        <a href="#!" role="button" onclick="display_skills('{{addslashes(json_encode($opening->load("skill_requirements")))}}',this)" class="btn label label-default">
                                            ...
                                        </a>
                                    @endif
                                </li>
                            </ul>
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

                    @include('layouts.pagination', ['paginator' => $openings->appends($_GET)])
                    {{-- {!!$openings->appends(['company_name'=>$company_name])->render()!!} --}}
                    {{-- {!! $openings->render() !!} --}}
                @endif
            </div>
            <div class="col-md-2 well">
                <h4>Advertisement</h4>
            </div>
        </div>
    </div>
</div>
@endsection
