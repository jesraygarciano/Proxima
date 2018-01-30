<div class="col-xs-3">
    <ul class="nav nav-tabs-ver tabs-left">
        @if (count($openings) > 0)
            @for ($i=0; $i < count($openings); $i++)
                @if ($i == 0)
                    <li class="active"><a href="#current_hiring_{{$openings[$i]->id}}" data-toggle="tab">
                        {{ $openings[$i]->title }}
                    </a></li>
                @else
                    <li><a href="#current_hiring_{{$openings[$i]->id}}" data-toggle="tab">
                        {{ $openings[$i]->title }}
                    </a></li>
                @endif
            @endfor
        @else
            <div style="font-size:14px; margin-top:20px;">
                There is no hiring information.
            </div>
        @endif
        <div style="margin-top:20px;">
            {!! link_to( url('openings/create', $companies_show->id) , 'post new openings', ['class' => 'btn btn-primary']) !!}
        </div>
        {{-- <a href="{{ url('openings', $opening->id) }}"> --}}
    </ul>
</div>
<div class="col-xs-9">
    <div class="tab-content">
        @if (count($openings) > 0)
            @for ($i=0; $i < count($openings); $i++)
                @if ($i == 0)
                    <div class="tab-pane active" id="current_hiring_{{$openings[$i]->id}}">
                        {{-- {{$openings[$i]->title}} --}}
                        @include('hiring_portal.index_parts.current_hiring_parts')
                    </div>
                @else
                    <div class="tab-pane" id="current_hiring_{{$openings[$i]->id}}">
                        {{-- {{ $openings[$i]->title }} --}}
                        @include('hiring_portal.index_parts.current_hiring_parts')
                    </div>
                @endif
            @endfor
        @endif
    </div>
</div>
<div class="clearfix"></div>
