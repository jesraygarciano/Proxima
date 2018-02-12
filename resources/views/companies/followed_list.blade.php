@extends('layouts.app')

@section('content')
<div class="container">
    <article>
        <h3>
            <h3>List of followed companies</h3>
        </h3>
    </article>

    <hr>

    <div class="row" id="followed-company_lists">
        <div class="col-md-12">
                @if (count($follows) > 0)
                        @foreach ($follows as $follow)
                                <div id="first-comp-list" class="col-xs-12 col-sm-6 col-md-6">
                                    @include('companies.company-container',['company'=>$follow])
                                </div>
                        @endforeach
                @endif
        </div>
    </div>
</div>
@endsection
