<!-- Approved By Field -->
<div class="col-sm-12">
    {!! Form::label('approved_by', 'Approved By:') !!}
    <p>{{ $sPLStatus->approved_by }}</p>
</div>

<!-- Surat Perintah Lembur Id Field -->
<div class="col-sm-12">
    {!! Form::label('surat_perintah_lembur_id', 'Surat Perintah Lembur Id:') !!}
    <p>{{ $sPLStatus->surat_perintah_lembur_id }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $sPLStatus->status }}</p>
</div>

<!-- Message Field -->
<div class="col-sm-12">
    {!! Form::label('message', 'Message:') !!}
    <p>{{ $sPLStatus->message }}</p>
</div>

