<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\RefApprovalLevel;
use App\Models\RefBasis;
use App\Models\RefCipType;
use App\Models\RefCovidType;
use App\Models\RefFundingInstitution;
use App\Models\RefFundSource;
use App\Models\RefGad;
use App\Models\RefImplementationMode;
use App\Models\RefInfraSector;
use App\Models\RefInfraSubsector;
use App\Models\RefOperatingUnit;
use App\Models\RefOuType;
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
use App\Models\RefSubmissionStatus;
use App\Models\RefSustainableDevtAgenda;
use App\Models\RefTier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    protected $seeds = [
        "regions" => RefRegion::class,
        "implementation_modes" => RefImplementationMode::class,
        "cip_types" => RefCipType::class,
        "pip_typologies" => RefPipTypology::class,
        "gads" => RefGad::class,
        "operating_unit_types" => RefOuType::class,
        "operating_units" => RefOperatingUnit::class,
        "offices" => Office::class,
        "pdp_chapters" => RefPdpChapter::class,
        "prerequisites" => RefPrerequisite::class,
        "spatial_coverages"  => RefSpatialCoverage::class,
        "sdgs"  => RefSustainableDevtAgenda::class,
        "tpas"  => RefSocioEconAgenda::class,
        "tiers"  => RefTier::class,
        "infrastructure_sectors"  => RefInfraSector::class,
        "infrastructure_subsectors"  => RefInfraSubsector::class,
        "funding_sources"  => RefFundSource::class,
        "funding_institutions"  => RefFundingInstitution::class,
        "project_statuses"  => RefProjectStatus::class,
        "submission_statuses"  => RefSubmissionStatus::class,
        "pap_types"         => RefPapType::class,
        "bases"             => RefBasis::class,
        "approval_levels"   => RefApprovalLevel::class,
        "covid_interventions"=> RefCovidType::class,
        "preparation_documents" => RefPrepDocument::class,
    ];

    /**
     * Run the seeders
     */
    public function run()
    {
        $seeds = json_decode(file_get_contents(database_path('seeders/seeds.json')), true);

        foreach ($seeds as $key => $items) {
            foreach ($items as $item) {
                $modelCreated = $this->seeds[$key]::create([
                    'id'    => $item['id'],
                    'name'  => $item['name'],
                    'label' => $item['name'],
                    'description' => $item['description'] ?? '',
                ]);

                if ($this->seeds[$key] == 'App\\Models\\RefInfraSubsector') {
                    $modelCreated->ref_infra_sector_id = $item['infrastructure_sector_id'];
                    $modelCreated->save();
                }
            }
        }

        User::create([
            'name'          => 'ftp',
            'username'      => 'ftp',
            'email'         => 'ftp@gmail.com',
            'password'      => Hash::make('password'),
            'activated_at'  => now(),
            'office_id'     => 1,
        ]);

        Schema::disableForeignKeyConstraints();

        DB::table('ref_pdp_indicators')->truncate();

        $pdpIndicators = json_decode(file_get_contents(database_path('seeders/pdp_indicators.json')), true);

        foreach ($pdpIndicators['pdp_indicators'] as $indicator) {
            // validate parent_id
            RefPdpIndicator::create([
                'id' => $indicator['id'],
                'name' => $indicator['name'],
                'label' => $indicator['name'],
                'description' => $indicator['description'] ?? '',
                'parent_id' => $indicator['parent_id'] ?? null,
                'level' => $indicator['level'],
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
