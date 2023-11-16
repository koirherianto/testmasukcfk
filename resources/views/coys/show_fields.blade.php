<!-- Nama Field -->
<div class="col-sm-12">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{{ $coy->nama }}</p>
</div>

<!-- Tanggal Lahir Field -->
<div class="col-sm-12">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
    <p>{{ $coy->tanggal_lahir }}</p>
</div>

<!-- Tinggi Field -->
<div class="col-sm-12">
    {!! Form::label('tinggi', 'Tinggi:') !!}
    <p>{{ $coy->tinggi }}</p>
</div>

<!-- Penjelasan Field -->
<div class="col-sm-12">
    {!! Form::label('penjelasan', 'Penjelasan:') !!}
    <p>{{ $coy->penjelasan }}</p>
</div>

