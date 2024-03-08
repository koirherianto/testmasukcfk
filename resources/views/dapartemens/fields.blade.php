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

<!-- Detail Field -->
<div class="form-group col-sm-12 col-lg-12 mb-2">
    {!! Form::label('detail', 'Penjelasan:') !!}
    {!! Form::textarea('detail', null, ['class' => 'form-control', 'maxlength' => 65535]) !!}
    @error('detail') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>