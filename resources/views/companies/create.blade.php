@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Write a New Companies</h1>

    <hr/>

    @include('errors.form_errors')


    {!!Form::open(['route' => 'companies.store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
        <div class="row">
            <div class="form-group">
                {!!Form::label('company_name', 'Company Name')!!}
                {!!Form::text('company_name', null, ['class' => 'form-control'])!!}
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                {!!Form::label('email', 'Email')!!}
                {!!Form::text('email', null, ['class' => 'form-control'])!!}
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                {!!Form::label('tel', 'Tel')!!}
                {!!Form::text('tel', null, ['class' => 'form-control'])!!}
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                {!! Form::label('company_logo','Company Logo')!!}
                <div class="crop-control" style="height: 200px; width: 200px;">
                  <div class="image-container">
                    <img src="https://grangeprint.com/image/cache/placeholder-750x750-nofill-255255255.png">
                    <label for="company_logo" class="input-trigger hover-div">
                      <p>
                        <i class="fa fa-file-image-o fa-5x" aria-hidden="true"></i>
                        <br>
                        Upload
                      </p>
                    </label>
                  </div>
                  <div class="input-container">
                    <input type="file" id="company_logo" name="company_logo" accept="image/*" />
                  </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                {!!Form::submit('Register Company', ['class' => 'btn btn-primary'])!!}
            </div>
        </div>
    {!!Form::close()!!}

</div>

@endsection
