<div class="Subhead Subhead--spacious" id="{{ $id }}">
    <div class="Subhead-heading">{{ $subhead }}</div>
    <div class="Subhead-actions">
        {{ $slot }}
    </div>
    @if($description)
        <div class="Subhead-description">{{ $description }}</div>
    @endif
</div>
