@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Login</div>
        <div class="panel-body">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form class="form-horizontal" role="form" method="POST" action="/auth/login">
            {{-- CSRF対策--}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label class="col-md-4 control-label">E-Mail Address</label>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Password</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember"> Remember Me
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                  Login
                </button>

                <a href="/password/email">Forgot Your Password?</a>
              </div>
            </div>
            <div class="col-md-6 col-md-offset-4">
              <hr>
              <a href="#" style="display: block;">
                <div class="input-group" style="border: 1px solid #cecece; width: 100%; padding: 5px; border-left: 6px solid #0b5390;">
                  <i class="fa fa-3x fa-facebook-square" style="color:#326087; vertical-align: middle;"></i> Login Using Facebook
                </div>
              </a>
              <a href="#" style="display: block; color: black;">
                <div class="input-group" style="margin-top:5px; border: 1px solid #cecece; width: 100%; padding: 5px; border-left: 6px solid #5e5e5e;">
                  <i class="fa fa-3x fa-github-square" style="color:#000000; vertical-align: middle;"></i> Login Using Github
                </div>
              </a>
            </div>
          </form>
        </div><!-- .panel-body -->
      </div><!-- .panel -->
    </div><!-- .col -->
  </div><!-- .row -->
</div><!-- .container-fluid -->
@endsection
