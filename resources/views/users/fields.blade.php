<!-- Name Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 191]) !!}
    @error('name')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<!-- Email Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required', 'maxlength' => 191]) !!}
    @error('email')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<input type="hidden" name="remember_token" value="-">
<input type="hidden" name="email_verified_at" value="-">

<!-- password Field -->
<div class="form-group col-sm-6 mb-2">
    @if ($isEditPage)
        {!! Form::label('password', 'Password: ') !!}
        {!! Form::password('password', ['class' => 'form-control', '']) !!}
    @else
        {!! Form::label('password', 'Password: ') !!}
        {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
    @endif
    @error('password')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="card bg-grey bg-lighten-4 rounded-2 col-sm-12 mt-3">
    <div class="d-flex pt-1 pb-1">
        {!! Form::label('s_role_id', 'Hak Akses Diberikan', ['class' => 'col-md-3 label-control text-uppercase mb-0']) !!}
        <div class="skin skin-flat">
            @foreach ($sRoles as $item)
                <fieldset>
                    {!! Form::radio('s_role_id[]', $item->id, in_array($item->id, $roles) ? true : false, [
                        'id' => 'input-' . $item->id,
                    ]) !!}
                    <label for="input-{{ $item->id }}"
                        class="ml-1 text-bold-700 black text-uppercase">{!! $item->name !!}
                        {!! $item->desc !!}</label>
                </fieldset>
            @endforeach
        </div>
    </div>
</div>

<div class="card bg-grey bg-lighten-4 rounded-2 col-sm-12">
    <div class="d-flex pt-1 pb-1">
        {!! Form::label('s_dapartemen_id', 'Pilih Dapartemen', ['class' => 'col-md-3 label-control text-uppercase mb-0']) !!}
        <div class="skin skin-flat">
            @foreach ($dapartemens as $dapartemen)
                <fieldset>
                    {!! Form::checkbox('s_dapartemen_id[]', $dapartemen->id, in_array($dapartemen->id, $userDapartemens) ? true : false, [
                        'id' => 'input-' . $dapartemen->id,
                    ]) !!}
                    <label for="input-{{ $dapartemen->id }}"
                        class="ml-1 text-bold-700 black text-uppercase">{!! $dapartemen->name !!}
                        {!! $dapartemen->desc !!}</label>
                </fieldset>
            @endforeach
        </div>
    </div>
</div>

