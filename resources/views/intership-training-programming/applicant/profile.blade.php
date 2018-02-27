@extends('layouts.app')

@section('content')

<style type="text/css">
    /* USER PROFILE PAGE */
 .card {
    margin-top: 20px;
    padding: 30px;
    background-color: rgba(214, 224, 226, 0.2);
    -webkit-border-top-left-radius:5px;
    -moz-border-top-left-radius:5px;
    border-top-left-radius:5px;
    -webkit-border-top-right-radius:5px;
    -moz-border-top-right-radius:5px;
    border-top-right-radius:5px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: #fff;
    background-color: rgba(255, 255, 255, 1);
}
.card.hovercard .card-background {
    height: 130px;
}
.card-background img {
    -webkit-filter: blur(25px);
    -moz-filter: blur(25px);
    -o-filter: blur(25px);
    -ms-filter: blur(25px);
    filter: blur(25px);
    margin-left: -100px;
    margin-top: -200px;
    min-width: 130%;
}
.card.hovercard .useravatar {
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
}
.card.hovercard .useravatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255, 255, 255, 0.5);
}
.card.hovercard .card-info {
    position: absolute;
    bottom: 14px;
    left: 0;
    right: 0;
}
.card.hovercard .card-info .card-title {
    padding:0 5px;
    font-size: 20px;
    line-height: 1;
    color: #262626;
    background-color: rgba(255, 255, 255, 0.1);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.card.hovercard .card-info {
    overflow: hidden;
    font-size: 12px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}
.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}
.btn-pref .btn {
    -webkit-border-radius:0 !important;
}


</style>
<div class="container">
<div class="row">
<div class="col-lg-6 col-sm-6">
    <div class="card hovercard">
        <div class="card-background">
            <img class="card-bkimg" alt="" src="https://images.unsplash.com/photo-1469386846711-1df926ac1129?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=5e89b87a69696dd6dff1e209bd80d134&auto=format&fit=crop&w=1500&q=80">
            <!-- http://lorempixel.com/850/280/people/9/ -->
        </div>
        <div class="useravatar">
            <img alt="" src="https://images.unsplash.com/photo-1469386846711-1df926ac1129?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=5e89b87a69696dd6dff1e209bd80d134&auto=format&fit=crop&w=1500&q=80">
        </div>
        <div class="card-info"> <span class="card-title">Pamela Anderson</span>

        </div>
    </div>
 
    
    </div>
<div class="col-lg-6 col-sm-6">

    <div class="single-page" class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a data-toggle="tab" href="#compinfo">
                    Schedule
                </a>
            </li>
            <li role="presentation">
                <a data-toggle="tab" href="#joblists">
                    Contact Information
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" id="compinfo" class="tab-pane active"> {{--START COMPANYINFO --}}
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Company Information</h2>
                    </div>
                </div>
                <style type="text/css">
                    .no-cover-image{
                        position: relative;
                        height: 300px;
                        background: #c8c8c8;
                        overflow: hidden;
                        border: 1px solid #cecece;
                    }

                    .no-cover-image img{
                        position: absolute;
                        top: 50%;
                        transform:translateY(-50%);
                        width: 100%;
                        left: 0px;
                    }

                    .cover-image>img{
                        width: 100%;
                    }

                    .cover-info .picture{
                        padding: 5px;
                        background: white;
                        border: 1px solid #cecece;
                        position: absolute;
                        bottom:-40px;
                        left:40px;
                    }

                    .cover-info .picture img{
                        width: 100%;
                    }

                    .cover-info{
                        position: relative;
                    }

                    .cover-info img{
                        border:none!important;
                    }

                    .under-photo{
                        margin-top: 40px;
                    }
                </style>
                <div class="row">
                    <div class="col-md-12 cover-info">
                        <div class="row">
                              <div class="no-cover-image">
                                  <img src="{{ asset('img/default-opening.jpg') }}" class="bg-img">
                              </div>
                        </div>
                        <div class="row cover-info">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-2 col-xs-4">
                                        <div class="picture">
                                            <div class="photo-wrapper">
                                                <img src="{{asset('img/bg-img.png')}}" class="bg-img">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row under-photo">
                                    <div class="col-sm-6 col-xs-12">
                                        <h1>
                                            <a href="#">
                                                Test
                                                <br>
                                            </a>
                                        </h1>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <h5>
                                            <i class="fa fa-map-marker fa-lg" aria-hidden="true"></i>
                                        </h5>
                                        <h5>
                                            <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <h3>About us:</h3>
                        <p>
                        </p>
                        <h3>Why join us?:</h3>

                        <p style="padding-top:1rem;">
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h3>Company details:</h3>
                        <ul class="company-list-info">
                            <li>
                                <div class="field-name">Email</div>
                            </li>
                            <li>
                                <div class="field-name">CEO</div>
                            </li>
                            <li>
                                <div class="field-name">Company website URL</div>
                            </li>
                            <li>
                                <div class="field-name">Company size</div>
                            </li>
                            <li>
                                <div class="field-name">Company Tel#</div>
                            </li>
                            <li>
                                <div class="field-name">Company address</div>
                            </li>
                            <li>
                                <div class="field-name">Language spoken</div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div> {{-- END COMPANY INFO --}}

            <div id="joblists" class="tab-pane fade">
                <h3>Opening Job lists</h3>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                            Test
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

</div>
</div>
    <script>
        $(document).ready(function() {
$(".btn-pref .btn").click(function () {
    $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).removeClass("btn-default").addClass("btn-primary");   
});
});
    </script>

@endsection    