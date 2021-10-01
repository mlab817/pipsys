<?php

namespace Database\Factories;

use App\Models\Office;
use App\Models\Project;
use App\Models\ProjectDisbursement;
use App\Models\ProjectFs;
use App\Models\ProjectGaa;
use App\Models\ProjectNep;
use App\Models\ProjectOutput;
use App\Models\ProjectResettlement;
use App\Models\ProjectRisk;
use App\Models\ProjectRowa;
use App\Models\ProjectUpdate;
use App\Models\RefApprovalLevel;
use App\Models\RefBasis;
use App\Models\RefCipType;
use App\Models\RefCovidType;
use App\Models\RefFundingInstitution;
use App\Models\RefFundSource;
use App\Models\RefGad;
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
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $year = $this->faker->year;
        return [
            'title' => $this->faker->sentence,
            'ref_pap_type_id' => RefPapType::all()->random()->id,
            'total_cost' => $this->faker->randomFloat(4, 1000000, 99999999999),
            'office_id' => Office::all()->random()->id,
            'ref_spatial_coverage_id' => RefSpatialCoverage::all()->random()->id,
            'iccable' => $this->faker->boolean,
            'ref_approval_level_id' => RefApprovalLevel::all()->random()->id,
            'approval_date' => $this->faker->date,
            'pip' => $this->faker->boolean,
            'ref_pip_typology_id' => RefPipTypology::all()->random()->id,
            'cip' => $this->faker->boolean,
            'ref_cip_type_id' => RefCipType::all()->random()->id,
            'trip' => $this->faker->boolean,
            'rdip' => $this->faker->boolean,
            'rdc_endorsement_required' => $this->faker->boolean,
            'rdc_endorsed' => $this->faker->boolean,
            'rdc_endorsed_date' => $this->faker->date,
            'research' => $this->faker->boolean,
            'ifp' => $this->faker->boolean,
            'ict' => $this->faker->boolean,
            'covid' => $this->faker->boolean,
            'ref_project_status_id' => RefProjectStatus::all()->random()->id,
//            'project_update' => ProjectUpdate::factory(),
            'icc_resubmission' => $this->faker->boolean,
            'target_start_year' => (int) $year,
            'target_end_year' => (int) $year + 6,
            'ref_pdp_chapter_id' => RefPdpChapter::all()->random()->id,
            'no_pdp_indicator' => $this->faker->boolean,
//            'expected_outputs' => ProjectOutput::factory(),


            'ref_prep_document_id' => RefPrepDocument::all()->random()->id,
            'has_fs' => $this->faker->boolean,
//            'fs' => ProjectFs::factory(),
            'has_row' => $this->faker->boolean,
//            'rowa' => ProjectRowa::factory(),
            'has_rap' => $this->faker->boolean,
//            'rap' => ProjectResettlement::factory(),
            'has_row_rap' => $this->faker->boolean,
            'employment_generated' => $this->faker->randomDigit(),
            'ref_fund_source_id' => RefFundSource::all()->random()->id,
            'ref_funding_institution_id' => RefFundingInstitution::all()->random()->id,
            'ref_implementation_mode_id' => RefImplementationMode::all()->random()->id,
            'other_mode' => $this->faker->sentence,
//            'fs_investments' => ,
//            'region_investments' => ,
            'financial_accomp_na' => $this->faker->boolean,
            'pap_code' => $this->faker->isbn10(),
            'ref_tier_id' => RefTier::all()->random()->id,
            'uacs_code' => $this->faker->isbn10(),
            'ref_gad_id' => RefGad::all()->random()->id,
//            'nep' => ProjectNep::factory(),
//            'gaa' => ProjectGaa::factory(),
//            'disbursement' => ProjectDisbursement::factory(),


//            'risk' => ProjectRisk::factory(),
//            'fs_infrastructures' => ,
            'description' => $this->faker->paragraph,
        ];
    }

    /*

     */
}
