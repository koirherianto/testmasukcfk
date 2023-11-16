<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control', 'required', 'maxlength' => 124, 'maxlength' => 124]) !!}
</div>

<!-- Tanggal Lahir Field -->
<div class="form-group col-sm-6">
    {!! Form::date('tanggal_lahir', 'Tanggal Lahir:') !!}
    {!! Form::date('tanggal_lahir', $kucings->fieldName ?? date('Y-m-d'), ['class' => 'form-control','id'=>'tanggal_lahir']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#tanggal_lahir').datepicker()
    </script>
@endpush

<!-- Penjelasa Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('penjelasa', 'Penjelasa:') !!}
    {!! Form::textarea('penjelasa', null, ['class' => 'form-control', 'required', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Is Boy Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_boy', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_boy', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_boy', 'Is Boy', ['class' => 'form-check-label']) !!}
    </div>
</div>