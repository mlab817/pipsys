<select class="form-select" aria-label="{{ $fieldName }}" id="{{ $fieldName }}" name="{{ $fieldName }}" aria-describedby="{{ $fieldName }}-input-validation">
    <option>Choose an option</option>
    @foreach($options as $option)
        <option value="{{ $option->id }}" @if($selected == $option->id) selected @endif>{{ $option->label }}</option>
    @endforeach
</select>
@error($fieldName)
<p class="note error" id="{{ $fieldName }}-input-validation">
    {{ $message }}
</p>
@enderror
