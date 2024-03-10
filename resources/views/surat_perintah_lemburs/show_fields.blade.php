<!-- Karyawan Id Field -->
<div class="col-sm-12">
    {!! Form::label('karyawan_id', 'Karyawan:') !!}
    <p>{{ $suratPerintahLembur->karyawan->name }}</p>
</div>

{{-- status terakhir --}}
<div class="col-sm-12">
    {!! Form::label('spl_status_id', 'Status Terakhir:') !!}
    <p>{{ $suratPerintahLembur->splStatusLatest->status }}</p>
</div>

<!-- Karyawan Id Field -->
<div class="col-sm-12">
    {!! Form::label('karyawan_id', 'NIK:') !!}
    <p>{{ $suratPerintahLembur->karyawan->nik }}</p>
</div>

<!-- Mulai Field -->
<div class="col-sm-12">
    {!! Form::label('mulai', 'Mulai:') !!}
    <p>{{ $suratPerintahLembur->mulai }}</p>
</div>

<!-- Selesai Field -->
<div class="col-sm-12">
    {!! Form::label('selesai', 'Selesai:') !!}
    <p>{{ $suratPerintahLembur->selesai }}</p>
</div>

<!-- Total Jam Lembur Field -->
<div class="col-sm-12">
    {!! Form::label('total_jam_lembur', 'Total Jam Lembur:') !!}
    <p>{{ $suratPerintahLembur->total_jam_lembur }}</p>
</div>

{{-- dibuat --}}
<div class="col-sm-12">
    {!! Form::label('created_at', 'Dibuat:') !!}
    <p>{{ $suratPerintahLembur->created_at }}</p>
</div>

{{-- diubah --}}
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Diubah:') !!}
    <p>{{ $suratPerintahLembur->updated_at }}</p>
</div>

{{-- pesan status terakhir --}}
<div class="col-sm-12">
    {!! Form::label('pesan_status_terakhir', 'Pesan Status Terakhir:') !!}
    <p>{{ $suratPerintahLembur->splStatusLatest->pesan }}</p>
</div>

