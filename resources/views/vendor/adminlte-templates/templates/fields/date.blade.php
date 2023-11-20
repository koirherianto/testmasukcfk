<!-- {{ $fieldTitle }} Field -->
<div class="form-group col-sm-6 mb-2">
@if($config->options->localized)
    @{!! Form::label('{{ $fieldName }}', __('models/{{ $config->modelNames->camelPlural }}.fields.{{ $fieldName }}').':') !!}
@else
    @{!! Form::label('{{ $fieldName }}', '{{ $fieldTitle }}:') !!}
@endif
    @{!! Form::date('{{ $fieldName }}', ${{ $config->modelNames->camel }}->{{ $fieldName }} ?? date('Y-m-d'), ['class' => 'form-control','id'=>'{{ $fieldName }}']) !!}
    @@error('{{ $fieldName }}') @verbatim
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror @endverbatim
</div>

@@push('page_scripts')
    <script type="text/javascript">
        $('#{{ $fieldName }}').datepicker()
    </script>
@@endpush