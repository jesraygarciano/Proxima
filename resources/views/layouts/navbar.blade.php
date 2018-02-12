<nav id="navigation-bar" class="navbar navbar-default" style="z-index: 2;">
    <div class="container">
        <div class="navbar-header">
            <!-- スマホやタブレットで表示した時のメニューボタン -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                Menu
            </button>

            <!-- ブランド表示 -->
            <a class="navbar-brand" href="/">
                <img src="{{ asset('img/logo_brand.png') }}" />
            </a>
        </div>

        <!-- メニュー -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <!-- 左寄せメニュー -->
            <ul class="nav navbar-nav">
                <li>{!! link_to_route('companies.index', 'Companies') !!}</li>
                <li>{!! link_to_route('openings.index', 'Search Jobs') !!}</li>
            </ul>

            <!-- 右寄せメニュー -->
            <ul class="nav navbar-nav navbar-right">

                @if (Auth::guest())
                    {{-- ログインしていない時 --}}
                    <li><a href="/auth/login">Login</a></li>
                    {{-- <li><a href={{route('auth.student_view')}}>Student Register</a></li> --}}
                    <li><a href="/auth/register/student">Student Register</a></li>
                    <li><a href="/auth/register/hiring">Hiring Register</a></li>
                @else

                    {{-- ログインしている時 --}}

                    <!-- ドロップダウンメニュー -->

                    <li class="dropdown dropdown-auto-hover">
                        @if (Auth::user()->role == 1)
                           {{-- @if(Session::get('company')) --}}
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{-- {{ Session::get($company->email) }} --}}
                                {{ Auth::user()->email }}
                                <span class="caret"></span>
                            </a>
                            {{-- @endif --}}
                        @else
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->f_name }}
                                {{ Auth::user()->l_name }}
                                <span class="caret"></span>
                            </a>
                        @endif

                        <ul class="dropdown-menu dropdown-auto-hover" role="menu" style="padding: 0px 0px 11px 0px;">
                            @if (Auth::user()->role == 0)

                               @if(Session::get('lists'))

                                    <li>
                                        <a href="{{ url('resumes/show') }}">
                                           See Resume
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ url('resumes/create') }}">
                                            Create Your Resume
                                        </a>
                                    </li>

                               @endif
                                <li>
                                    <a href="{{ url('applications/applied_index') }}">
                                        Applied List
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('bookmarked/list') }}">
                                        {{ Session::get('bookmark_opening_count') }}
                                        bookmark lists
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('followed/list') }}">
                                        {{ Auth::user()->followings->count() }}
                                        Followed companies
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('scouts/company_scout') }}">
                                        Scouted notification
                                    </a>
                                </li>
                            @elseif (Auth::user()->role == 1)
                                <li>
                                    <a href="/hiring_portal">Management</a>
                                </li>
                                <li>
                                    <a href="/hiring_portal/user_index">List of Applicants</a>
                                </li>
                                <li>
                                    <a href="/saved/applicants/list">
                                        {{--{{ Session::get('save_applicants_count') }}--}}
                                        List of Saved Applicants
                                    </a>
                                </li>
                            @elseif (Auth::user()->role == 2)
                                <li>
                                    <a href="/management/users">Manage User </a>
                                </li>
                                <li>
                                    <a href="/management/companies">Manage Companies </a>
                                </li>
                                <li>
                                    <a href="/management/openings">Manage Openings </a>
                                </li>
                            @endif
                        </ul>
                    </li>

                    <!-- uelmar's inline js code -->
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('.dropdown-auto-hover').mouseover(function(){
                                if(!$(this).hasClass('open')){
                                    $(this).addClass('open')
                                }
                            });

                            $('.dropdown-auto-hover').mouseout(function(){
                                if($(this).hasClass('open')){
                                    $(this).removeClass('open')
                                }
                            });
                        });
                    </script>

                    @if(\Auth::check())
                    <li class="noti-bell" id="noti-bell">
                        <a href="{{route('user_notifications')}}?tab=scout_notifications">
                            <i class="fa fa-bell"></i>
                        </a>
                        <div class="num-icon" style="display: none;">
                            <div>1</div>
                        </div>
                        <div class="noti-lists">
                            @if(\Auth::user()->role == 1)
                            <a class="noti" href="{{route('user_notifications')}}?tab=application_nofications">
                                <span class="label label-danger applications" style="display: none;">1</span>
                                Applications
                            </a>
                            @endif
                            @if(\Auth::user()->role == 0)
                            <a class="noti" href="{{route('user_notifications')}}?tab=scout_notifications">
                                <span class="label label-danger scouts" style="display: none;">1</span>
                                Scouts
                            </a>
                            @endif
                            @if(\Auth::user()->role == 0)
                            <a class="noti" href="{{route('user_notifications')}}?tab=opening_notifications">
                                <span class="label label-danger new_openings" style="display: none;">1</span>
                                New Openings
                            </a>
                            @endif
                        </div>
                    </li>
                    @endif
                    <li><a href="/auth/logout">Logout</a></li>
                @endif
            </ul>
            @if(\Auth::check())
            <script type="text/javascript">
                fetch_notification();

                $('#noti-bell').hover(function(){
                    fetch_notification();
                });

                function fetch_notification(){
                    $.ajax({
                        url:"{{route('json_get_stat_notification')}}",
                        type:"GET",
                        data:{
                            user_id:{{\Auth::user()->id}},
                            company_id:{{\Auth::user()->companies->first()->id ?? 0}},
                        },
                        success:function(data){
                            var bell_container = $('#noti-bell');
                            var total_not = data.applications+data.scouts+data.openings;
                            bell_container.find('.applications').html(data.applications).css('display',data.applications < 1 ? 'none' : '');
                            bell_container.find('.scouts').html(data.scouts).css('display',data.scouts < 1 ? 'none' : '');
                            bell_container.find('.new_openings').html(data.openings).css('display',data.openings < 1 ? 'none' : '');
                            bell_container.find('.num-icon div').html(total_not).parent().css('display',total_not < 1 ? 'none' : '');
                        }
                    });
                }

                autoload_notification();

                function autoload_notification(){
                    setTimeout(function(){
                        fetch_notification()
                        autoload_notification();
                    },60000);
                }
            </script>
            @endif
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
