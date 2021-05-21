<?php

namespace App\Http\Requests;

use App\Models\Award;
use App\Models\Clinic;
use App\Models\Department;
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
        $minimum = (int) request()->post('_minimum');
        return [
            'award_id'            => ['required',
                Rule::in(Award::all()->pluck('id')->toArray())
            ],
            'member_logged'       => ['required', 'min:3', 'string'],
            'member_logged_email' => ['required', 'email'],
            'clinic_id'           => ['nullable',
                Rule::in(Clinic::all()->pluck('id')->toArray())
            ],
            'department_id'       => ['nullable',
                Rule::in(Department::all()->pluck('id')->toArray())
            ],
            'nominee'       => ['required', 'min:3', 'string'],
            'nominations'   => ['required', 'min:' . $minimum],
            'nominations.*' => ['string'],
            'fields'        => ['nullable'],
            'fields.*'      => ['string', 'min:3'],
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
