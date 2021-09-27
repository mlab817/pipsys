<select class="form-select" aria-label="{{ $fieldName }}" id="{{ $fieldName }}" name="{{ $fieldName }}">
    <option>Choose an option</option>
    @foreach($options as $option)
        <option value="{{ $option->id }}" @if($selected == $option->id) selected @endif>{{ $option->label }}</option>
    @endforeach
</select>
