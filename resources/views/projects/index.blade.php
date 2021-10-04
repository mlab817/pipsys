@extends('layouts.header-only')

@section('page-header')
    <x-page-header
        title="Projects"
        description="Projects owned by the user and his/her office"></x-page-header>
@stop

@section('content')
    <div class="flex-shrink-0 mb-4 mb-md-0 mt-3">
        <div class="border-bottom color-border-secondary py-3">
            <div class="d-flex flex-items-start">
                <form id="filter-form" class="width-full" aria-label="PAPs" role="search" action="{{ route('projects.index') }}" accept-charset="UTF-8" method="get">
                    <div class="d-flex flex-column flex-lg-row flex-auto">
                        <div class="mb-1 mb-md-0 mr-md-3 flex-auto">
                            <input type="search" name="q" class="form-control width-full" placeholder="Find a PAP…" autocomplete="off" aria-label="Find a PAP…" value="{{ request()->query('q') }}">
                        </div>

                        <div class="d-flex flex-wrap">
                            <details class="details-reset details-overlay position-relative mt-1 mt-lg-0 ml-1" id="sort-options">
                                <summary aria-haspopup="menu" role="button" class="btn">
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
                                                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" class="octicon octicon-check SelectMenu-icon SelectMenu-icon--check">
                                                    <path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                                                </svg>
                                                <span class="text-normal" data-menu-button-text="">Last updated</span>
                                            </label>
                                            <label class="SelectMenu-item" role="menuitemradio" aria-checked="false" tabindex="0">
                                                <input type="radio" name="sort" id="sort_name" value="name" hidden="hidden" data-autosubmit="true">
                                                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" class="octicon octicon-check SelectMenu-icon SelectMenu-icon--check">
                                                    <path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                                                </svg>
                                                <span class="text-normal" data-menu-button-text="">Title</span>
                                            </label>
                                            <label class="SelectMenu-item" role="menuitemradio" aria-checked="false" tabindex="0">
                                                <input type="radio" name="sort" id="sort_stargazers" value="stargazers" hidden="hidden" data-autosubmit="true">
                                                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" class="octicon octicon-check SelectMenu-icon SelectMenu-icon--check">
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
                        <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" class="octicon octicon-repo">
                            <path fill-rule="evenodd" d="M2 2.5A2.5 2.5 0 014.5 0h8.75a.75.75 0 01.75.75v12.5a.75.75 0 01-.75.75h-2.5a.75.75 0 110-1.5h1.75v-2h-8a1 1 0 00-.714 1.7.75.75 0 01-1.072 1.05A2.495 2.495 0 012 11.5v-9zm10.5-1V9h-8c-.356 0-.694.074-1 .208V2.5a1 1 0 011-1h8zM5 12.25v3.25a.25.25 0 00.4.2l1.45-1.087a.25.25 0 01.3 0L8.6 15.7a.25.25 0 00.4-.2v-3.25a.25.25 0 00-.25-.25h-3.5a.25.25 0 00-.25.25z"></path>
                        </svg>
                        New
                    </a>
                </div>
                @endcan
            </div>
        </div>
    </div>

    @if(count($projects) > 0)
    <div class="flex-shrink-0 mb-4 mb-md-0 mt-3">
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
                            <span itemprop="programmingLanguage">PHP {{ shorten($project->total_cost, 2) }}</span>
                        </span>
                            Updated {{ $project->updated_at->diffForHumans(null, null, true) }}
                        </div>
                    </div>

                    <div class="col-2 col-lg-3 d-flex flex-column flex-justify-around">
                        <div class="text-right">
                            <div class="d-inline-block">
                                @php($starred = auth()->user()->stars()->where('project_id', $project->id)->exists())
                                <form action="{{ route('projects.update', $project) }}" accept-charset="UTF-8" method="post">
                                    @csrf
                                    @method('PUT')
                                    @if($starred)
                                        <input type="hidden" name="star" value="0">
                                        <button class="btn btn-sm " type="submit" value="Unstar" aria-label="Unstar this repository" title="Unstar mlab817/pipsys" data-ga-click="Repository, click unstar button, action:profiles/repositories#index; text:Unstar">
                                            <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" class="octicon octicon-star-fill mr-1">
                                                <path fill-rule="evenodd" d="M8 .25a.75.75 0 01.673.418l1.882 3.815 4.21.612a.75.75 0 01.416 1.279l-3.046 2.97.719 4.192a.75.75 0 01-1.088.791L8 12.347l-3.766 1.98a.75.75 0 01-1.088-.79l.72-4.194L.818 6.374a.75.75 0 01.416-1.28l4.21-.611L7.327.668A.75.75 0 018 .25z"></path>
                                            </svg>Unstar
                                        </button>
                                    @else
                                        <input type="hidden" name="star" value="1">
                                        <button class="btn btn-sm " type="submit" value="Star" aria-label="Star this repository" title="Star mlab817/pipsys" data-ga-click="Repository, click star button, action:profiles/repositories#index; text:Star">
                                            <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" class="octicon octicon-star mr-1">
                                                <path fill-rule="evenodd" d="M8 .25a.75.75 0 01.673.418l1.882 3.815 4.21.612a.75.75 0 01.416 1.279l-3.046 2.97.719 4.192a.75.75 0 01-1.088.791L8 12.347l-3.766 1.98a.75.75 0 01-1.088-.79l.72-4.194L.818 6.374a.75.75 0 01.416-1.28l4.21-.611L7.327.668A.75.75 0 018 .25zm0 2.445L6.615 5.5a.75.75 0 01-.564.41l-3.097.45 2.24 2.184a.75.75 0 01.216.664l-.528 3.084 2.769-1.456a.75.75 0 01.698 0l2.77 1.456-.53-3.084a.75.75 0 01.216-.664l2.24-2.183-3.096-.45a.75.75 0 01-.564-.41L8 2.694v.001z"></path>
                                            </svg>Star
                                        </button>
                                    @endif
                                </form>
                            </div>

                            <div class="text-right mt-2">
                                <form action="{{ route('projects.destroy', $project) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-octicon-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" class="octicon octicon-trash mr-1">
                                            <path fill-rule="evenodd" d="M6.5 1.75a.25.25 0 01.25-.25h2.5a.25.25 0 01.25.25V3h-3V1.75zm4.5 0V3h2.25a.75.75 0 010 1.5H2.75a.75.75 0 010-1.5H5V1.75C5 .784 5.784 0 6.75 0h2.5C10.216 0 11 .784 11 1.75zM4.496 6.675a.75.75 0 10-1.492.15l.66 6.6A1.75 1.75 0 005.405 15h5.19c.9 0 1.652-.681 1.741-1.576l.66-6.6a.75.75 0 00-1.492-.149l-.66 6.6a.25.25 0 01-.249.225h-5.19a.25.25 0 01-.249-.225l-.66-6.6z"></path>
                                        </svg>
                                        Delete
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

    @else
    <div class="flex-shrink-0 mb-4 mb-md-0 mt-3">
        <div class="blankslate blankslate-large">
            <img src="https://ghicons.github.com/assets/images/blue/png/Pull%20request.png" alt="" class="mb-3" />
            <h3 class="mb-1">You don’t seem to have any programs/projects.</h3>
            <a href="{{ route('projects.create') }}" class="btn btn-primary my-3">New</a>
        </div>
    </div>
    @endif
@endsection

@push('scripts')
    <script>
        function onSubmit() {
            document.getElementById('filter-form').submit();
        }
    </script>
@endpush
