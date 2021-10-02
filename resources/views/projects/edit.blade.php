@extends('layouts.header-only')

@section('page-header')
    <x-page-header :title="$project->title"></x-page-header>
@stop

@section('content')
    <form action="{{ route('projects.update', $project) }}" method="POST" accept-charset="UTF-8" class="mt-4 mb-4">
        @csrf
        @method('PUT')

        <div class="Box">

            <div class="d-flex position-sticky top-0 border-top-0 border-bottom p-2 flex-items-center flex-justify-between color-bg-primary rounded-top-2">
                <div class="d-flex flex-items-center">
                    <details class="dropdown details-reset details-overlay">
                        <summary class="btn btn-octicon m-0 mr-2 p-2" aria-haspopup="menu" aria-label="Table of Contents" role="button">
                            <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-list-unordered">
                                <path fill-rule="evenodd" d="M2 4a1 1 0 100-2 1 1 0 000 2zm3.75-1.5a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zm0 5a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zm0 5a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zM3 8a1 1 0 11-2 0 1 1 0 012 0zm-1 6a1 1 0 100-2 1 1 0 000 2z"></path>
                            </svg>
                        </summary>
                        <details-menu class="SelectMenu" role="menu">
                            <div class="SelectMenu-modal rounded-3 mt-1">
                                <div class="SelectMenu-list SelectMenu-list--borderless p-2">
                                    @foreach ($menuItems as $key => $menu)
                                        <a href="{{$key}}" role="menuitem" class="SelectMenu-item py-1">{{ $menu }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </details-menu>
                    </details>

                    <h2 class="Box-title">
                        {{ $project->title }}
                    </h2>
                </div>

                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>

            <div class="Box-body">

                <x-subhead subhead="General Information" id="general-information"></x-subhead>

                <x-form-group field-name="title" label="Title">
                    <x-input.text field-name="title" :value="old('title', $project->title)"></x-input.text>
                    <p class="note">
                        The project title should be identical with the project's title in the budget proposal submitted to DBM.
                    </p>
                </x-form-group>

                <x-form-group field-name="ref_pap_type_id" label="Program or Project">
                    @foreach($papTypes as $option)
                        <x-checkbox type="radio" field-name="ref_pap_type_id" value="{{ $option->id }}" label="{{ $option->label }}" description="{{ $option->description }}" :checked="old('ref_pap_type_id', $project->ref_pap_type_id)"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="bases" label="Basis for Implementation">
                    @foreach($bases as $option)
                        <x-checkbox
                            field-name="bases[]"
                            value="{{ $option->id }}"
                            label="{{ $option->label }}"
                            description="{{ $option->description }}"
                            :checked="old('bases', $project->bases->pluck('id')->toArray() ?? [])"
                        ></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="description" label="PAP Description">
                    <x-textarea field-name="description" :value="old('description', $project->description->description ?? '')" note="Identify the Components of the Program/Project. If a Program, please identify the sub-programs/projects and explain the objective of the program/project in terms of responding to the PDP/ RM. <br/>If the PAP will involve construction of a government facility, specify the definite purpose for the facility to be constructed."></x-textarea>
                </x-form-group>

                <x-form-group field-name="total_cost" label="Total Project/Program Cost">
                    <div class="col-6">
                        <x-input.number field-name="total_cost" :value="old('total_cost', $project->total_cost ?? 0)"></x-input.number>
                    </div>
                </x-form-group>

                <x-subhead subhead="Implementing Agency" id="implementing-agency"></x-subhead>

                <x-form-group field-name="office_id" label="Office">
                    <x-input.select field-name="office_id" :options="$offices" :selected="old('office_id', $project->office_id)"></x-input.select>
                </x-form-group>

                <x-form-group field-name="operating_units" label="Other Implementing Agencies">
                    @foreach($operatingUnits as $option)
                        <x-checkbox field-name="operating_units[]" value="{{ $option->id }}" label="{{ $option->label }}" description="{{ $option->description }}" :checked="old('operating_units', $project->operating_units->pluck('id')->toArray() ?? [])"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-subhead subhead="Spatial Coverage" id="spatial-coverage"></x-subhead>

                <x-form-group field-name="ref_spatial_coverage_id" label="Spatial Coverage">
                    <x-input.select field-name="ref_spatial_coverage_id" :options="$spatialCoverages" :selected="old('ref_spatial_coverage_id', $project->ref_spatial_coverage_id)"></x-input.select>
                </x-form-group>

                <x-form-group field-name="regions" label="Regions">
                    @foreach($regions as $option)
                        <x-checkbox field-name="regions[]" value="{{ $option->id }}" label="{{ $option->label }}" :checked="old('operating_units', $project->regions->pluck('id')->toArray() ?? [])"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-subhead subhead="Approval Level" id="approval-level"></x-subhead>

                <x-form-group field-name="iccable" label="Will require Investment Coordination Committee/NEDA Board Approval (ICC-able)?">
                    <x-radio-group field-name="iccable" :options="$bool" :checked="old('iccable', $project->iccable ?? 0)"></x-radio-group>
                </x-form-group>

                <x-form-group field-name="ref_approval_level_id" label="Level of Approval">
                    <x-input.select
                        field-name="ref_approval_level_id"
                        :options="$approvalLevels"
                        :selected="old('ref_approval_level_id', $project->ref_approval_level_id)"></x-input.select>
                </x-form-group>

                <x-form-group field-name="approval_date" label="Target/Actual Date of Submission">
                    <x-input.date field-name="approval_date" :value="old('approval_date', $project->approval_date)"></x-input.date>
                </x-form-group>

                <x-subhead subhead="Program/Project for Inclusion in Which Programming Document" id="programming-document"></x-subhead>

                <x-form-group field-name="pip" label="Public Investment Program">
                    @foreach($bool as $option)
                        <x-checkbox-trigger field-name="pip" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('pip', $project->pip ?? 0)">
                            @if($option->id == 1)
                                <span class="d-block mb-1">
                                    Type of PIP:
                                </span>
                                @foreach($pipTypologies as $option)
                                    <x-checkbox type="radio" field-name="ref_pip_typology_id" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('ref_pip_typology_id', $project->ref_pip_typology_id)"></x-checkbox>
                                @endforeach
                            @endif
                        </x-checkbox-trigger>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="cip" label="Core Investment Program/Project">
                    @foreach($bool as $option)
                        <x-checkbox-trigger field-name="rdip" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('cip', $project->cip ?? 0)">
                            @if($option->id == 1)
                                <span class="d-block mb-1">
                                    Type of CIP:
                                </span>
                                @foreach($cipTypes as $option)
                                    <x-checkbox type="radio" field-name="ref_cip_type_id" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('ref_cip_type_id', $project->ref_cip_type_id)"></x-checkbox>
                                @endforeach
                            @endif
                        </x-checkbox-trigger>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="trip" label="Three-Year Rolling Infrastructure Program/Project">
                    @foreach($bool as $option)
                        <x-checkbox type="radio" field-name="trip" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('trip', $project->trip ?? 0)"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="rdip" label="Is the Program/Project included in the RDIP?">
                    @foreach($bool as $option)
                        <x-checkbox-trigger field-name="rdip" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('rdip', $project->rdip ?? 0)">
                            @if($option->id == 1)
                                <span class="d-inline-block mt-1">Will require Regional Development Council (RDC) Endorsement?</span>
                                @foreach($bool as $option)
                                    <x-checkbox-trigger field-name="rdc_endorsement_required" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('rdc_endorsement_required', $project->rdc_endorsement_required ?? 0)">
                                        @if($option->id == 1)
                                            <span class="d-inline-block mt-1">Endorsed by the RDC?</span>
                                            @foreach($bool as $option)
                                                <x-checkbox-trigger field-name="rdc_endorsed" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('rdc_endorsed', $project->rdc_endorsed ?? 0)">
                                                    @if($option->id == 1)
                                                        <span class="d-inline-block mt-1">Date Endorsed</span>
                                                        <x-input.date field-name="rdc_endorsed_date" :value="old('rdc_endorsed_date', $project->rdc_endorsed_date)"></x-input.date>
                                                    @endif
                                                </x-checkbox-trigger>
                                            @endforeach
                                        @endif
                                    </x-checkbox-trigger>
                                @endforeach
                            @endif
                        </x-checkbox-trigger>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="research" label="Is it a Research and Development Program/Project?">
                    @foreach($bool as $option)
                        <x-checkbox type="radio" field-name="research" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('research', $project->research ?? 0)"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="ifp" label="Is it an Infrastructure Flagship Project(IFP)?">
                    @foreach($bool as $option)
                        <x-checkbox type="radio" field-name="ifp" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('ifp', $project->ifp ?? 0)"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="ict" label="Is it an ICT program/project?">
                    @foreach($bool as $option)
                        <x-checkbox type="radio" field-name="ict" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('ict', $project->ict ?? 0)"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="covid" label="Is it responsive to COVID-19/New Normal Intervention?">
                    @foreach($bool as $option)
                        <x-checkbox-trigger field-name="covid" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('covid', $project->covid ?? 0)">
                            @if($option->id == 1)
                                <span class="d-block mb-1">
                                    COVID Interventions
                                </span>
                                @foreach($covidInterventions as $option)
                                    <x-checkbox type="checkbox" field-name="covid_interventions" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('covid_interventions', $project->covid_interventions->pluck('id')->toArray() ?? [])"></x-checkbox>
                                @endforeach
                            @endif
                        </x-checkbox-trigger>
                    @endforeach
                </x-form-group>

                <x-subhead subhead="Physical & Financial Status" id="physical-financial-status"></x-subhead>

                <x-form-group field-name="ref_project_status_id" label="Status of Implementation Readiness">
                    <x-input.select field-name="ref_project_status_id" :options="$projectStatuses" :selected="old('ref_project_status_id', $project->ref_project_status_id)"></x-input.select>
                </x-form-group>

                <x-form-group field-name="updates" label="Updates">
                    <x-textarea field-name="updates" note="For proposed program/project, please indicate the physical status of the program/project in terms of project preparation, approval, funding, etc. If ongoing or completed, please provide information on the delivery of outputs, percentage of completion and financial status/ accomplishment in terms of utilization rate." :value="old('updates', $project->project_update->updates ?? '')"></x-textarea>
                </x-form-group>

                <x-form-group field-name="updates_date" label="As of">
                    <x-input.date field-name="updates_date" :value="old('updates_date', $project->project_update->date ?? '')"></x-input.date>
                </x-form-group>

                <x-form-group field-name="icc_resubmission" label="Will this require resubmission to the ICC? ">
                    @foreach($bool as $option)
                        <x-checkbox type="radio" field-name="icc_resubmission" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('icc_resubmission', $project->icc_resubmission ?? 0)"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-subhead subhead="Implementation Period " id="implementation-period"></x-subhead>

                <x-form-group field-name="target_start_year" label="Start of Project Implementation">
                    <x-input.select field-name="target_start_year" :options="$years" :selected="old('target_start_year', $project->target_start_year)"></x-input.select>
                </x-form-group>

                <x-form-group field-name="target_end_year" label="Year of Project Completion">
                    <x-input.select field-name="target_end_year" :options="$years" :selected="old('target_end_year', $project->target_end_year)"></x-input.select>
                </x-form-group>

                <x-subhead subhead="Philippine Development Plan (PDP) Chapter" id="pdp-chapter"></x-subhead>

                <x-form-group field-name="pdp_chapter_id" label="Main PDP Midterm Update Chapter">
                    <x-input.select field-name="pdp_chapter_id" :options="$pdpChapters" :checked="old('ref_pdp_chapter_id', $project->ref_pdp_chapter_id)"></x-input.select>
                </x-form-group>

                <x-form-group field-name="pdp_chapters" label="Other PDP Midterm Update Chapters">
                    @foreach($pdpChapters as $option)
                        <x-checkbox field-name="pdp_chapters[]" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('pdp_chapters', $project->pdp_chapters->pluck('id')->toArray() ?? [])"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-subhead subhead="Main PDP Chapter Outcome Statements/Outputs" id="pdp-indicators"></x-subhead>

                <x-form-group field-name="pdp_indicators" label="Main PDP Chapter Outcome Statements/Outputs">
                    @foreach($pdpIndicators as $option)
                        <x-checkbox field-name="pdp_indicators[]" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('pdp_indicators', $project->pdp_indicators->pluck('id')->toArray() ?? [])"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-checkbox field-name="no_pdp_indicator" label="No PDP Output Statement applicable" value="1"></x-checkbox>

                <x-form-group field-name="output" label="Expected Outputs">
                    <x-textarea field-name="output" label="Expected Outputs" note="Actual Deliverables, i.e. 100km of paved roads" :value="old('expected_outputs', $project->output->output ?? '')"></x-textarea>
                </x-form-group>

                <x-subhead subhead="0-10 Point Socioeconomic Agenda" id="socio-econ-agenda"></x-subhead>

                <x-form-group field-name="ref_sea" label="0-10 Point Socioeconomic Agenda">
                    @foreach($socioEconAgenda as $option)
                        <x-checkbox field-name="socio_econ_agendas[]" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('ref_sea', $project->socio_econ_agendas->pluck('id')->toArray() ?? [])"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-subhead subhead="Sustainable Development Goals (SDG)" id="sustainable-devt-agenda"></x-subhead>

                <x-form-group field-name="sdgs" label="Sustainable Development Goals (SDG)">
                    @foreach($sdgs as $option)
                        <x-checkbox field-name="sdgs[]" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('ref_sdg', $project->sdgs->pluck('id')->toArray() ?? [])"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-subhead subhead="Project Preparation Details" id="project-prep-details"></x-subhead>

                <x-form-group field-name="ref_project_prep_document_id" label="Project Preparation Document">
                    <x-input.select field-name="ref_project_prep_document_id" :options="$prepDocuments" :selected="old('ref_project_prep_document_id', $project->ref_project_prep_document_id)"></x-input.select>
                </x-form-group>

                <x-form-group field-name="has_fs" label="Will require assistance for the conduct of Feasibility Study?">
                    @foreach($bool as $option)
                        <x-checkbox-trigger field-name="has_fs" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('has_fs', $project->has_fs ?? 0)">
                            @if($option->id == 1)
                                <span class="d-block mb-1">
                                    Status of Feasibility Study:
                                </span>
                                <span>
                                    @foreach($fsStatus as $key => $option2)
                                        <x-checkbox-trigger type="radio" field-name="fs[status]" label="{{ $option2 }}" value="{{ $key }}" :checked="old('fs.status', $project->feasibility_study->status ?? '')">
                                            @if($key == 'for_preparation')
                                                <x-input.date label="Start date:" field-name="fs[completion_date]" :checked="old('fs.completion_date', $project->feasibility_study->completion_date ?? '')"></x-input.date>
                                            @endif

                                            @if($key == 'ongoing')
                                                <x-input.date label="Expected completion date:" field-name="fs[start_date]" :checked="old('fs.start_date', $project->feasibility_study->start_date ?? '')"></x-input.date>
                                            @endif
                                        </x-checkbox-trigger>
                                    @endforeach
                                </span>
                                <div class="d-flex flex-column">
                                    <span class="d-block mb-1">
                                        Schedule of Feasibility Cost:
                                        <p class="note">
                                            Please reflect actual or estimated cost (In Exact Amount in PhP).
                                        </p>
                                    </span>
                                    <div class="d-flex flex-justify-between">
                                        <div class="col-2">
                                            <x-input.number field-name="fs[y2017]" value="{{ old('fs.y2017', $project->feasibility_study->y2017 ?? 0) }}"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="fs[y2018]" value="{{ old('fs.y2018', $project->feasibility_study->y2018 ?? 0) }}"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="fs[y2019]" value="{{ old('fs.y2019', $project->feasibility_study->y2019 ?? 0) }}"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="fs[y2020]" value="{{ old('fs.y2020', $project->feasibility_study->y2020 ?? 0) }}"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="fs[y2021]" value="{{ old('fs.y2021', $project->feasibility_study->y2021 ?? 0) }}"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="fs[y2022]" value="{{ old('fs.y2022', $project->feasibility_study->y2022 ?? 0) }}"></x-input.number>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </x-checkbox-trigger>
                    @endforeach
                </x-form-group>

                <x-subhead subhead="Pre-construction Costs" id="pre-construction-costs"></x-subhead>

                <x-form-group field-name="has_row" label="With Right of Way Acquisition (ROWA) Component">
                    @foreach($bool as $option)
                        <x-checkbox-trigger field-name="has_row" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('has_row', $project->has_row ?? 0)">
                            @if($option->id == 1)
                                <div class="d-flex flex-column">
                                    <span class="d-block mb-1">
                                        Schedule of ROWA Cost:
                                    </span>
                                    <p class="note">
                                        Please reflect actual or estimated cost (In Exact Amount in PhP).
                                    </p>
                                    <div class="d-flex flex-justify-between">
                                        <div class="col-2">
                                            <x-input.number field-name="rowa[y2017]" :value="old('rowa.y2017', $project->rowa->y2017 ?? 0)"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="rowa[y2018]" :value="old('rowa.y2018', $project->rowa->y2018 ?? 0)"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="rowa[y2019]" :value="old('rowa.y2019', $project->rowa->y2019 ?? 0)"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="rowa[y2020]" :value="old('rowa.y2020', $project->rowa->y2020 ?? 0)"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="rowa[y2021]" :value="old('rowa.y2021', $project->rowa->y2021 ?? 0)"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="rowa[y2022]" :value="old('rowa.y2022', $project->rowa->y2022 ?? 0)"></x-input.number>
                                        </div>
                                    </div>
                                    <span class="d-block mb-1">
                                        Affected households:
                                    </span>
                                    <div class="d-flex">
                                        <x-input.text field-name="rowa[hh_affected]" :value="old('rowa.hh_affected', $project->rowa->hh_affected ?? '')"></x-input.text>
                                    </div>
                                </div>
                            @endif
                        </x-checkbox-trigger>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="has_rap" label="With Resettlement Component?">
                    @foreach($bool as $option)
                        <x-checkbox-trigger field-name="has_rap" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('has_rap', $project->has_rap ?? 0)">
                            @if($option->id == 1)
                                <div class="d-flex flex-column">
                                    <span class="d-block mb-1">
                                        Schedule of ROWA Cost:
                                    </span>
                                    <p class="note">
                                        Please reflect actual or estimated cost (In Exact Amount in PhP).
                                    </p>
                                    <div class="d-flex flex-justify-between">
                                        <div class="col-2">
                                            <x-input.number field-name="rap[y2017]" :value="old('rap.y2017', $project->resettlement_action_plan->y2017 ?? 0)"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="rap[y2018]" :value="old('rap.y2018', $project->resettlement_action_plan->y2018 ?? 0)"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="rap[y2019]" :value="old('rap.y2019', $project->resettlement_action_plan->y2019 ?? 0)"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="rap[y2020]" :value="old('rap.y2020', $project->resettlement_action_plan->y2020 ?? 0)"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="rap[y2021]" :value="old('rap.y2021', $project->resettlement_action_plan->y2021 ?? 0)"></x-input.number>
                                        </div>
                                        <div class="col-2 ml-1">
                                            <x-input.number field-name="rap[y2022]" :value="old('rap.y2022', $project->resettlement_action_plan->y2022 ?? 0)"></x-input.number>
                                        </div>
                                    </div>
                                    <span class="d-block mb-1">
                                        Affected households:
                                    </span>
                                    <div class="d-flex">
                                        <x-input.text field-name="rap[hh_affected]" :value="old('rap.hh_affected', $project->resettlement_action_plan->hh_affected ?? '')"></x-input.text>
                                    </div>
                                </div>
                            @endif
                        </x-checkbox-trigger>
                    @endforeach
                </x-form-group>

                <x-form-group field-name="has_row_rap" label="With ROWA and Resettlement Action Plan?">
                    @foreach($bool as $option)
                        <x-checkbox type="radio" field-name="has_row_rap" label="{{ $option->label }}" value="{{ $option->id }}" :checked="old('has_row_rap', $project->has_row_rap ?? 0)"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-subhead subhead="Employment Generation" id="employment-generated" description="Please indicate the no. of persons to be employed by the project outside of the implementing agency only"></x-subhead>

                <x-form-group field-name="employment_generated" label="No. of persons to be employed" required>
                    <x-input.text field-name="employment_generated" :value="old('employment_generated', $project->employment_generated)"></x-input.text>
                </x-form-group>

                <x-subhead subhead="Funding Source and Mode of Implementation" id="funding-source"></x-subhead>

                <x-form-group field-name="ref_fund_source_id" label="Main Funding Source" required>
                    <x-input.select field-name="ref_fund_source_id" :options="$fundSources" :selected="old('ref_fund_source_id', $project->ref_fund_source_id)"></x-input.select>
                </x-form-group>

                <x-form-group field-name="ref_funding_institution_id" label="ODA Funding Institution">
                    <x-input.select field-name="ref_funding_institution_id" :options="$fundingInstitutions" :selected="old('ref_funding_institution_id', $project->ref_funding_institution_id)"></x-input.select>
                    <p class="note">
                        Required only if fund source is ODA-Loan/ODA-grant
                    </p>
                </x-form-group>

                <x-form-group field-name="ref_implementation_mode_id" label="Mode of Implementation/Procurement">
                    <x-input.select field-name="ref_implementation_mode_id" :options="$implementationModes" :selected="old('ref_implementation_mode_id', $project->ref_implementation_mode_id)"></x-input.select>
                </x-form-group>

                <x-form-group field-name="other_mode" label="Other Mode">
                    <x-input.text field-name="other_mode" :value="old('other_mode', $project->other_mode)"></x-input.text>
                </x-form-group>

                <x-subhead subhead="Project Cost by Fund Sources" id="project-cost-fund-source" description="Total cost should be at least PHP50,000."></x-subhead>

                <div>
                    <table class="d-table col-12 v-align-middle">
                        <thead>
                        <tr class="border-y">
                            <th class="col-1 p-1">Fund Source</th>
                            <th class="col-1 p-1">2016 &amp; Prior</th>
                            <th class="col-1 p-1">2017</th>
                            <th class="col-1 p-1">2018</th>
                            <th class="col-1 p-1">2019</th>
                            <th class="col-1 p-1">2021</th>
                            <th class="col-1 p-1">2022</th>
                            <th class="col-1 p-1">2023 &amp; Beyond</th>
                            <th class="col-1 p-1">Total</th>
                        </tr>
                        </thead>
                        <thead>
                        @if(count($project->fs_investments))
                            @foreach($project->fs_investments as $key => $fs_investment)
                                <tr class="col-12 border-bottom">
                                    <td class="col-1 p-1">
                                        <input type="hidden" name="fs_investments[{{ $key }}][ref_fund_source_id]">
                                        {{ $fs->name }}
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2016]" :value="old('fs_investments.' . $key . '.y2016', $fs_investment->y2016 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2017]" :value="old('fs_investments.' . $key . '.y2017', $fs_investment->y2017 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2018]" :value="old('fs_investments.' . $key . '.y2018', $fs_investment->y2018 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2019]" :value="old('fs_investments.' . $key . '.y2019', $fs_investment->y2019 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2020]" :value="old('fs_investments.' . $key . '.y2020', $fs_investment->y2020 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2021]" :value="old('fs_investments.' . $key . '.y2021', $fs_investment->y2021 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2022]" :value="old('fs_investments.' . $key . '.y2022', $fs_investment->y2022 ?? 0)"></x-input.number>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @foreach($fundSources as $key => $fs)
                                <tr class="col-12 border-bottom">
                                    <td class="col-1 p-1">{{ $fs->name }}</td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2016]"
                                                        value="{{ old('fs_investments.' . $key . '.y2016', 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2017]"
                                                        value="{{ old('fs_investments.' . $key . '.y2017', 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2018]"
                                                        value="{{ old('fs_investments.' . $key . '.y2018', 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2019]"
                                                        value="{{ old('fs_investments.' . $key . '.y2019', 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2020]"
                                                        value="{{ old('fs_investments.' . $key . '.y2020', 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2021]"
                                                        value="{{ old('fs_investments.' . $key . '.y2021', 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_investments[{{ $key }}][y2022]"
                                                        value="{{ old('fs_investments.' . $key . '.y2022', 0) }}"></x-input.number>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </thead>
                    </table>
                </div>

                <x-subhead subhead="Project Cost by Regions" id="project-cost-by-region" description="Total cost should be at least PHP50,000."></x-subhead>

                <div>
                    <table class="d-table col-12 v-align-middle">
                        <thead>
                        <tr class="border-y">
                            <th class="col-1 p-1">Region</th>
                            <th class="col-1 p-1">2016 &amp; Prior</th>
                            <th class="col-1 p-1">2017</th>
                            <th class="col-1 p-1">2018</th>
                            <th class="col-1 p-1">2019</th>
                            <th class="col-1 p-1">2020</th>
                            <th class="col-1 p-1">2021</th>
                            <th class="col-1 p-1">2022</th>
                            <th class="col-1 p-1">2023 &amp; Beyond</th>
                            <th class="col-1 p-1">Total</th>
                        </tr>
                        </thead>
                        <thead>
                        @if(count($project->region_investments))
                            @foreach($project->region_investments as $key => $region_investment)
                                <tr class="col-12 border-bottom">
                                    <td class="col-1 p-1">
                                        <input type="hidden" name="region_investments[{{ $key }}][ref_region_id]">
                                        {{ $region->name }}
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2016]" value="{{ old('region_investments.'.$key.'.y2016', $region_investment->y2016 ?? 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2017]" value="{{ old('region_investments.'.$key.'.y2017', $region_investment->y2017 ?? 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2018]" value="{{ old('region_investments.'.$key.'.y2018', $region_investment->y2018 ?? 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2019]" value="{{ old('region_investments.'.$key.'.y2019', $region_investment->y2019 ?? 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2020]" value="{{ old('region_investments.'.$key.'.y2020', $region_investment->y2020 ?? 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2021]" value="{{ old('region_investments.'.$key.'.y2021', $region_investment->y2021 ?? 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2022]" value="{{ old('region_investments.'.$key.'.y2022', $region_investment->y2022 ?? 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2023]" value="{{ old('region_investments.'.$key.'.y2023', $region_investment->y2023 ?? 0) }}"></x-input.number>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @foreach($regions as $key => $region)
                                <tr class="col-12 border-bottom">
                                    <td class="col-1 p-1">{{ $region->name }}</td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2016]"
                                                        value="{{ old('regions.'.$key.'.y2016', 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2017]"
                                                        value="{{ old('regions.'.$key.'.y2017', 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2018]"
                                                        value="{{ old('regions.'.$key.'.y2018', 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2019]"
                                                        value="{{ old('regions.'.$key.'.y2019', 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2020]"
                                                        value="{{ old('regions.'.$key.'.y2020', 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2021]"
                                                        value="{{ old('regions.'.$key.'.y2021', 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2022]"
                                                        value="{{ old('regions.'.$key.'.y2022', 0) }}"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="region_investments[{{ $key }}][y2023]"
                                                        value="{{ old('regions.'.$key.'.y2023', 0) }}"></x-input.number>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </thead>
                    </table>
                </div>

                <x-subhead subhead="Financial Accomplishments" id="financial-accomplishments" description="In exact amount in PhP"></x-subhead>

                <x-checkbox field-name="financial_accomp_na" value="1" label="Not Applicable (For PAPs not for funding in the GAA)" :value="old('financial_accomp_na', $project->financial_accomp_na ?? 0)"></x-checkbox>

                <x-form-group label="PAP Code" field-name="pap_code">
                    <x-input.text field-name="pap_code" :value="old('pap_code', $project->pap_code)"></x-input.text>
                </x-form-group>

                <x-form-group label="Category" field-name="ref_tier_id">
                    <x-input.select field-name="ref_tier_id" :options="$tiers" :selected="old('ref_tier_id', $project->ref_tier_id)"></x-input.select>
                </x-form-group>

                <x-form-group label="UACS Code" field-name="uacs_code">
                    <input type="text" class="form-control" name="uacs_code">
                </x-form-group>

                <div>
                    <table class="d-table col-12">
                        <thead>
                        <tr class="border-y">
                            <th class="col-1 p-1">Year</th>
                            <th class="col-1 p-1">Amount included in the NEP</th>
                            <th class="col-1 p-1">Amount Allocated in the Budget/GAA</th>
                            <th class="col-1 p-1">Actual Amount Disbursed</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="col-12 border-bottom">
                            <td class="col-1 p-1">2017</td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="nep[y2017]" value="{{ old('nep.y2017', $project->nep->y2017 ?? 0) }}"></x-input.number>
                            </td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="gaa[y2017]" value="{{ old('gaa.y2017', $project->gaa->y2017 ?? 0) }}"></x-input.number>
                            </td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="disbursement[y2017]" value="{{ old('disbursement.y2017', $project->disbursement->y2017 ?? 0) }}"></x-input.number>
                            </td>
                        </tr>
                        <tr class="col-12 border-bottom">
                            <td class="col-1 p-1">2017</td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="nep[y2018]" value="{{ old('nep.y2018', $project->nep->y2018 ?? 0) }}"></x-input.number>
                            </td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="gaa[y2018]" value="{{ old('gaa.y2018', $project->gaa->y2018 ?? 0) }}"></x-input.number>
                            </td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="disbursement[y2018]" value="{{ old('disbursement.y2018', $project->disbursement->y2018 ?? 0) }}"></x-input.number>
                            </td>
                        </tr>
                        <tr class="col-12 border-bottom">
                            <td class="col-1 p-1">2017</td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="nep[y2019]" value="{{ old('nep.y2019', $project->nep->y2019 ?? 0) }}"></x-input.number>
                            </td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="gaa[y2019]" value="{{ old('gaa.y2019', $project->gaa->y2019 ?? 0) }}"></x-input.number>
                            </td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="disbursement[y2019]" value="{{ old('disbursement.y2019', $project->disbursement->y2019 ?? 0) }}"></x-input.number>
                            </td>
                        </tr>
                        <tr class="col-12 border-bottom">
                            <td class="col-1 p-1">2017</td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="nep[y2020]" value="{{ old('nep.y2020', $project->nep->y2020 ?? 0) }}"></x-input.number>
                            </td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="gaa[y2020]" value="{{ old('gaa.y2020', $project->gaa->y2020 ?? 0) }}"></x-input.number>
                            </td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="disbursement[y2020]" value="{{ old('disbursement.y2020', $project->disbursement->y2020 ?? 0) }}"></x-input.number>
                            </td>
                        </tr>
                        <tr class="col-12 border-bottom">
                            <td class="col-1 p-1">2021</td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="nep[y2021]" value="{{ old('nep.y2021', $project->nep->y2021 ?? 0) }}"></x-input.number>
                            </td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="gaa[y2021]" value="{{ old('gaa.y2021', $project->gaa->y2021 ?? 0) }}"></x-input.number>
                            </td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="disbursement[y2021]" value="{{ old('disbursement.y2021', $project->disbursement->y2021 ?? 0) }}"></x-input.number>
                            </td>
                        </tr>
                        <tr class="col-12 border-bottom">
                            <td class="col-1 p-1">2017</td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="nep[y2022]" :value="old('nep.y2022', $project->nep->y2022 ?? 0)"></x-input.number>
                            </td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="gaa[y2022]" :value="old('gaa.y2022', $project->gaa->y2022 ?? 0)"></x-input.number>
                            </td>
                            <td class="col-1 p-1">
                                <x-input.number field-name="disbursement[y2022]" :value="old('disbursement.y2022', $project->disbursement->y2022 ?? 0)"></x-input.number>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <x-subhead subhead="Infrastructure Information" id="infrastructure-information"></x-subhead>

                <x-form-group label="Infrastructure Sector" field-name="infra_sectors">
                    @foreach($infraSectors as $infraSector)
                        <x-checkbox value="{{ $infraSector->id }}" label="{{ $infraSector->label }}" field-name="infra_sectors[]" :checked="old('infra_sectors', $project->infra_sectors->pluck('id')->toArray() ?? [])"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-form-group label="Status of Implementation Readiness" field-name="prerequisites">
                    @foreach($prerequisites as $option)
                        <x-checkbox value="{{ $option->id }}" label="{{ $option->label }}" field-name="prerequisites[]" :checked="old('prerequisites', $project->prerequisites->pluck('id')->toArray() ?? [])"></x-checkbox>
                    @endforeach
                </x-form-group>

                <x-form-group label="Implementation Risks and Mitigation Strategies" field-name="risk">
                    <x-textarea field-name="risk" :value="old('risk', $project->risk->risk)"></x-textarea>
                </x-form-group>

                <x-subhead subhead="Infrastructure Cost by Fund Source" id="infrastructure-cost-by-fund-source" description="Total cost should be at least PHP50,000."></x-subhead>

                <div>
                    <table class="d-table col-12 v-align-middle">
                        <thead>
                        <tr class="border-y">
                            <th class="col-1 p-1">Fund Source</th>
                            <th class="col-1 p-1">2016 &amp; Prior</th>
                            <th class="col-1 p-1">2017</th>
                            <th class="col-1 p-1">2018</th>
                            <th class="col-1 p-1">2019</th>
                            <th class="col-1 p-1">2020</th>
                            <th class="col-1 p-1">2021</th>
                            <th class="col-1 p-1">2022</th>
                            <th class="col-1 p-1">2023 &amp; Beyond</th>
                            <th class="col-1 p-1">Total</th>
                        </tr>
                        </thead>
                        <thead>
                        @if(count($project->fs_infrastructures))
                            @foreach($project->fs_infrastructures as $key => $fs_infrastructure)
                                <tr class="col-12 border-bottom">
                                    <td class="col-1 p-1">{{ $fs->name }}</td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2016]" :value="old('fs_infrastructures.' . $key . '.y2016', $fs_infrastructure->y2016 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2017]" :value="old('fs_infrastructures.' . $key . '.y2017', $fs_infrastructure->y2017 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2018]" :value="old('fs_infrastructures.' . $key . '.y2018', $fs_infrastructure->y2018 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2019]" :value="old('fs_infrastructures.' . $key . '.y2019', $fs_infrastructure->y2019 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2020]" :value="old('fs_infrastructures.' . $key . '.y2020', $fs_infrastructure->y2020 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2021]" :value="old('fs_infrastructures.' . $key . '.y2021', $fs_infrastructure->y2021 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2022]" :value="old('fs_infrastructures.' . $key . '.y2022', $fs_infrastructure->y2022 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2023]" :value="old('fs_infrastructures.' . $key . '.y2023', $fs_infrastructure->y2023 ?? 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1"></td>
                                </tr>
                            @endforeach
                        @else
                            @foreach($fundSources as $key => $fs)
                                <tr class="col-12 border-bottom">
                                    <td class="col-1 p-1">
                                        <input type="hidden" name="fs_infrastructures[{{ $key }}][ref_fund_source_id]">
                                        {{ $fs->name }}
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2016]"
                                                        :value="old('fs_infrastructures.' . $key . '.y2016', 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2017]"
                                                        :value="old('fs_infrastructures.' . $key . '.y2017', 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2018]"
                                                        :value="old('fs_infrastructures.' . $key . '.y2018', 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2019]"
                                                        :value="old('fs_infrastructures.' . $key . '.y2019', 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2020]"
                                                        :value="old('fs_infrastructures.' . $key . '.y2020', 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2021]"
                                                        :value="old('fs_infrastructures.' . $key . '.y2021', 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2022]"
                                                        :value="old('fs_infrastructures.' . $key . '.y2022', 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1">
                                        <x-input.number field-name="fs_infrastructures[{{ $key }}][y2023]"
                                                        :value="old('fs_infrastructures.' . $key . '.y2023', 0)"></x-input.number>
                                    </td>
                                    <td class="col-1 p-1"></td>
                                </tr>
                            @endforeach
                        @endif
                        </thead>
                    </table>
                </div>

            </div>

            <div class="Box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>

    </form>
@stop
