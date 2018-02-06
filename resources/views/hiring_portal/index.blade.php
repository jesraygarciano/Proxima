@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
    <div  class= "col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row" style="height:50px;">
            <div style="font-size:28px;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                @if ($companies_show)

                    <h2 style="padding-top: 1rem; font-weight: 800;">
                    {!! link_to(action('CompaniesController@edit', $companies_show->id) , $companies_show->company_name, ['class' => '']) !!}
                    </h2>
                @endif

            </div>

        </div>
        <div class="row" style="padding-left:15px; margin-bottom:20px;">
            {{-- <button class="big ui button">
                show company info
            </button> --}}
            <a href="{{action('CompaniesController@show', $companies_show->id)}}" class="ui button big" >
                show company info
            </a>
            {{-- <button class="big ui button">
                edit company info
            </button> --}}
            <a href="{{action('CompaniesController@edit', $companies_show->id)}}" class="ui button big" >
                edit company info
            </a>
        </div>
        {{-- tab parts --}}
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#hiring_information"> Current Hiring</a></li>
            <li><a data-toggle="tab" href="#application">Application</a></li>
            <!-- <li><a data-toggle="tab" href="#company_information">Company Information</a></li> -->
        </ul>

        {{-- tab content --}}
        <div class="tab-content">

            {{-- tab - hiring information --}}
            <div id="hiring_information" class="tab-pane fade in active" style="margin-top:20px;">
                <a href="{{url('openings/create', $companies_show->id)}}" class="ui blue button massive" >Create New Hiring Information</a>
                <hr>
                <div class="row">
                @include('hiring_portal.index_parts.current_hiring')
                </div>
            </div>

            {{-- tab - application --}}
            <div id="application" class="tab-pane fade" style="margin-top:20px;">
                @include('hiring_portal.index_parts.application')
            </div>

            {{-- tab - company_information
            <div id="company_information" class="tab-pane fade" style="margin-top:20px;">
                @include('hiring_portal.index_parts.company_information')
            </div>
            --}}

        </div>
        <div class="clearfix"></div>
    </div>
    </div>
    </div>
@endsection
