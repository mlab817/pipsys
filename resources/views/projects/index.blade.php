@extends('layouts.header-only')

@section('page-header')
    <x-page-header title="Projects"></x-page-header>
@stop

@section('content')
    <div class="flex-shrink-0 mb-4 mb-md-0 mt-3">
        <div class="border-bottom color-border-secondary py-3">
            <div class="d-flex flex-items-start">
                <form id="filter-form" class="width-full" aria-label="PAPs" role="search" action="{{ route('projects.index') }}" accept-charset="UTF-8" method="get">
                    <div class="d-flex flex-column flex-lg-row flex-auto">
                        <div class="mb-1 mb-md-0 mr-md-3 flex-auto">
                            <input type="search" id="your-repos-filter" name="q" class="form-control width-full" placeholder="Find a PAP…" autocomplete="off" aria-label="Find a PAP…" value="{{ request()->query('q') }}">
                        </div>

                        <div class="d-flex flex-wrap">
                            <details class="details-reset details-overlay position-relative mt-1 mt-lg-0 ml-1" id="sort-options">
                                <summary aria-haspopup="menu" role="button" data-view-component="true" class="btn">
                                    <span>Sort</span>
                                    <span class="dropdown-caret"></span>
                                </summary>
                                <details-menu class="SelectMenu right-lg-0" role="menu">
                                    <div class="SelectMenu-modal">
                                        <header class="SelectMenu-header">
                                            <span class="SelectMenu-title">Select order</span>
                                        </header>
                                        <div class="SelectMenu-list">
                                            <label class="SelectMenu-item" role="menuitemradio" aria-checked="true" tabindex="0">
                                                <input type="radio" name="sort" id="sort_" value="" hidden="hidden" data-autosubmit="true" checked="checked">
                                                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-check SelectMenu-icon SelectMenu-icon--check">
                                                    <path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                                                </svg>
                                                <span class="text-normal" data-menu-button-text="">Last updated</span>
                                            </label>
                                            <label class="SelectMenu-item" role="menuitemradio" aria-checked="false" tabindex="0">
                                                <input type="radio" name="sort" id="sort_name" value="name" hidden="hidden" data-autosubmit="true">
                                                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-check SelectMenu-icon SelectMenu-icon--check">
                                                    <path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                                                </svg>
                                                <span class="text-normal" data-menu-button-text="">Title</span>
                                            </label>
                                            <label class="SelectMenu-item" role="menuitemradio" aria-checked="false" tabindex="0">
                                                <input type="radio" name="sort" id="sort_stargazers" value="stargazers" hidden="hidden" data-autosubmit="true">
                                                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-check SelectMenu-icon SelectMenu-icon--check">
                                                    <path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                                                </svg>
                                                <span class="text-normal" data-menu-button-text="">Stars</span>
                                            </label>
                                        </div>
                                    </div>
                                </details-menu>
                            </details>
                        </div>
                    </div>
                </form>
                @can('create', \App\Models\Project::class)
                <div class="d-none d-md-flex flex-md-items-center flex-md-justify-end">
                    <a href="{{ route('projects.create') }}" class="text-center btn btn-primary ml-3">
                        <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-repo">
                            <path fill-rule="evenodd" d="M2 2.5A2.5 2.5 0 014.5 0h8.75a.75.75 0 01.75.75v12.5a.75.75 0 01-.75.75h-2.5a.75.75 0 110-1.5h1.75v-2h-8a1 1 0 00-.714 1.7.75.75 0 01-1.072 1.05A2.495 2.495 0 012 11.5v-9zm10.5-1V9h-8c-.356 0-.694.074-1 .208V2.5a1 1 0 011-1h8zM5 12.25v3.25a.25.25 0 00.4.2l1.45-1.087a.25.25 0 01.3 0L8.6 15.7a.25.25 0 00.4-.2v-3.25a.25.25 0 00-.25-.25h-3.5a.25.25 0 00-.25.25z"></path>
                        </svg>
                        New
                    </a>
                </div>
                @endcan
            </div>
        </div>

        <ul>
            @foreach($projects as $project)
            <li class="col-12 d-flex width-full py-4 border-bottom color-border-secondary">
                <div class="col-10 col-lg-9 d-inline-block">
                    <div class="d-inline-block mb-1">
                        <h3 class="wb-break-all">
                            <a href="{{ route('projects.show', $project) }}" class="btn-link">
                                {!! highlight_search($project->title, request()->query('q') ?? '') !!}
                            </a>
                            <span class="Label Label--secondary v-align-middle ml-1 mb-1">
                                {{ $project->pap_type->name }}
                            </span>
                        </h3>
                        <div class="f6 color-text-secondary mb-1">
                            {{ $project->description->description }}
                        </div>
                    </div>
                    <div class="f6 color-text-secondary mt-2">
                        <span class="ml-0 mr-3">
                            <span class="repo-language-color" style="background-color: #4F5D95"></span>
                            <span itemprop="programmingLanguage">PHP</span>
                        </span>
                        Updated <relative-time datetime="2021-09-23T05:27:07Z" class="no-wrap" title="Sep 23, 2021, 1:27 PM GMT+8">1 hour ago</relative-time>
                    </div>
                </div>
                <div class="col-2 col-lg-3 d-flex flex-column flex-justify-around">
                    <div class="text-right">
                        <div class="d-inline-block js-social-container js-form-toggle-container">
                            <form class="js-social-form js-form-toggle-target" hidden="hidden" action="/mlab817/pipsys/unstar" accept-charset="UTF-8" method="post"><input type="hidden" name="authenticity_token" value="4Xob1EBXZV2mVrc/j4Vju3VzD3ZibJdiug1FtGlc9VUCRUtCHm07ENWw0bHmDVQiXaRt7sqV0CmF9/F4GULMLw==">
                                <input type="hidden" name="context" value="user_stars">
                                <button class="btn btn-sm " type="submit" value="Unstar" aria-label="Unstar this repository" title="Unstar mlab817/pipsys" data-ga-click="Repository, click unstar button, action:profiles/repositories#index; text:Unstar">
                                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-star-fill mr-1">
                                        <path fill-rule="evenodd" d="M8 .25a.75.75 0 01.673.418l1.882 3.815 4.21.612a.75.75 0 01.416 1.279l-3.046 2.97.719 4.192a.75.75 0 01-1.088.791L8 12.347l-3.766 1.98a.75.75 0 01-1.088-.79l.72-4.194L.818 6.374a.75.75 0 01.416-1.28l4.21-.611L7.327.668A.75.75 0 018 .25z"></path>
                                    </svg>Unstar
                                </button>
                            </form>
                            <form class="js-social-form js-form-toggle-target" action="/mlab817/pipsys/star" accept-charset="UTF-8" method="post"><input type="hidden" name="authenticity_token" value="ZMltwIkldppVx8OLQuT+j2DqFFcc9rgEDIRhvcu9rIG6Zzp8CTs+2QKcLNFFz6Tbf0rTCAUsxxrx0VSgTtfBUQ==">
                                <input type="hidden" name="context" value="user_stars">
                                <button class="btn btn-sm " type="submit" value="Star" aria-label="Star this repository" title="Star mlab817/pipsys" data-ga-click="Repository, click star button, action:profiles/repositories#index; text:Star">
                                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-star mr-1">
                                        <path fill-rule="evenodd" d="M8 .25a.75.75 0 01.673.418l1.882 3.815 4.21.612a.75.75 0 01.416 1.279l-3.046 2.97.719 4.192a.75.75 0 01-1.088.791L8 12.347l-3.766 1.98a.75.75 0 01-1.088-.79l.72-4.194L.818 6.374a.75.75 0 01.416-1.28l4.21-.611L7.327.668A.75.75 0 018 .25zm0 2.445L6.615 5.5a.75.75 0 01-.564.41l-3.097.45 2.24 2.184a.75.75 0 01.216.664l-.528 3.084 2.769-1.456a.75.75 0 01.698 0l2.77 1.456-.53-3.084a.75.75 0 01.216-.664l2.24-2.183-3.096-.45a.75.75 0 01-.564-.41L8 2.694v.001z"></path>
                                    </svg>Star
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="my-4">
        {{ $projects->appends(request()->query())->links() }}
    </div>
@endsection

@push('scripts')
    <script>
        function onSubmit() {
            document.getElementById('filter-form').submit();
        }
    </script>
@endpush
