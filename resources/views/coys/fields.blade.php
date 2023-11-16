<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control', 'required', 'maxlength' => 11, 'maxlength' => 11]) !!}
</div>

<!-- Tanggal Lahir Field -->
<div class="form-group col-sm-6">
    {!! Form::date('tanggal_lahir', 'Tanggal Lahir:') !!}
    {!! Form::date('tanggal_lahir', $coys->fieldName ?? date('Y-m-d'), ['class' => 'form-control','id'=>'tanggal_lahir']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#tanggal_lahir').datepicker()
    </script>
@endpush

<!-- Tinggi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tinggi', 'Tinggi:') !!}
    {!! Form::number('tinggi', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Penjelasan Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('penjelasan', 'Penjelasan:') !!}
    {!! Form::textarea('penjelasan', null, ['class' => 'form-control', 'required', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>