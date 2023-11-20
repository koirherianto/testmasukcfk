    <label class="form-check mb-2 mb-2">
        @{!! Form::radio('{{ $fieldName }}', "{{ $value }}", null, ['class' => 'form-check-input']) !!} {{ $label }}
    </label>