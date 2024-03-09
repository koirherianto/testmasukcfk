<!-- Dapartement Id Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('dapartement_id', 'Dapartement:') !!}
    {!! Form::select('dapartement_id', $dapartemens, null, ['class' => 'form-control', 'required']) !!}
    @error('dapartement_id') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

<!-- Name Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 100]) !!}
    @error('name') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

<!-- Nik Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('nik', 'NIK:') !!}
    {!! Form::text('nik', null, ['class' => 'form-control', 'required', 'maxlength' => 45]) !!}
    @error('nik') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>