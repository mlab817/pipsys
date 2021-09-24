<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Models\Office;
use App\Models\Project;
use App\Models\RefApprovalLevel;
use App\Models\RefBasis;
use App\Models\RefCipType;
use App\Models\RefOperatingUnit;
use App\Models\RefPapType;
use App\Models\RefPipTypology;
use App\Models\RefRegion;
use App\Models\RefSpatialCoverage;
use Illuminate\Http\Request;

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
        $no = new \stdClass();
        $no->id = 0;
        $no->label = 'No';
        $yes = new \stdClass();
        $yes->id = 1;
        $yes->label = 'Yes';
        $bool = collect([$yes, $no]);

        return view('projects.create')
            ->with([
                'papTypes'          => RefPapType::all(),
                'bases'             => RefBasis::all(),
                'offices'           => Office::all(),
                'operatingUnits'    => RefOperatingUnit::all(),
                'spatialCoverages'  => RefSpatialCoverage::all(),
                'regions'           => RefRegion::all(),
                'bool'              => $bool,
                'approvalLevels'    => RefApprovalLevel::all(),
                'pipTypologies'     => RefPipTypology::all(),
                'cipTypes'          => RefCipType::all(),
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
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
