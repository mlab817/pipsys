<div>
    <input type="text"
           class="form-control"
           id="{{ $fieldName }}"
           name="{{ $fieldName }}"
           value="{{ $value }}"
           aria-describedby="{{ $inputValidation }}">
    @error($fieldName)
        <p class="note error" id="{{ $inputValidation }}">
            {{ $message }}
        </p>
    @enderror
</div>
