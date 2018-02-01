@extends('layouts.app')

@section('content')

<div class="container">
            <div id="compinfo"> {{--START COMPANYINFO --}}
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
            </style>
            <div class="row text-center">
                <div class="col-md-12 cover-info">
                    <div class="cover-image">
                        <img src="{{ $company->company_logo }}" alt="{{ $company->company_name}}" />
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
                                        &nbsp; {{ $company->city }}, {{ $company->country }}
                                    </h5>
                                    <h5>
                                        <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
                                        &nbsp; {{ $company->created_at }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-8">
                    <h3>About us:</h3>
                    {{ $company->what }}
                </div>
                <div class="col-md-4">
                    <h3>Company details:</h3>
                    <ul class="company-list-info">
                        <li>
                            <div class="field-name">Email</div>
                            <div class="field-value">{{ $company->email }}</div>
                        </li>
                        <li>
                            <div class="field-name">CEO</div>
                            <div class="field-value">{{ $company->ceo_name }}</div>
                        </li>
                        <li>
                            <div class="field-name">COO</div>
                            <div class="field-value">{{ $company->in_charge }}</div>
                        </li>
                        <li>
                            <div class="field-name">Address(s)</div>
                            <div class="field-value">{{ $company->address1 }}</div>
                            <div class="field-value">{{ $company->address2 }}</div>
                        </li>
                        <li>
                            <div class="field-name">City</div>
                            <div class="field-value">{{ $company->city }}</div>
                        </li>
                        <li>
                            <div class="field-name">Country</div>
                            <div class="field-value">{{ $company->country }}</div>
                        </li>
                        <li>
                            <div class="field-name">Website</div>
                            <div class="field-value">{{ $company->url }}</div>
                        </li>
                        <li>
                            <div class="field-name">Contact</div>
                            <div class="field-value">{{ $company->tel }} (Tel)</div>
                        </li>
                        <li>
                            <div class="field-name">Employees</div>
                            <div class="field-value">{{ $company->number_of_employee }}</div>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="container text-center" style="padding-top:3rem;height:500px;width:100%;">
                    {!! Mapper::render() !!}
            </div>

            {{--@if (!Auth::guest())
                @if (Auth::user()->role == 1)
                    @if (in_array(Auth::user()->id, $companies_ids))
                        <br/>
                        {!! link_to(action('CompaniesController@edit', [$company->id]), '編集', ['class' => 'btn btn-primary']) !!}
                        <br/>
                        {!! Form::open(['method' => 'DELETE', 'url' => ['companies', $company->id]]) !!}
                        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endif
                @endif
            @endif
            --}}

        </div> {{-- END COMPANY INFO --}}
</div>
@endsection