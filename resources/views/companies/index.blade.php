@extends('layouts.app')

@section('content')
<div class="container">
  <div id="company-list">
      <h2 class="text-center">Company list</h2>
      <hr>
      <div id="company-search">
          <div class="row">
            <div class="col-md-10">

                    {!!Form::open(['action' => 'CompaniesController@index', 'method' => 'GET', 'class' => 'form-wrapper cf' , 'role' => 'search']) !!}
                          {{-- {!!Form::label('opening_search', '')!!} --}}
                          {{ csrf_field() }}
                          {!!Form::text('company_name', old('company_name'), ['class' => 'form-control', 'placeholder' => 'Search companies'])!!}
                            <button type="submit">Search</button>

                          <label class="checkbox-inline">
                            {!!Form::checkbox('w_hiring_info', 2, null)!!}
                            <h5 style="padding-top: 7px; color: #1e7ba5;">With hiring information</h5>
                          </label>

                    {!!Form::close()!!}

            </div>
          </div> <!-- End company search Row -->
      </div> <!-- End company-search -->

      <div id="company-single-lists">
          <div class="row">
              <div class="col-md-10">
                    {{ count($companies) ? ' ' : 'Sorry, No company result.'}}
                  <div class="row">
                         @if (count($companies) > 0)
                              @foreach ($companies as $company)
                                 <div id="first-comp-list" class="col-xs-12 col-sm-6 col-md-6">
                                      <div class="media well">
                                        <div class="media-body">
                                          <h3 class="mt-0 mb-1">
                                              <a href="{{ url('companies', $company['id']) }}">
                                                  {{ $company['company_name'] }}
                                                  <br>
                                                  {{-- {{ dd($company)}} --}}
                                              </a>
                                          </h3>
                                          <ul>
                                            <li>
                                                <i class="fa fa-map-marker fa-lg" aria-hidden="true"></i>
                                                {{ $company['city'] }},
                                                {{ $company['country'] }}
                                            </li>
                                            <li>
                                                <i class="fa fa-users fa-lg" aria-hidden="true"></i>
                                                {{ $company['number_of_employee'] }}Employees
                                            </li>
                                            <li>
                                                <i class="fa fa-laptop fa-lg" aria-hidden="true"></i>
                                                <a href="{{ $company['url'] }}">{{ $company['url'] }}</a>
                                            </li>
                                            <li>
                                                <i class="fa fa-language fa-lg" aria-hidden="true"></i>
                                                {{ $company['bill_country'] }}
                                            </li>
                                            <li>
                                                <i class="fa fa-file-o fa-lg" aria-hidden="true"></i>
                                                    <a href="{{ url('companies', $company['id']) }}">
                                                      {{ $company->openings->count() }} Current hiring
                                                    </a>
                                            </li>
                                            <li>
                                                <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
                                                  Latest job posted:
                                                  {{ $company['updated_at'] }}
                                            </li> 
                                          </ul>
                                        <div id="company-bookmark">
                                          <div class="d-flex align-self-end ml-3" style="transform:translateY(15px);">
                                            @include('companies.follow_company.follow_button', ['company' => $company])                                            
                                          </div>
                                        </div>

                                        </div> <!-- media body -->
                                        <img class="d-flex ml-3" src="{{ $company->company_logo }}" alt="{{ $company->company_name}}" alt="{{ $company->company_name}}" height="150px;" width="150px;" />
                                      </div>
                                  </div>
                                      @endforeach
                                   {!! $companies->render() !!}
                                  @endif
                         </div>
              </div>

              <div id="comp-advertisement" class="col-md-2">
                  <div class="well text-center">
                    <h4>Advertisement</h4>
                  </div>
              </div>
          </div>
      </div>

  <script type="text/javascript">
      $(document).ready(function() {
      $('.js-example-placeholder-multiple').select2(
      );
  });
  </script>
  </div>
</div>

@endsection

