  <div class="media well" style="padding-bottom: 45px; position:relative; background: white; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 3px 0 rgba(0,0,0,0.12)!important; border:1px solid #dddddd;">
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
              {{ $company['population'] }}
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
      </div> <!-- media body -->
      <img class="d-flex ml-3" style="border-radius: 4px; background: #ccc; border:1px solid #ccc;" src="{{ $company->company_logo }}" alt="{{ $company->company_name}}" alt="{{ $company->company_name}}" height="110px;" width="110px;" />
    <div style="position: absolute; padding:0px 15px; width: 100%; left: 0px; bottom: 0px;">
      <hr style="margin:0px;">
      <div class="pull-right" style="margin:10px 0px; cursor: pointer;">
        @include('companies.follow_company.follow_button', ['company' => $company])                                            
      </div>
    </div>
  </div>