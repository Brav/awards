<?php

namespace App\Http\Requests;

use App\Models\Award;
use App\Models\AwardNomination;
use App\Models\Clinic;
use App\Models\Department;
use App\Rules\AdditionalFields;
use App\Rules\MinWordsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AwardNominationCreateRequest extends FormRequest
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
        $minimum       = (int) request()->post('_minimum');

        \array_filter(request()->post('fields') ?? []);

        return [
            'award_id'            => ['required',
                Rule::in(Award::all()->pluck('id')->toArray())
            ],
            'member_logged'       => ['required', 'min:3', 'string'],
            'member_logged_email' => ['required', 'email'],
            'clinic_id'           => ['required_without:department_id',
                Rule::in(Clinic::all()->pluck('id')->toArray())
            ],
            'department_id'       => ['required_without:clinic_id',
                Rule::in(Department::all()->pluck('id')->toArray())
            ],
            'support_office_value'       => ['nullable',
                Rule::in( \array_keys(AwardNomination::$supportOfficeValue))
            ],
            'support_office_description' => ['nullable', 'string', 'min:3'],
            'nominee'       => ['required', 'min:3', 'string'],
            'nominations'   => ['nullable', 'min:' . $minimum],
            'nominations.*' => ['nullable','string'],
            // 'fields'        => ['nullable', 'between:' . $minimumFields . ',5', 'array'],
            'fields'   => ['array', 'nullable', new AdditionalFields],
            'fields.*' => ['nullable', 'string', new MinWordsRule],
        ];
    }


    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array
 */
public function messages()
{
    return [
        'member_logged.required'       => 'Name of the team member logging the nomination is required',
        'member_logged.min'            => 'Name needs to have at 3 characters',
        'member_logged_email.required' => 'Email of the team member logging the nomination is required',
        'member_logged_email.email'    => 'Please enter valid email for the team member',
        'nominee.required'             => 'Name of the nominee is required',
    ];
}
}
