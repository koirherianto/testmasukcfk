<!-- {{ $fieldTitle }} Field -->
<div class="form-group col-sm-6 mb-2w">
@if($config->options->localized)
    @{!! Form::label('{{ $fieldName }}', __('models/{{ $config->modelNames->camelPlural }}.fields.{{ $fieldName }}').':') !!}
@else
    @{!! Form::label('{{ $fieldName }}', '{{ $fieldTitle }}:') !!}
@endif
    <div class="input-group">
        <div class="custom-file">
            @{!! Form::file('{{ $fieldName }}', ['class' => 'custom-file-input']) !!}
            @{!! Form::label('{{ $fieldName }}', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
    @@error('{{ $fieldName }}') @verbatim
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror @endverbatim
</div>
<div class="clearfix"></div>