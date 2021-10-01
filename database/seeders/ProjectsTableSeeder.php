<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectUpdate;
use App\Models\RefBasis;
use App\Models\RefCovidType;
use App\Models\RefInfraSector;
use App\Models\RefOperatingUnit;
use App\Models\RefPdpChapter;
use App\Models\RefPdpIndicator;
use App\Models\RefPrerequisite;
use App\Models\RefRegion;
use App\Models\RefSocioEconAgenda;
use App\Models\RefSustainableDevtAgenda;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class ProjectsTableSeeder extends Seeder
{
    use WithFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bases = array_rand(RefBasis::all()->pluck('id')->toArray(), 3);
        $operating_units = array_rand(RefOperatingUnit::all()->pluck('id')->toArray(), 3);
        $regions = array_rand(RefRegion::all()->pluck('id')->toArray(), 3);
        $covid_interventions = array_rand(RefCovidType::all()->pluck('id')->toArray(), 3);
        $pdp_chapters = array_rand(RefPdpChapter::all()->pluck('id')->toArray(), 3);
        $pdp_indicators = array_rand(RefPdpIndicator::all()->pluck('id')->toArray(), 3);
        $socio_econ_agendas = array_rand(RefSocioEconAgenda::all()->pluck('id')->toArray(), 3);
        $sdgs = array_rand(RefSustainableDevtAgenda::all()->pluck('id')->toArray(), 3);
        $infra_sectors = array_rand(RefInfraSector::all()->pluck('id')->toArray(), 3);
        $prerequisites = array_rand(RefPrerequisite::all()->pluck('id')->toArray(), 3);

        Project::factory()
            ->has(ProjectUpdate::factory()->count(1), 'project_update')
            ->create();
    }
}
