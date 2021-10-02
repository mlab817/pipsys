<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projectsQuery = auth()->user()->projects();

        if ($q = $request->q) {
            $projectsQuery->where('title','like','%' . $q . '%');
        }

        $response = null;

        if (! $projects = $projectsQuery->get()) {
            return '<li role="option" class="autocomplete-item" data-autocomplete-value="">No results found</li>';
        }

        foreach ($projects as $project) {
            $response .= '<li role="option" class="autocomplete-item" data-autocomplete-value="">'. $project->title .'</li>';
        }

        return $response;
    }
}
