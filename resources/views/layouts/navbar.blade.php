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

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->f_name }}
                            {{ Auth::user()->l_name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-auto-hover" role="menu">
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
                                    <a href="/hiring_portal/user_index">List of Applicants</a>
                                </li>
                                <li>
                                    <a href="/saved/applicants/list">
                                        {{ Session::get('save_applicants_count') }}
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

                    <li><a href="/auth/logout">Logout</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
