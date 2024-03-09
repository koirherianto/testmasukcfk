<!-- Dapartement Id Field -->
<div class="col-sm-12">
    {!! Form::label('dapartement_id', 'Dapartement') !!}
    <p>{{ $karyawan->dapartement->name }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $karyawan->name }}</p>
</div>

<!-- Nik Field -->
<div class="col-sm-12">
    {!! Form::label('nik', 'Nik:') !!}
    <p>{{ $karyawan->nik }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $karyawan->created_at->format('d F Y') }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $karyawan->updated_at->format('d F Y') }}</p>
</div>

