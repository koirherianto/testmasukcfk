<!-- {{ $fieldTitle }} Field -->
<div class="form-group col-sm-6">
@if($config->options->localized)
    @{!! Form::date('{{ $fieldName }}', __('models/{{ $config->modelNames->camelPlural }}.fields.{{ $fieldName }}').':') !!}
@else
    @{!! Form::date('{{ $fieldName }}', '{{ $fieldTitle }}:') !!}
@endif
    @{!! Form::date('{{ $fieldName }}', ${{ $config->modelNames->camelPlural }}->fieldName ?? date('Y-m-d'), ['class' => 'form-control','id'=>'{{ $fieldName }}']) !!}
</div>

@@push('page_scripts')
    <script type="text/javascript">
        $('#{{ $fieldName }}').datepicker()
    </script>
@@endpush