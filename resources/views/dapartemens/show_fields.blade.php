<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $dapartemen->name }}</p>
</div>

<!-- Detail Field -->
<div class="col-sm-12">
    {!! Form::label('detail', 'Detail:') !!}
    <p>{{ $dapartemen->detail }}</p>
</div>

{{-- created at --}}
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $dapartemen->created_at->format('d F Y')}}</p>
</div>

{{-- updated at --}}
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $dapartemen->updated_at->format('d F Y')}}</p>
</div>

