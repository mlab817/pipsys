<input type="date" class="form-control" id="{{ $fieldName }}" name="{{ $fieldName }}" value="{{ $value }}" aria-describedby="{{ $fieldName }}-input-validation">
@error($fieldName)
<p class="note error" id="{{ $fieldName }}-input-validation">
    {{ $message }}
</p>
@enderror
