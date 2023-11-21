<!-- Nama Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control', 'required', 'maxlength' => 124, 'maxlength' => 124]) !!}
    @error('nama') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

<!-- Tanggal Lahir Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
    {!! Form::date('tanggal_lahir', $kucing->tanggal_lahir ?? date('Y-m-d'), ['class' => 'form-control','id'=>'tanggal_lahir']) !!}
    @error('tanggal_lahir') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#tanggal_lahir').datepicker()
    </script>
@endpush

<!-- Penjelasa Field -->
<div class="form-group col-sm-12 col-lg-12 mb-2">
    {!! Form::label('penjelasa', 'Penjelasa:') !!}
    {!! Form::textarea('penjelasa', null, ['class' => 'form-control', 'required', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
    @error('penjelasa') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

<!-- Is Boy Field -->
<div class="form-group col-sm-6 mb-2">
    <div class="form-check">
        {!! Form::hidden('is_boy', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_boy', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_boy', 'Is Boy', ['class' => 'form-check-label']) !!}
    </div>
    @error('is_boy') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>