<!-- Name Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
    @error('name') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>

<!-- Guard Name Field -->
<div class="form-group col-sm-6 mb-2">
    {!! Form::label('guard_name', 'Guard Name:') !!}
    {!! Form::text('guard_name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
    @error('guard_name') 
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror 
</div>


<div class="form-group row">
    {!! Form::label('s_permission_id', 'Permission',['class' => 'col-md-3 label-control']) !!}
    <div class="col-md-9">
        <div class="row skin skin-flat">
            @foreach($sPermissions as $item)
                <div class="col-md-6">
                    <fieldset>
                        {!! Form::checkbox('permission_id[]', $item->id, in_array($item->id, $permissions)?true:false,['id'=>'input-'.$item->id]) !!}
                        <label for="input-{{$item->id}}">{!! $item->name !!}</label>
                    </fieldset>
                </div>
            @endforeach
        </div>
    </div>
</div>