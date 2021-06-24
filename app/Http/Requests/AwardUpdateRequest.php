<?php

namespace App\Http\Requests;

use App\Models\Award;
use App\Models\ClinicManagers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AwardUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $allowedManager = \implode(',', ClinicManagers::$managerTypes);

        return [
            'name'        => ['required', 'min:3', 'string',
                Rule::unique('awards')->ignore($this->award->id)
            ],
            'order'       => ['required', 'numeric', 'min:1', 'max:100'],
            'office_type' => ['required', Rule::in([
                    'department', 'clinic',
                ])],
            'period_type'             => ['required', Rule::in(array_keys(Award::$periods))],
            'always_visible'          => ['nullable'],
            'description'             => ['nullable', 'string'],
            'starting_at'             => ['nullable', 'date_format:d/m/Y'],
            'ending_at'               => ['nullable', 'date_format:d/m/Y'],
            'clinic_managers_shown'   => ['nullable'],
            'clinic_managers_shown.*' => ['nullable', 'string',
                    Rule::in(\array_keys(ClinicManagers::$managerTypes))],
            'nominations'                    => ['required', 'min:1'],
            'nominations.*'                  => ['required', 'numeric'],
            'number_of_nomination_to_select' => ['nullable', 'numeric', 'min:1'],
            'nomination_category_text'       => ['nullable', 'string', 'min:3'],
            'additional_field.*'             => ['nullable', 'string']

        ];
    }
}
