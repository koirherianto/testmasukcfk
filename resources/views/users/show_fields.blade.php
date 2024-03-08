<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Email Verified At Field -->
<div class="col-sm-12">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    <p>{{ $user->email_verified_at }}</p>
</div>

{{-- dapartement --}}
<div class="col-sm-12">
    {!! Form::label('dapartements', 'Dapartements:') !!}
    <p>
        @foreach($user->dapartemens as $dapartemen)
            <span class="badge bg-primary p-2">{{ $dapartemen->name }}</span>
        @endforeach
    </p>
</div>

<!-- Roles Field -->
<div class="col-sm-12">
    {!! Form::label('roles', 'Roles:') !!}
    <p>
        @foreach($user->getRoleNames() as $role)
            <span class="badge bg-primary p-2">{{ $role }}</span>
        @endforeach
    </p>
</div>
