@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
    <div  class= "col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row" style="height:80px;">
            <div style="font-size:28px; margin-bottom:10px;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                @if ($companies_show)
                    {{ $companies_show->company_name }}
                @endif
            </div>
            <div style="margin-bottom:0px;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div style="">
                    @if (count($companies) > 0)
                        {!!Form::open(['action' => 'HiringPortalController@show'])!!}
                        {{-- {!! Form::open(['url' => 'hiring_portal/show', 'method' => 'get']) !!} --}}
                            <br>
                            <select name="company_id" style="width:200px;height:30px;float:right;margin-top:-20px;">
                                @for ($i=0; $i < count($companies); $i++)
                                    <option value="{{$companies[$i]->id}}">{{$companies[$i]->company_name}}</option>
                                @endfor
                            </select>
                            <br>
                            <br>
                            <div  style="width:200px;height:30px;float:right;">
                              <div class="">
                                <button type="submit" class="btn btn-primary" style="width:200px;height:30px;float:right;margin-top:-20px;">
                                  Change Company
                                </button>
                              </div>
                            </div>
                        {!!Form::close()!!}
                    @endif
                </div>
            </div>
        </div>
        {{-- tab parts --}}
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#hiring_information"> Current Hiring</a></li>
            <li><a data-toggle="tab" href="#application">Application</a></li>
            <li><a data-toggle="tab" href="#company_information">Company Information</a></li>
        </ul>

        {{-- tab content --}}
        <div class="tab-content">

            {{-- tab - hiring information --}}
            <div id="hiring_information" class="tab-pane fade in active" style="margin-top:20px;">
                @include('hiring_portal.index_parts.current_hiring')
            </div>

            {{-- tab - application --}}
            <div id="application" class="tab-pane fade" style="margin-top:20px;">
                @include('hiring_portal.index_parts.application')
            </div>

            {{-- tab - company_information --}}
            <div id="company_information" class="tab-pane fade" style="margin-top:20px;">
                @include('hiring_portal.index_parts.company_information')
            </div>

        </div>
        <div class="clearfix"></div>
    </div>
    </div>
    </div>
@endsection
