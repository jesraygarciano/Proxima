@if (Auth::check())
    <a class="bookmark_opening_bttn" data-id="{{$opening->id}}" style="color:{{Auth::user()->is_bookmarking($opening->id) ? '#ff9a0b' : '#808080'}};">
        <i class="fa fa-bookmark" aria-hidden="true"></i> <span class="_text">{{Auth::user()->is_bookmarking($opening->id) ? 'Unbookmark' : 'Bookmark'}} (<b>{{$opening->bookmark_count()}}</b>)</span>
    </a>
@endif