@if (Auth::check()) 
    @if (Auth::user()->is_following($company->id))
        {!! Form::open(['route' => ['companies.unfollow_companies_index', $company->id], 'method' => 'delete']) !!}
            <div class="row" style="display: none;">
                <div class="col-md-3">
                    {!! Form::submit('Follow', ['class' => "btn btn-primary btn-block"]) !!}
                </div>
            </div>
            <a onclick="this.parentNode.submit();" style="color:red;">
                <i class="fa fa-star-o fa-lg" aria-hidden="true"></i> Unfollow
            </a>
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['companies.follow_companies_index', $company->id]]) !!}
            <div class="row" style="display: none;">
                <div class="col-md-3">
                    {!! Form::submit('Unfollow', ['class' => "btn btn-danger btn-block"]) !!}
                </div>
            </div>
            <a onclick="this.parentNode.submit();">
                <i class="fa fa-star-o fa-lg" aria-hidden="true"></i> Follow
            </a>            
        {!! Form::close() !!}
    @endif
@endif