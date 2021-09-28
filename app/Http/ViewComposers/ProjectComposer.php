<?php

namespace App\Http\ViewComposers;

use App\Models\Office;
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
use App\Models\RefRegion;
use App\Models\RefSocioEconAgenda;
use App\Models\RefSpatialCoverage;
use App\Models\RefSustainableDevtAgenda;
use App\Models\RefTier;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ProjectComposer
{
    public function compose(View $view)
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

        $this->years = $years;

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

        $view->with('menuItems',$menuItems)
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
}
