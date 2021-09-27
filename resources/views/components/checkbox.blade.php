<div class="form-checkbox">
    <label for="{{ $fieldName }}-{{ $value }}">
        <input
            name="{{ $fieldName }}"
            id="{{ $fieldName }}-{{ $value }}"
            value="{{ $value }}"
            type="{{ $type }}"
            aria-describedby="{{ $fieldName }}-{{ $value }}-help-text"
            @if($checked) checked @endif
            >
            {{ $label }}
    </label>
    @if($description)
    <p class="note" id="{{ $fieldName }}-{{ $value }}-help-text">
        {{ $description }}
    </p>
    @endif
</div>
