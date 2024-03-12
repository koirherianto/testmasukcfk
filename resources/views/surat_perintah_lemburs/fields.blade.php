<!-- Karyawan Id Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('karyawan_id', 'Nama:') !!}
    {!! Form::select('karyawan_id', $karyawans , $karyawanUser->id ?? $choisKaryawanId ?? null, ['class' => 'form-control', 'required']) !!}
    @error('karyawan_id') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

<!-- Mulai Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('mulai', 'Mulai:') !!}
    {!! Form::datetimeLocal('mulai', $suratPerintahLembur->mulai ?? now()->format('Y-m-d\TH:i:s'), ['class' => 'form-control','id'=>'mulai']) !!}
    @error('mulai') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#mulai').datetimepicker();
    </script>
@endpush

<!-- Selesai Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('selesai', 'Selesai:') !!}
    {!! Form::datetimeLocal('selesai', $suratPerintahLembur->selesai ?? now()->format('Y-m-d\TH:i:s'), ['class' => 'form-control','id'=>'selesai']) !!}
    @error('selesai') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#selesai').datetimepicker(); // Sesuaikan ini dengan plugin datetime picker yang Anda gunakan
    </script>
@endpush

<!-- Total Jam Lembur Field -->
{{-- <div class="form-group col-sm-6 mb-2">
    {!! Form::label('total_jam_lembur', 'Total Jam Lembur:') !!}
    {!! Form::time('total_jam_lembur', null, ['class' => 'form-control', 'required']) !!}
    @error('total_jam_lembur') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div> --}}

<input type="hidden" name="total_jam_lembur" value="-">

<div class="form-group col-sm-12 col-lg-12 mb-2">
    {!! Form::label('alasan', 'Alasan:') !!}
    {!! Form::textarea('alasan', null, ['class' => 'form-control', 'maxlength' => 65535]) !!}
    @error('alasan') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>
