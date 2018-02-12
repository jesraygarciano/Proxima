@if (Auth::check()) 
    <a class="follow_company_bttn" data-id="{{$company->id}}" style="color:{{Auth::user()->is_following($company->id) ? '#ff9a0b' : ''}};">
        <i class="fa fa-star fa-lg" aria-hidden="true"></i> <span class="_text">{{Auth::user()->is_following($company->id) ? 'Unfollow' : 'Follow'}}</span>
    </a>
@endif