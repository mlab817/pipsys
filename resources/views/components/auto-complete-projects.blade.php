@php
    $rnd = rand();
@endphp
<auto-complete src="{{ route('api.projects.search') }}" for="projects-popup-{{$rnd}}">
    <input type="text" class="form-control input-contrast input-block" id="filter-projects" placeholder="Find a PAP…" aria-label="Find a PAP…" autocomplete="off">
    <ul id="projects-popup-{{$rnd}}" class="autocomplete-results"></ul>
</auto-complete>
