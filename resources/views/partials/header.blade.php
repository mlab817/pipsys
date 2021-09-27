<div class="Header">
    <div class="Header-item">
        <a href="#" class="Header-link f4 d-flex flex-items-center">
            <!-- <%= octicon "mark-github", class: "mr-2", height: 32 %> -->
            <svg height="32" class="octicon octicon-mark-github mr-2" viewBox="0 0 16 16" version="1.1" width="32" aria-hidden="true"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path></svg>
            <span>{{ config('app.name') }}</span>
        </a>
    </div>
    <div class="Header-item">
        <div class="position-relative">
            <x-auto-complete-projects></x-auto-complete-projects>
        </div>
    </div>
    <div class="Header-item Header-item--full">

    </div>
    <div class="Header-item position-relative d-none d-md-flex">
        <details class="details-overlay details-reset">
            <summary class="Header-link" aria-label="Create new…" aria-haspopup="menu" role="button">
                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" class="octicon octicon-plus">
                    <path fill-rule="evenodd" d="M7.75 2a.75.75 0 01.75.75V7h4.25a.75.75 0 110 1.5H8.5v4.25a.75.75 0 11-1.5 0V8.5H2.75a.75.75 0 010-1.5H7V2.75A.75.75 0 017.75 2z"></path>
                </svg> <span class="dropdown-caret"></span>
            </summary>
            <details-menu class="dropdown-menu dropdown-menu-sw" role="menu">
                <a role="menuitem" class="dropdown-item" href="{{ route('projects.create') }}">
                    New project
                </a>
            </details-menu>
        </details>

    </div>
    <div class="Header-item mr-0">
        <div class="position-relative">
            <details class="dropdown details-reset details-overlay d-inline-block">
                <summary aria-haspopup="true">
                    <img class="avatar" height="30" alt="@octocat" src="https://github.com/octocat.png" width="30">
                </summary>

                <div class="dropdown-menu dropdown-menu-sw">
                    <div class="dropdown-header">
                        Dropdown header
                    </div>
                    <ul>
                        <li><a class="dropdown-item" href="#url">Dropdown item</a></li>
                        <li><a class="dropdown-item" href="#url">Dropdown item</a></li>
                        <li class="dropdown-divider" role="separator"></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="document.getElementById('logout-form').submit()">Logout</a></li>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                        </form>
                    </ul>
                </div>
            </details>
        </div>
    </div>
</div>
