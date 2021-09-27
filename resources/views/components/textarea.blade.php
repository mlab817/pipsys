<div>
    <textarea name="{{ $fieldName }}" id="{{ $fieldName }}" class="form-control" style="resize: none;">{{ $value }}</textarea>
    @if($note)
        <p class="note">{{ $note }}</p>
    @endif
</div>
