<div x-data="{
    value: {{ $value }},
    get formatted() {
        const value = this.value
        return Number(value).toLocaleString()
    },
    isEditing: false
}">
    <input x-ref="{{ $xRef }}" @blur="isEditing = false" x-cloak type="number" x-show="isEditing" class="form-control text-right width-full" x-model="value" id="{{ $fieldName }}" name="{{ $fieldName }}">
    <input type="text" class="form-control text-right width-full" readonly x-model="formatted" x-show="!isEditing" @click="isEditing = true; $nextTick(() => $refs.{{ $xRef }}.focus());">
</div>
