<div class="form-checkbox">
    <label aria-live="polite">
        <input type="radio" class="form-checkbox-details-trigger" name="{{ $fieldName }}" value="{{ $value }}" />
        {{ $label }}
        <span class="form-checkbox-details text-normal">
            {{ $slot }}
        </span>
    </label>
</div>
