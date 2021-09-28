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
                'sometimes',
                'array',
            ],
            'bases.*' => ['exists:ref_bases,id'],
            'office_id' => ['exists:offices,id'],
            'operating_units' => [
                'sometimes',
                'array',
            ],
            'operating_units.*' => ['exists:ref_operating_units,id'],

        ];
    }
}
