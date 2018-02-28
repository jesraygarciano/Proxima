@extends('layouts.app')

@section('content')
<div class="container">
    <div class="single-page" class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a data-toggle="tab" href="#compinfo">
                    Company Information
                </a>
            </li>
            <li role="presentation">
                <a data-toggle="tab" href="#joblists">
                    Opening Job lists
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" id="compinfo" class="tab-pane active"> {{--START COMPANYINFO --}}
                @include('companies.company-single')
            </div> {{-- END COMPANY INFO --}}

            <div id="joblists" class="tab-pane fade">
                <h3>Opening Job lists</h3>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                {{ count($openings) ? ' ' : 'No other current hiring.'}}
                                @if (count($openings) > 0)
                                    @foreach ($openings as $opening)
                                        <div class="col-md-6">
                                            @include('inc.job-container',['opening'=>$opening])
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 well">
                            <h4>Advertisement</h4>
                        </div>
                    </div>
                </div> {{-- END OF ROW --}}
            </div>
        </div>
    </div>
</div>
@endsection
