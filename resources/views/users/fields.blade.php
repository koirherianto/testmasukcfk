<!-- Name Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 191, 'maxlength' => 191]) !!}
    @error('name') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

<!-- Email Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required', 'maxlength' => 191, 'maxlength' => 191]) !!}
    @error('email') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

<!-- Email Verified At Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    {!! Form::date('email_verified_at', $user->email_verified_at ?? date('Y-m-d'), ['class' => 'form-control','id'=>'email_verified_at']) !!}
    @error('email_verified_at') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#email_verified_at').datepicker()
    </script>
@endpush

<!-- password Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control', 'required', 'maxlength' => 191, 'maxlength' => 191]) !!}
    @error('password') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

<!-- Remember Token Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control', 'maxlength' => 100, 'maxlength' => 100]) !!}
    @error('remember_token') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>