<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    public function create(array $data): Project
    {
        $project = Project::create($data);

        if (isset($data['description'])) {
            $project->description()->create([
                'description' => $data['description'],
            ]);
        }

        if (isset($data['expected_outputs'])) {
            $project->expected_output()->create([
                'expected_outputs' => $data['expected_outputs'],
            ]);
        }

        if (isset($data['updates'])) {
            $project->update()->create([
                'updates' => $data['updates'],
                'date'    => $data['updates_date'],
            ]);
        }

        if (isset($data['nep'])) {
            $project->nep()->create([
                'y2016' => $data['nep']['y2016'],
                'y2017' => $data['nep']['y2017'],
                'y2018' => $data['nep']['y2018'],
                'y2019' => $data['nep']['y2019'],
                'y2020' => $data['nep']['y2020'],
                'y2021' => $data['nep']['y2021'],
                'y2022' => $data['nep']['y2022'],
                'y2023' => $data['nep']['y2023'],
            ]);
        }

        if (isset($data['gaa'])) {
            $project->gaa()->create([
                'y2016' => $data['gaa']['y2016'],
                'y2017' => $data['gaa']['y2017'],
                'y2018' => $data['gaa']['y2018'],
                'y2019' => $data['gaa']['y2019'],
                'y2020' => $data['gaa']['y2020'],
                'y2021' => $data['gaa']['y2021'],
                'y2022' => $data['gaa']['y2022'],
                'y2023' => $data['gaa']['y2023'],
            ]);
        }

        if (isset($data['disbursement'])) {
            $project->disbursement()->create([
                'y2016' => $data['disbursement']['y2016'],
                'y2017' => $data['disbursement']['y2017'],
                'y2018' => $data['disbursement']['y2018'],
                'y2019' => $data['disbursement']['y2019'],
                'y2020' => $data['disbursement']['y2020'],
                'y2021' => $data['disbursement']['y2021'],
                'y2022' => $data['disbursement']['y2022'],
                'y2023' => $data['disbursement']['y2023'],
            ]);
        }

        return $project;
    }
}
