@extends('layouts.app')

@section('content')
<div class="container">
    <article>
        <h3>
            <h3>List of followed companies</h3>
        </h3>
    </article>

    <hr>

    <div class="row" id="followed-company_lists">
        <div class="col-md-12">
                @if (count($follows) > 0)
                        @foreach ($follows as $follow)
                                <div id="first-comp-list" class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="media well">
                                      <div class="media-body">
                                        <h3 class="mt-0 mb-1">
                                            <a href="{{ url('companies', $follow['id']) }}">
                                                {{ $follow['company_name'] }}
                                                <br>
                                                {{-- {{ dd($follow)}} --}}
                                            </a>
                                        </h3>
                                        <ul>
                                          <li>
                                              <i class="fa fa-map-marker fa-lg" aria-hidden="true"></i>
                                              {{ $follow['city'] }},
                                              {{ $follow['country'] }}
                                          </li>
                                          <li>
                                              <i class="fa fa-users fa-lg" aria-hidden="true"></i>
                                              {{ $follow['number_of_employee'] }} <b>Employees</b>
                                          </li>
                                          <li>
                                              <i class="fa fa-laptop fa-lg" aria-hidden="true"></i>
                                              <a href="{{ $follow['url'] }}">{{ $follow['url'] }}</a>
                                          </li>
                                          <li>
                                              <i class="fa fa-language fa-lg" aria-hidden="true"></i>
                                              {{ $follow['bill_country'] }}
                                          </li>
                                          <li>
                                              <i class="fa fa-file-o fa-lg" aria-hidden="true"></i>
                                                  <a href="{{ url('companies', $follow['id']) }}">
                                                    {{ $follow->openings->count() }} Current hiring
                                                  </a>
                                          </li>
                                          <li>
                                              <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
                                                Latest job posted:
                                                {{ $follow['updated_at'] }}
                                          </li> 
                                        </ul>
                                      <div id="company-bookmark">
                                        <div class="d-flex align-self-end ml-3">
<!--                                             <a href="">
                                              <i class="fa fa-star-o fa-lg" aria-hidden="true"></i>
                                              Follow
                                            </a> -->                                         
                                        </div>
                                      </div>
                                      </div> <!-- media body -->
                                      <img class="d-flex ml-3" src="/storage/{{ $follow->company_logo }}" alt="{{ $follow->company_name}}" alt="{{ $follow->company_name}}" height="150px;" width="150px;" />
                                    </div>
                                </div>
                        @endforeach
                @endif
        </div>
    </div>
</div>
@endsection
