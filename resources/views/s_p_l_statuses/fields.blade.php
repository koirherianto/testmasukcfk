<!-- Approved By Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('approved_by', 'Approved By:') !!}
    {!! Form::number('approved_by', null, ['class' => 'form-control', 'required']) !!}
    @error('approved_by') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

<!-- Surat Perintah Lembur Id Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('surat_perintah_lembur_id', 'Surat Perintah Lembur Id:') !!}
    {!! Form::number('surat_perintah_lembur_id', null, ['class' => 'form-control', 'required']) !!}
    @error('surat_perintah_lembur_id') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

<!-- Status Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control', 'required']) !!}
    @error('status') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

<!-- Message Field -->
<div class="form-group col-sm-12 col-lg-12 mb-2">
    {!! Form::label('message', 'Message:') !!}
    {!! Form::textarea('message', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
    @error('message') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>