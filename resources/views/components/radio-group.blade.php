<div class="radio-group">
    @foreach($options as $option)
        <input class="radio-input" id="{{ $fieldName }}-{{ $option->id }}" type="radio" name="{{ $fieldName }}" value="{{ $option->id }}">
        <label class="radio-label" for="{{ $fieldName }}-{{ $option->id }}">{{ $option->label }}</label>
    @endforeach
</div>
