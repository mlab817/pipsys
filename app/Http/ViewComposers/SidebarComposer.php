<?php

namespace App\Http\ViewComposers;

use App\Models\Project;
use Illuminate\View\View;

class SidebarComposer
{
    public function compose(View $view)
    {
        $view->with('projects', Project::with('creator')->take(5)->get());
    }
}
