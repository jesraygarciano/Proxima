@extends('layouts.app')

@section('content')

<div class="container">
	<div class="profile-container" style="margin-top:-30px;">
		<div class="cover-container">
			<img class="d-c-img" src="{{asset('img/bg-banner.png')}}">
			<img class="on-top-img" src="{{asset('img/carousel_2.jpg')}}">
		</div>
		<div class="row">
			<div class="col-sm-2">
				<div class="user-icon">
					<div class="photo-wrapper" style="border-radius: 50%;">
			            <img src="http://localhost:8000/img/bg-img.png" class="bg-img">
			            <img class="_image" src="http://localhost:8000/storage/WIN_20180111_14_20_57_Pro_1517276058.jpg">
			        </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class=""></div>
		</div>
	</div>
</div>


@endsection
