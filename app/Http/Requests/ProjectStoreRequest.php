<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'description'   => ['required','string','max:255'],
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
                'sometimes',
                'date',
            ],
            'pip' => [
                'required',
                'bool',
            ],
            'ref_pip_typology_id' => [
                'sometimes',
                'exists:ref_pip_typologies,id',
            ],
            'cip' => [
                'required',
                'bool',
            ],
            'ref_cip_type_id' => [
                'sometimes',
                'exists:ref_cip_types,id',
            ],
            'trip' => [
                'required',
                'bool',
            ],
            'total_cost' => [
                'required',
                'numeric',
                'min:0',
            ],
            'risk' => [
                'sometimes',
                'string',
                'max:255',
            ],

        ];
    }
}
