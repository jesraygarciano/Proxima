@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit: {{ $company->company_name }}</h1>

    <hr/>

    @include('errors.form_errors')

    {!! Form::model($company, ['method' => 'PATCH', 'route' => ['companies.update', $company->id]]) !!}
        <div class="form-group">
            {!!Form::label('company_name', 'Company Name:')!!}
            {!!Form::text('company_name', null, ['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('email', 'Email:')!!}
            {!!Form::text('email', null, ['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('password', 'Password:')!!}
            {!!Form::text('password', null, ['class' => 'form-control'])!!}
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
            {!! Form::submit('Edit Company', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}
</div>
@endsection
