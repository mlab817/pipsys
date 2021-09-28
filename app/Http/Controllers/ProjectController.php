<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Models\Office;
use App\Models\Project;
use App\Models\ProjectFs;
use App\Models\RefApprovalLevel;
use App\Models\RefBasis;
use App\Models\RefCipType;
use App\Models\RefCovidType;
use App\Models\RefFundingInstitution;
use App\Models\RefFundSource;
use App\Models\RefImplementationMode;
use App\Models\RefInfraSector;
use App\Models\RefOperatingUnit;
use App\Models\RefPapType;
use App\Models\RefPdpChapter;
use App\Models\RefPdpIndicator;
use App\Models\RefPipTypology;
use App\Models\RefPrepDocument;
use App\Models\RefPrerequisite;
use App\Models\RefProjectStatus;
use App\Models\RefReadiness;
use App\Models\RefRegion;
use App\Models\RefSocioEconAgenda;
use App\Models\RefSpatialCoverage;
use App\Models\RefSustainableDevtAgenda;
use App\Models\RefTier;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = trim($request->q);

        $projects = Project::search($q)->paginate();

        return view('projects.index', compact('projects'))
            ->with([
                'sortOptions' => [
                    'title'         => 'Title',
                    'updated_at'    => 'Last Updated'
                ],
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project;

        return view('projects.create')
            ->with([
                'project'           => $project,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStoreRequest $request)
    {
        $project = (new ProjectService)->create($request->validated());

        return redirect()->route('projects.index')
            ->with([
                'status'    => 'success',
                'message'   => 'A new project has been created. You may view it <a href='. route('projects.show', $project) .' class=\"btn-link\">here</a>'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.create', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.create', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
