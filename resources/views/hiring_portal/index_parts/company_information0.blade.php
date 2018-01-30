<div style ="margin-top:20px;" >
    <form class="form-horizontal" role="form" method="POST" action="/auth/register/hiring">
      {{-- CSRF対策--}}
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group">
          {!! Form::label('company_name', 'Company Name', ['class' => 'col-md-3 control-label']) !!}
          <div class = "col-md-7">
            {!! Form::text('company_name', old('company_name'), ['class' => 'form-control', 'placeholder'=>$companies[$i]->company_name]) !!}
          </div>
      </div>

      <div class="form-group">
          {!! Form::label('ceo_name', 'CEO', ['class' => 'col-md-3 control-label']) !!}
          <div class = "col-md-7">
            {!! Form::text('ceo_name', old('ceo_name'), ['class' => 'form-control', 'placeholder'=>$companies[$i]->ceo_name]) !!}
          </div>
      </div>

      <div class="form-group">
          {!! Form::label('established_at', 'Established', ['class' => 'col-md-3 control-label']) !!}
          <div class = "col-md-7">
            {!! Form::date('established_at', old('established_at'), ['class' => 'form-control', 'placeholder'=>$companies[$i]->established_at, 'onfocus' => "(this.type='established_at')", 'onblur' => "(this.type='established_at')"]) !!}
          </div>
      </div>

{{--       <div class="form-group">
          {!! Form::label('company_logo', 'Company Logo', ['class' => 'col-md-3 control-label']) !!}
          <div class = "col-md-7">
            {!! Form::file('company_logo', old('company_logo'), ['class' => 'form-control', 'placeholder'=>$companies[$i]->company_logo, 'onfocus' => "(this.type='company_logo')", 'onblur' => "(this.type='company_logo')"]) !!}
          </div>
      </div>
 --}}
      <div class="form-group">
          {!! Form::label('number_of_employee', 'Employee', ['class' => 'col-md-3 control-label']) !!}
          <div class = "col-md-7">
            {!! Form::text('number_of_employee', old('number_of_employee'), ['class' => 'form-control', 'placeholder'=>$companies[$i]->number_of_employee]) !!}
          </div>
      </div>

      <div class="form-group">
          {!! Form::label('email', 'E-Mail Address', ['class' => 'col-md-3 control-label']) !!}
          <div class = "col-md-7">
            {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder'=>$companies[$i]->email]) !!}
          </div>
      </div>

      <div class="form-group">
          {!! Form::label('postal', 'Post Code', ['class' => 'col-md-3 control-label']) !!}
          <div class = "col-md-7">
            {!! Form::text('postal', old('postal'), ['class' => 'form-control', 'placeholder'=>$companies[$i]->postal]) !!}
          </div>
      </div>

      <div class="form-group">
          {!! Form::label('address1', 'Address1', ['class' => 'col-md-3 control-label']) !!}
          <div class = "col-md-7">
            {!! Form::text('address1', old('address1'), ['class' => 'form-control', 'placeholder'=>$companies[$i]->address1]) !!}
          </div>
      </div>

      <div class="form-group">
          {!! Form::label('address2', 'Address2', ['class' => 'col-md-3 control-label']) !!}
          <div class = "col-md-7">
            {!! Form::text('address2', old('address2'), ['class' => 'form-control', 'placeholder'=>$companies[$i]->address2]) !!}
          </div>
      </div>

      <div class="form-group">
          {!! Form::label('city', 'City', ['class' => 'col-md-3 control-label']) !!}
          <div class = "col-md-7">
            {!! Form::text('city', old('city'), ['class' => 'form-control', 'placeholder'=>$companies[$i]->city]) !!}
          </div>
      </div>

      <div class="form-group">
          {!! Form::label('country', 'Country', ['class' => 'col-md-3 control-label']) !!}
          <div class = "col-md-7">
            {!! Form::text('country', old('country'), ['class' => 'form-control', 'placeholder'=>$companies[$i]->country]) !!}
          </div>
      </div>

      <div class="form-group">
          {!! Form::label('password', 'Password', ['class' => 'col-md-3 control-label']) !!}
          <div class = "col-md-7">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder'=>$companies[$i]->password]) !!}
          </div>
      </div>

      <div class="form-group">
          {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-md-3 control-label']) !!}
          <div class = "col-md-7">
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
          </div>
      </div>

      {!! Form::hidden('role', '0') !!}

      <div class="form-group">
        <div class="col-md-7 col-md-offset-4">
          <button type="submit" class="btn btn-primary">
            Register
          </button>
        </div>
      </div>
    </form>
</div>
