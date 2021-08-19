<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AdditionalFields implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $minimumFields = (int) request()->post('_fields_minimum');

        $fields = \array_filter($value);

        if(count($fields) < $minimumFields)
            return false;

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Pleasse fill all the required fields.';
    }
}
