<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WinnerCreateRequest extends FormRequest
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
        return [
            'name'                => ['string', 'min:3', 'required',],
            'reason'              => ['string', 'min:3', 'required',],
            'award'               => ['string', 'min:3', 'required'],
            'clinic'              => ['string', 'min:3', 'required'],
            'order'               => ['required', 'numeric'],
            'award_nomination_id' => ['required', 'numeric'],
            'clinic_id'           => ['required', 'numeric'],
            'award_id'            => ['required', 'numeric'],
            'month'            => ['required', 'string'],
            'year'            => ['required', 'string'],
        ];
    }
}
