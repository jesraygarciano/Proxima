<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Hiring Register</div>
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

          <form class="form-horizontal" role="form" method="POST" action="/auth/register/hiring">
            {{-- CSRF対策--}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
{{-- 
            <div class="form-group">
                {!! Form::label('f_name', 'First Name', ['class' => 'col-md-4 control-label']) !!}
                <div class = "col-md-6">
                  {!! Form::text('f_name', old('f_name'), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('l_name', 'Last Name', ['class' => 'col-md-4 control-label']) !!}
                <div class = "col-md-6">
                  {!! Form::text('l_name', old('l_name'), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('m_name', 'Middle Name', ['class' => 'col-md-4 control-label']) !!}
                <div class = "col-md-6">
                  {!! Form::text('m_name', old('m_name'), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('birth_date', 'Birth Date', ['class' => 'col-md-4 control-label']) !!}
                <div class = "col-md-6">
                  {!! Form::date('birth_date', old('birth_date'), ['class' => 'form-control']) !!}
                </div>
            </div> --}}

            <div class="form-group">
                {!! Form::label('email', 'E-Mail Address', ['class' => 'col-md-4 control-label']) !!}
                <div class = "col-md-6">
                  {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) !!}
                <div class = "col-md-6">
                  {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-md-4 control-label']) !!}
                <div class = "col-md-6">
                  {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
            </div>

            {!! Form::hidden('role', '1') !!}

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Register
                </button>
              </div>
            </div>
          </form>
        </div><!-- .panel-body -->
      </div><!-- .panel -->
    </div><!-- .col -->
  </div><!-- .row -->
</div><!-- .container-fluid -->
