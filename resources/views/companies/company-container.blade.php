  <div class="media well" style="padding-bottom: 45px; position:relative; background: white; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 3px 0 rgba(0,0,0,0.12)!important; border:1px solid #dddddd;">
      <div class="media-body">
        <h3 class="mt-0 mb-1">
            <a href="{{ url('companies', $company['id']) }}">
                {{ $company->company_name }}
                <br>
                {{-- {{ dd($company)}} --}}
            </a>
        </h3>

        <style media="screen">
          .content-list>li{
            position:relative;
          }

          .content-list>li>div>.fa-map-marker{
            position:absolute;
            left:8px;
            top:4.5px;
            font-size: 15px;
          }

          .content-list>li>div>.fa-users{
            position:absolute;
            left:5px;
            top:5.5px;
            font-size: 14px;
          }

          .content-list>li>div>.fa-laptop{
            position:absolute;
            left:5px;
            top:5.5px;
            font-size: 14px;
          }

          .content-list>li>div>.fa-file-o{
            position:absolute;
            left:6.5px;
            top:5.5px;
            font-size: 14px;
          }

          .content-list>li>div>.fa-calendar{
            position:absolute;
            left:6px;
            top:4.5px;
            font-size: 14px;
          }

          .content-list>li>.li-content{
            display: inline-block;
          }

          .content-list>li>.i-wrapper{
            position: relative;
            height: 25px;
            width: 25px;
            border-radius: 12.5px;
            background-color: rgb(31, 89, 149);
            color: white;
          }

          .content-list>li>.text-wrapper{
            position: absolute;
            top:1px;
            left:35px;
            /*height:30px;*/
          }

        </style>
        <ul style="padding-left:15px;" class="content-list">
          <li>
              <div class="li-content i-wrapper">
                <i class="fa fa-map-marker" aria-hidden="true" style=""></i>
              </div>
              <div class="li-content text-wrapper">
                {{ $company->city }},
                {{ $company->country }}
              </div>
          </li>
          <li>
              <div class="li-content i-wrapper">
                <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <div class="li-content text-wrapper">
                {{ $company->population }}
              </div>
          </li>
          <li>
              <div class="li-content i-wrapper">
                <i class="fa fa-laptop" aria-hidden="true"></i>
              </div>
              <div class="li-content text-wrapper">
                <a href="{{ $company->url }}">{{ $company->url }}</a>
              </div>
          </li>
          <li>
              <div class="li-content i-wrapper">
                <i class="fa fa-file-o" aria-hidden="true"></i>
              </div>
              <div class="li-content text-wrapper">
                  <a href="{{ url('companies', $company->id) }}">
                    {{ $company->openings->count() }} Current hiring
                  </a>
              </div>
          </li>
          <li>
              <div class="li-content i-wrapper">
                <i class="fa fa-calendar" aria-hidden="true"></i>
              </div>
              <div class="li-content text-wrapper">
                Latest job posted:
                {{ $company->updated_at }}
              </div>
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
