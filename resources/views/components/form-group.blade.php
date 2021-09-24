<div class="my-4">
    <dl class="form-group @error($fieldName) errored @enderror">
        <dt class="form-group-header">
            <label for="{{ $fieldName }}">{{ $label }}</label>
        </dt>
        <dd class="form-group-body">
            {{ $slot }}
            @error($fieldName)
                <p class="note error">{{ $message }}</p>
            @enderror
        </dd>
    </dl>
</div>
