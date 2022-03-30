<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AwardNomination extends Model
{

    public $timestamps = true;

    /**
     * Support office values
     *
     * @var array
     */
    public static $supportOfficeValue = [
        1 => 'We Act with Integrity',
        2 => 'We Inspire Excellence',
        3 => 'We Build Community',
        4 => 'We Genuinely Care',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_logged',
        'member_logged_email',
        'nominee',
        'support_office_value',
        'support_office_description',
        'award_id',
        'clinic_id',
        'department_id',
        'options',
        'fields',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array',
        'fields'  => 'array',
    ];

    /**
     * Formats data for insert
     *
     * @param array $data
     * @return array
     */
    public function formatData(array $data) :array
    {
        $format = [];

        $format['options'] = [];
        $format['fields']  =  [];

        $format['member_logged']       = \filter_var($data['member_logged'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $format['member_logged_email'] = \filter_var($data['member_logged_email'], FILTER_SANITIZE_EMAIL);
        $format['nominee']             = \filter_var($data['nominee'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $format['award_id']      = (int) $data['award_id'];
        $format['clinic_id']     = isset($data['clinic_id']) ? (int) $data['clinic_id'] : null;
        $format['department_id'] = isset($data['department_id']) ? (int) $data['department_id'] : null;

        $format['support_office_value']       = $data['support_office_value'] ?? null;
        $format['support_office_description'] = '';

        if(isset($data['support_office_description']))
        {
            $format['support_office_description'] = \filter_var($data['support_office_description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        if(isset($data['nominations']))
        {
            foreach ($data['nominations'] as $value)
            {
                /**
                 * Nomination value is save as $nominationCategoryID|$nominatioID
                 */
                $nominations = \explode('|', $value);

                $format['options'][] = [
                    'category'   => $nominations[0],
                    'nomination' => $nominations[1],
                ];
            }
        }

        $format['options'] = $format['options'];

        if(isset($data['fields']))
        {
            $fields = \array_filter($data['fields']);

            foreach ($fields as $key => $value)
            {
                $format['fields'][$key] =  \trim(\filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            }
        }

        return $format;
    }

    /**
     * Get the award that owns the AwardNomination
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function award(): BelongsTo
    {
        return $this->belongsTo(Award::class);
    }

    /**
     * Get the clinic associated with the AwardNomination
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }

    /**
     * Get the department associated with the AwardNomination
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get all of the winner for the AwardNomination
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function winnerShown(): HasOne
    {
        return $this->HasOne(Winner::class);
    }
}
