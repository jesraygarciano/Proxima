@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Write a New Companies</h1>

    <hr/>

    @include('errors.form_errors')

    {!!Form::open(['route' => 'companies.store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
        <div class="form-group">
            {!!Form::label('company_name', 'Company Name:')!!}
            {!!Form::text('company_name', null, ['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('email', 'Email:')!!}
            {!!Form::text('email', null, ['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('url', 'URL:')!!}
            {!!Form::url('url', 'http://', ['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('tel', 'Tel:')!!}
            {!!Form::text('tel', null, ['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('company_logo','Company Logo','') !!}
            {!! Form::file('company_logo', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!!Form::submit('Register Company', ['class' => 'btn btn-primary form-control'])!!}
        </div>
    {!!Form::close()!!}
</div>

@endsection
