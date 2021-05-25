<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'roles',
        'roles_can_access_for_nomination',
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
        'roles'       => 'array',
    ];

    /**
     * Formats data for insert
     *
     * @param array $data
     * @return array
     */
    public function formatData(array $data) :array
    {
        $format['options'] = [];
        $format['fields']  = [];

        $format['name']        = \trim(\filter_var($data['name'], FILTER_SANITIZE_STRING));
        $format['description'] = \trim(\filter_var($data['description'], FILTER_SANITIZE_STRING));
        $format['order']       = (int) $data['order'];
        $format['period_type'] = (int) $data['period_type'];

        $startingAt = \DateTime::createFromFormat('d/m/Y', $data['starting_at']);
        $endingAt   = \DateTime::createFromFormat('d/m/Y', $data['ending_at']);

        $format['starting_at'] = $startingAt->format('Y-m-d H:i:s');
        $format['ending_at']   = $endingAt->format('Y-m-d H:i:s');

        if(isset($data['always_visible']) && $data['always_visible'] === 'true')
        {
            $format['always_visible'] = true;
        }

        $format['options']['office_type'] = $data['office_type'];

        if($data['office_type'] === 'clinic')
        {
            $format['options']['clinic_managers_shown'] = $data['clinic_managers_shown'];
        }

        if(isset($data['nominations']))
        {
            $format['options']['nominations']['categories'] = $data['nominations'];

            $nominationsCount = count($data['nominations']);

            $minimum = $data['number_of_nomination_to_select'];

            if($nominationsCount === 1 || $nominationsCount < $data['number_of_nomination_to_select'])
            {
                $minimum = 1;
            }

            $nominationText = \trim(\filter_var($data['nomination_category_text'], FILTER_SANITIZE_STRING));

            $nominationText = $data['nomination_category_text'] !== '' ?
                $data['nomination_category_text'] : 'Reason for nomination';

            $format['options']['nominations']['minimum'] = $minimum;
            $format['options']['nominations']['text']    = $nominationText;
        }

        if(isset($data['additional_field']))
        {
            foreach($data['additional_field'] as $field)
            {
                if($field !== '')
                {
                    $format['fields'][] = \filter_var($field, FILTER_SANITIZE_STRING);
                }
            }

            $fieldsMinimum = $data['number_of_fields_to_fill'];

            if($fieldsMinimum > count($data['additional_field']))
            {
                $fieldsMinimum = 1;
            }

            $format['options']['fields_minimum'] = 1;
        }

        if(isset($data['roles']))
        {
            $format['roles'] = array_filter( $data['roles'], 'is_numeric');
        }


        $format['roles_can_access_for_nomination'] = null;

        if(isset($data['roles_can_access_for_nomination'])
            && ! \in_array('all', $data['roles_can_access_for_nomination']))
        {
            $format['roles_can_access_for_nomination'] =
            array_filter( $data['roles_can_access_for_nomination'], 'is_numeric');
        }

        return $format;
    }

    /**
     * Get the nomination options for the award.
     *
     * @return string
     */
    public function getNominationsAttribute() :string
    {
        $text = '';

        if(!isset($this['options']['nominations']))
        {
            return "/";
        }

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

    /**
     * Get all of the submittedNominations for the Award
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submittedNominations(): HasMany
    {
        return $this->hasMany(AwardNomination::class);
    }
}
