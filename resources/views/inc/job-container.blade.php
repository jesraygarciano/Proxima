<style>
    ul.content-list{
    /**/
    }

    .content-list>li{
      position:relative;
      padding-left: 0px !important;
    }

    .content-list>li>div>.fa-file-text{
      position:absolute;
      left:6px;
      top:4.3px;
      font-size: 10px;
    }

    .content-list>li>div>.fa-map-marker{
      position:absolute;
      left:6.5px;
      top:4.3px;
      font-size: 12px;
    }

    .content-list>li>div>.fa-dollar{
      position:absolute;
      left:6.8px;
      top:4.2px;
      font-size: 12px;
    }

    .content-list>li>div>.fa-code{
      position:absolute;
      left:3.5px;
      top:4px;
      font-size: 12px;
    }

    .content-list>li>.li-content{
      display: inline-block;
    }

    .content-list>li>.i-wrapper{
      position: relative;
      height: 20px;
      width: 20px;
      border-radius: 10px;
      left: 5px;
      background-color: rgb(31, 89, 149);
      color: white;
    }

    .content-list>li>.text-wrapper{
      position: absolute;
      top:-1px;
      left:30px;
      width: 400px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      /*height:30px;*/
    }
</style>
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
    @if (Auth::guest())
        @if(\Auth::user() ? \Auth::user()->canEdit($opening) : false)
            <a href="{{url('openings/edit').'/?opening_id='.$opening->id}}" class="edit-bttn"><i class="fa fa-2x fa-edit"></i></a>
        @endif
    @endif
    <div class="job-title">
        <a href="{{ url('openings', $opening->id) }}" class="ellipsis padding-right-110" style="display: block;"> {{ $opening->title }} </a>

        {{-- <img class="pull-right" src="{{ $opening->company->company_logo }}" alt="" border="0" height="100" width="130" style="max-width: 130px;"> --}}
        <span class="contain pull-right photo-adjust" style="background-image: url('{{ $opening->company->company_logo }}')"></span>
        {{-- <div class="clear"></div> --}}
    </div>
    <div class="company-name_opening_list ellipsis padding-right-110"><a href="{{ url('companies', $opening->company->id) }}"> {{$opening->company->company_name}} &nbsp; </a>
    </div>
    <ul class="opening-feature-info-list content-list">
        <li class="ellipsis padding-right-110">
            <div class="li-content i-wrapper">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="li-content text-wrapper">

                {{$opening->address1}},
                {{$opening->address2}},
                @foreach($provinces as $province)
                    {{$province->iso_code === $opening->province_code ? $province->name : ''}}
                @endforeach
                {{$opening->postal}}

            </div>
        </li>
        <li class="ellipsis padding-right-110">
            <div class="li-content i-wrapper">
                <i class="fa fa-file-text" aria-hidden="true"></i>
            </div>
            <div class="li-content text-wrapper">
                {{ $opening->details }}
            </div>
        </li>
        <li class="ellipsis padding-right-110">
            <div class="li-content i-wrapper">
                <i class="fa fa-dollar" aria-hidden="true"></i>
            </div>
            <!-- Salary range -->
            <div class="li-content text-wrapper">
                {!! salary_ranges()[$opening->salary_range] !!}
            </div>
        </li>
        <li>
            <div class="li-content i-wrapper">
                <i class="fa fa-code" aria-hidden="true"></i>
            </div>
            <div class="li-content text-wrapper">
                <?php $x = 0; ?>
                @foreach(main_languages() as $main_language)
                    @if($match_array = array_intersect($opening->has_skill->lists('id')->toArray(), get_language_ids($main_language)))
                        @if($x < 4)
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
                @if($x > 4)
                    <a href="#!" role="button" onclick="display_skills('{{addslashes(json_encode($opening->load("skill_requirements")))}}',this)" class="btn label label-default">
                        ...
                    </a>
                @endif
            </div>
        </li>
    </ul>
    <hr class="opening-top-date-hr" style="margin-top: 7px; margin-bottom: 7px;">
    <div class="footer">
        <div class="pull-left">

                <div class="foggy-text">
                    Registed date:
                    <b>{{ date(' M. j, Y ',strtotime($opening->created_at)) }} </b>
                </div>

        @if (!Auth::guest())
                @if(\Auth::user()->canEdit($opening))
                    <div class="foggy-text">
                        Starting date: <!-- date("Y-m-d H:i:s")  -->
                        <b>{{ date(' M. j, Y h:i A',strtotime($opening->from_post)) }} </b>
                    </div>

                    <div class="foggy-text">
                        Post expire date:
                        <b>{{ date(' M. j, Y h:i A',strtotime($opening->until_post)) }} </b>
                    </div>
                @endif
        @endif

        </div>
            <div class="pull-right">
                <div class="foggy-text">
                    @if (Auth::check() && (!Auth::user()->role == 1))
                            @include('openings.opening_bookmark.bookmark_button', ['opening' => $opening])
                    @endif

                    @if (!Auth::guest())
                        @if(\Auth::user()->canEdit($opening))
                            @if (($opening->from_post < date('Y-m-d\TH:i')) && (date('Y-m-d\TH:i') < $opening->until_post))
                                <div class="job-desc-active" style="background:green;">
                                    <i class="fa fa-check"></i>
                                    Active
                                </div>
                            @elseif ($opening->from_post > date('Y-m-d\TH:i'))
                                <div class="job-desc-active" style="background:#eaba10;">
                                    <i class="fa fa fa-plus"></i>
                                    Not yet active
                                </div>
                            @elseif (date('Y-m-d\TH:i') > $opening->until_post)
                                <div class="job-desc-active" style="background:red;">
                                    <i class="fa fa-times"></i>
                                    Expired
                                </div>
                            @endif
                        @endif
                    @endif

                        {{--<div style="background:red;padding:1rem;color:#fff;border-radius: 5px;">
                        <i class="fa fa-minus"></i>
                        Not active
                        </div> --}}
                </div>
            </div>


    </div>
</div>
