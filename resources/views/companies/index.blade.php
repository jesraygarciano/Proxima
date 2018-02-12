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
                                @include('companies.company-container')
                            </div>
                        @endforeach
                     <center>@include('layouts.pagination',['paginator'=>$companies])</center>
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

