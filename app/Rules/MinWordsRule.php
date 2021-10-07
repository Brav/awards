<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinWordsRule implements Rule
{

    /**
     * Minimum number of words
     *
     * @var int
     */
    private $minWords;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($minWords = 15)
    {
        $this->minWords = $minWords;
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
        return \str_word_count($value) >= $this->minWords;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute cannot be less than ' . $this->minWords . ' words.';
    }
}
