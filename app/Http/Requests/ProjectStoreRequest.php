<?php

namespace App\Http\Requests;

use App\Models\ProjectFs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        //
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'min:10',
                'max:255',
            ],
            'ref_pap_type_id' => [
                'required',
                'exists:ref_pap_types,id',
            ],
            'bases' => [
                'required',
                'array',
            ],
            'bases.*' => [
                'exists:ref_bases,id',
            ],
            'description'   => [
                'required',
                'string',
                'max:255'
            ],
            'total_cost' => [
                'required',
                'numeric',
                'min:50000',
                'max:99999999999',
            ],
            'office_id' => ['exists:offices,id'],
            'operating_units' => [
                'sometimes',
                'array',
            ],
            'operating_units.*' => [
                'exists:ref_operating_units,id'
            ],
            'ref_spatial_coverage_id' => [
                'required',
                'exists:ref_spatial_coverages,id',
            ],
            'regions' => [
                'sometimes',
                'array'
            ],
            'regions.*' => [
                'exists:ref_regions,id'
            ],
            'iccable' => [
                'sometimes',
                'bool',
            ],
            'ref_approval_level_id' => [
                'required',
                'exists:ref_approval_levels,id'
            ],
            'approval_date' => [
                'date',
            ],
            'pip' => [
                'required',
                'bool',
            ],
            'ref_pip_typology_id' => [
                'required_if:pip,1',
                'exists:ref_pip_typologies,id',
            ],
            'cip' => [
                'required',
                'bool',
            ],
            'ref_cip_type_id' => [
                'required_if:cip,1',
                'exists:ref_cip_types,id',
            ],
            'trip' => [
                'required',
                'bool',
            ],
            'rdip' => [
                'required',
                'bool',
            ],
            'research' => [
                'required',
                'bool',
            ],
            'ifp' => [
                'required',
                'bool',
            ],
            'ict' => [
                'required',
                'bool',
            ],
            'covid' => [
                'required',
                'bool',
            ],
            'covid_types' => [
                'required_if:covid,1',
                'array',
            ],
            'covid_types.*' => [
                'exists:ref_covid_types,id',
            ],
            'ref_project_status_id' => [
                'required',
                'exists:ref_project_statuses,id',
            ],
            'updates' => [
                'required',
                'string',
                'max:255',
            ],
            'updates_date' => [
                'required',
                'date',
            ],
            'icc_resubmission' => [
                'required',
                'bool',
            ],
            'target_start_year' => [
                'required',
                'int'
            ],
            'target_end_year' => [
                'required',
                'int'
            ],
            'ref_pdp_chapter_id' => [
                'required',
                'exists:ref_pdp_chapters,id'
            ],
            'pdp_chapters' => [
                'sometimes',
                'array',
            ],
            'pdp_chapters.*' => [
                'exists:ref_pdp_chapters,id'
            ],
            'pdp_indicators' => [
                'sometimes',
                'array',
            ],
            'pdp_indicators.*' => [
                'exists:ref_pdp_indicators,id',
            ],
            'output' => [
                'required',
                'string',
                'max:255',
            ],
            'socio_econ_agendas' => [
                'sometimes',
                'array',
            ],
            'sdgs' => [
                'sometimes',
                'array',
            ],
            'ref_prep_document_id' => [
                'required',
                'exists:ref_prep_documents,id',
            ],
            'has_fs' => [
                'required',
                'bool',
            ],
            'fs' => [
                'sometimes',
                'array',
            ],
            'fs.status' => [
                'required',
                Rule::in(array_keys(ProjectFs::FS_STATUS)),
            ],
            'fs.start_date' => ['date'],
            'fs.completion_date' => ['date'],
            'fs.fy2017' => ['numeric'],
            'fs.fy2018' => ['numeric'],
            'fs.fy2019' => ['numeric'],
            'fs.fy2020' => ['numeric'],
            'fs.fy2021' => ['numeric'],
            'fs.fy2022' => ['numeric'],
            'has_row' => [
                'required',
                'bool',
            ],
            'rowa' => [
                'sometimes',
                'array',
            ],
            'rowa.fy2017' => ['sometimes','numeric'],
            'rowa.fy2018' => ['sometimes','numeric'],
            'rowa.fy2019' => ['sometimes','numeric'],
            'rowa.fy2020' => ['sometimes','numeric'],
            'rowa.fy2021' => ['sometimes','numeric'],
            'rowa.fy2022' => ['sometimes','numeric'],
            'rowa.hh_affected' => ['sometimes'],
            'has_rap' => [
                'required',
                'bool',
            ],
            'resettlement.fy2017' => ['sometimes','numeric'],
            'resettlement.fy2018' => ['sometimes','numeric'],
            'resettlement.fy2019' => ['sometimes','numeric'],
            'resettlement.fy2020' => ['sometimes','numeric'],
            'resettlement.fy2021' => ['sometimes','numeric'],
            'resettlement.fy2022' => ['sometimes','numeric'],
            'resettlement.hh_affected' => ['sometimes'],
            'has_row_rap' => [
                'required',
                'bool',
            ],
            'employment_generated' => [
                'required',
                'string'
            ],
            'ref_fund_source_id' => [
                'required',
                'exists:ref_fund_sources,id'
            ],
            'ref_funding_institution_id' => [
                'required',
                'exists:ref_funding_institutions,id'
            ],
            'ref_implementation_mode_id' => [
                'required',
                'exists:ref_implementation_modes,id'
            ],
            'other_mode' => [
                'sometimes',
                'string',
            ],
            'fs_investments' => [
                'required',
                'array'
            ],
            'fs_investments.*.ref_fund_source_id' => [
                'required',
                'exists:ref_fund_sources,id',
            ],
            'fs_investments.*.y2016' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_investments.*.y2017' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_investments.*.y2018' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_investments.*.y2019' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_investments.*.y2020' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_investments.*.y2021' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_investments.*.y2022' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_investments.*.y2023' => [
                'required',
                'numeric',
                'min:0',
            ],
            'region_investments' => [
                'required',
                'array'
            ],
            'region_investments.*.ref_region_id' => [
                'required',
                'exists:ref_regions,id',
            ],
            'region_investments.*.y2016' => [
                'required',
                'numeric',
                'min:0',
            ],
            'region_investments.*.y2017' => [
                'required',
                'numeric',
                'min:0',
            ],
            'region_investments.*.y2018' => [
                'required',
                'numeric',
                'min:0',
            ],
            'region_investments.*.y2019' => [
                'required',
                'numeric',
                'min:0',
            ],
            'region_investments.*.y2020' => [
                'required',
                'numeric',
                'min:0',
            ],
            'region_investments.*.y2021' => [
                'required',
                'numeric',
                'min:0',
            ],
            'region_investments.*.y2022' => [
                'required',
                'numeric',
                'min:0',
            ],
            'region_investments.*.y2023' => [
                'required',
                'numeric',
                'min:0',
            ],
            'financial_accomp_na' => [
                'sometimes',
                'bool'
            ],
            'pap_code' => ['required'],
            'ref_tier_id' => ['required','exists:ref_tiers,id'],
            'uacs_code' => ['required'],
            'nep' => ['required','array'],
            'nep.y2017' => ['required'],
            'nep.y2018' => ['required'],
            'nep.y2019' => ['required'],
            'nep.y2020' => ['required'],
            'nep.y2021' => ['required'],
            'nep.y2022' => ['required'],
            'gaa' => ['required','array'],
            'gaa.y2017' => ['required'],
            'gaa.y2018' => ['required'],
            'gaa.y2019' => ['required'],
            'gaa.y2020' => ['required'],
            'gaa.y2021' => ['required'],
            'gaa.y2022' => ['required'],
            'disbursement' => ['required','array'],
            'disbursement.y2017' => ['required'],
            'disbursement.y2018' => ['required'],
            'disbursement.y2019' => ['required'],
            'disbursement.y2020' => ['required'],
            'disbursement.y2021' => ['required'],
            'disbursement.y2022' => ['required'],
            'infra_sectors' => ['sometimes','array'],
            'infra_sectors.*' => ['exists:ref_infra_sectors,id'],
            'prerequisites.*' => ['exists:ref_prerequisites,id'],
            'risk' => [
                'sometimes',
                'string',
                'max:255',
            ],
            'fs_infrastructures' => [
                'required',
                'array'
            ],
            'fs_infrastructures.*.ref_fund_source_id' => [
                'required',
                'exists:ref_fund_sources,id',
            ],
            'fs_infrastructures.*.y2016' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_infrastructures.*.y2017' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_infrastructures.*.y2018' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_infrastructures.*.y2019' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_infrastructures.*.y2020' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_infrastructures.*.y2021' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_infrastructures.*.y2022' => [
                'required',
                'numeric',
                'min:0',
            ],
            'fs_infrastructures.*.y2023' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }
}
