@if (Auth::check()) 
    @if (Auth::user()->is_bookmarking($opening->id))
        {!! Form::open(['route' => ['openings.unbookmark_openings_index', $opening->id], 'method' => 'delete']) !!}
            <div class="row" style="display: none;">
                <div class="col-md-3">
                    {!! Form::submit('Unbookmark', ['class' => "btn btn-danger btn-block"]) !!}
                </div>
            </div>
            <a onclick="this.parentNode.submit();" style="color:#ff9a0b;">
                <i class="fa fa-bookmark" aria-hidden="true"></i> Unbookmark
            </a>
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['openings.bookmark_openings_index', $opening->id]]) !!}
            <div class="row" style="display: none;">
                <div class="col-md-3">
                    {!! Form::submit('Bookmark', ['class' => "btn btn-primary btn-block"]) !!}
                </div>
            </div>
            <a onclick="this.parentNode.submit();" style="color:#808080;">
                <i class="fa fa-bookmark" aria-hidden="true"></i> Bookmark
            </a>
        {!! Form::close() !!}
    @endif
@endif