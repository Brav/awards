<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Award extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'order',
        'always_visible',
        'period_type',
        'starting_at',
        'ending_at',
        'options',
        'fields',
    ];

    static $periods = [
        1 => 'montly',
        2 => 'quarterly',
        3 => 'annual',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'starting_at' => 'datetime',
        'ending_at'   => 'datetime',
        'options'     => 'array',
        'fields'      => 'array',
    ];

    /**
     * Formats data for insert
     *
     * @param array $data
     * @return array
     */
    public function formatData(array $data) :array
    {
        $data['options'] = [];

        $startingAt = \DateTime::createFromFormat('d/m/Y', $data['starting_at']);
        $endingAt   = \DateTime::createFromFormat('d/m/Y', $data['ending_at']);

        $data['starting_at'] = $startingAt->format('Y-m-d H:i:s');
        $data['ending_at']   = $endingAt->format('Y-m-d H:i:s');

        if(isset($data['always_visible']) && $data['always_visible'] === 'true')
        {
            $data['always_visible'] = true;
        }

        $data['options']['office_type'] = $data['office_type'];

        if($data['office_type'] === 'clinic')
        {
            $data['options']['clinic_managers_shown'] = $data['clinic_managers_shown'];
        }

        $data['options']['nominations']['categories'] = $data['nominations'];

        $nominationsCount = count($data['nominations']);

        $minimum = $data['number_of_nomination_to_select'];

        if($nominationsCount === 1 || $nominationsCount < $data['number_of_nomination_to_select'])
        {
            $minimum = 1;
        }

        $nominationText = \trim(\filter_var($data['nomination_category_text'], FILTER_SANITIZE_STRING));

        $nominationText = $data['nomination_category_text'] !== '' ?
            $data['nomination_category_text'] : 'Reason for nomination';

        $data['options']['nominations']['minimum'] = $minimum;
        $data['options']['nominations']['text']    = $nominationText;

        if(isset($data['additional_field']))
        {
            foreach($data['additional_field'] as $field)
            {
                if($field !== '')
                {
                    $data['fields'][] = \filter_var($field, FILTER_SANITIZE_STRING);
                }
            }
        }

        $data['options'] = $data['options'];
        $data['fields']  = $data['fields'] ?? [];

        unset(
            $data['_token'],
            $data['nominations'],
            $data['office_type'],
            $data['number_of_nomination_to_select'],
            $data['nomination_category_text'],
            $data['clinic_managers_shown'],
            $data['additional_field'],
        );

        return $data;
    }

    /**
     * Get the nomination options for the award.
     *
     * @return string
     */
    public function getNominationsAttribute() :string
    {
        $text = '';

        $nominations = $this['options']['nominations'];

        $nominationCategories = NominationCategory::find($nominations['categories']);

        if($nominationCategories->count())
        {
            $text .= 'Categories: ';
            foreach ($nominationCategories as $category)
            {
                $text .= $category->name .', ';
            }

            $text = \rtrim($text, ', ');

            $text .= '<br>';
        }

        $text .= 'Minimum number of nomination categories user needs to select: ' . $nominations['minimum'] . '<br>';

        $text .= 'Text: ' . $nominations['text'];


        return $text;
    }
}
