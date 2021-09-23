@php
    $user = auth()->user();
@endphp

<div class="color-bg-canvas" style="min-height: calc(100vh - 64px);">
    <div class="top-0 px-3 px-md-4 px-lg-5 overflow-auto">
        <div class="border-bottom color-border-secondary py-3 mt-3 mb-4">
            <div class="no-underline btn-link color-text-primary text-bold width-full">
                <a href="{{ route('users.show', $user) }}" class="btn-link no-underline">
                    <img src="{{ $user->getAvatar() }}" alt="{{ '@' . $user->username }}" size="20" height="20" width="20" class="avatar-user avatar avatar-small">
                    <span class="css-truncate css-truncate-target ml-1">{{ $user->username }}</span>
                </a>
            </div>
        </div>

        <div class="mb-3">
            <h2 class="f4 hide-sm hide-md mb-1 f5 d-flex flex-justify-between flex-items-center">
                Programs/Projects
                <a class="btn btn-sm btn-primary" href="/new">
                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-repo">
                        <path fill-rule="evenodd" d="M2 2.5A2.5 2.5 0 014.5 0h8.75a.75.75 0 01.75.75v12.5a.75.75 0 01-.75.75h-2.5a.75.75 0 110-1.5h1.75v-2h-8a1 1 0 00-.714 1.7.75.75 0 01-1.072 1.05A2.495 2.495 0 012 11.5v-9zm10.5-1V9h-8c-.356 0-.694.074-1 .208V2.5a1 1 0 011-1h8zM5 12.25v3.25a.25.25 0 00.4.2l1.45-1.087a.25.25 0 01.3 0L8.6 15.7a.25.25 0 00.4-.2v-3.25a.25.25 0 00-.25-.25h-3.5a.25.25 0 00-.25.25z"></path>
                    </svg>
                    New
                </a>
            </h2>
            <div class="mt-2 mb-3 position-relative" role="search" aria-label="Projects">
                <input type="text" class="form-control input-contrast input-block" id="filter-projects" placeholder="Filter PAPs…" aria-label="Filter PAPs…" autocomplete="off">
            </div>
            <ul class="list-style-none">
                <!-- TODO: list of projects of the user -->
                <li>
                    <div class="width-full text-bold"></div>
                </li>
            </ul>
        </div>
    </div>
</div>
