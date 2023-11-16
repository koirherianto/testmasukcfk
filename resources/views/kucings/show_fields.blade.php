<!-- Nama Field -->
<div class="col-sm-12">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{{ $kucing->nama }}</p>
</div>

<!-- Tanggal Lahir Field -->
<div class="col-sm-12">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
    <p>{{ $kucing->tanggal_lahir }}</p>
</div>

<!-- Penjelasa Field -->
<div class="col-sm-12">
    {!! Form::label('penjelasa', 'Penjelasa:') !!}
    <p>{{ $kucing->penjelasa }}</p>
</div>

<!-- Is Boy Field -->
<div class="col-sm-12">
    {!! Form::label('is_boy', 'Is Boy:') !!}
    <p>{{ $kucing->is_boy }}</p>
</div>

