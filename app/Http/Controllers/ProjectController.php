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

        $year = 2016;
        $years = collect();

        while ($year <= 2030) {
            $newYear = new \stdClass();
            $newYear->id = $year;
            $newYear->label = $year;
            $years->add($newYear);
            $year++;
        }




        $menuItems = [
            '#general-information'      => 'General Information',
            '#implementing-agency'      => 'Implementing Agency',
            '#spatial-coverage'         => 'Spatial Coverage',
            '#approval-level'           => 'Approval Level',
            '#programming-document'     => 'Program/Project for Inclusion in Which Programming Document',
            '#physical-financial-status'=> 'Physical & Financial Status',
            '#implementation-period'    => 'Implementation Period',
            '#pdp-indicators'           => 'Main PDP Chapter Outcome Statements/Outputs',
        ];

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
                'covidInterventions'=> RefCovidType::all(),
                'projectStatuses'   => RefProjectStatus::all(),
                'menuItems'         => $menuItems,
                'years'             => $years,
                'pdpChapters'       => RefPdpChapter::orderBy('name')->get(),
                'pdpIndicators'     => RefPdpIndicator::where('level',1)->orderBy('name')->get(),
                'socioEconAgenda'   => RefSocioEconAgenda::all(),
                'sdgs'              => RefSustainableDevtAgenda::all(),
                'prepDocuments'     => RefPrepDocument::all(),
                'fsStatus'          => ProjectFs::FS_STATUS,
                'fundSources'       => RefFundSource::all(),
                'implementationModes' => RefImplementationMode::all(),
                'fundingInstitutions' => RefFundingInstitution::all(),
                'tiers'             => RefTier::all(),
                'infraSectors'      => RefInfraSector::with('infra_subsectors')->get(),
                'prerequisites'     => RefPrerequisite::all(),
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
        $project = Project::create($request->validated());

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
        return view('projects.show', compact('project'));
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
