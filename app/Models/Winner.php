<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Winner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'clinic',
        'award',
        'reason',
        'order',
        'award_nomination_id',
        'clinic_id',
        'created_at',
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

        $format['name']   = \filter_var($data['name'], \FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $format['reason'] = \filter_var($data['reason'], \FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $format['clinic'] = \filter_var($data['clinic'], \FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $format['award']  = \filter_var($data['award'], \FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $format['order']               = \filter_var($data['order'], \FILTER_SANITIZE_NUMBER_INT);
        $format['award_nomination_id'] = \filter_var($data['award_nomination_id'], \FILTER_SANITIZE_NUMBER_INT);
        $format['clinic_id']           = \filter_var($data['clinic_id'], \FILTER_SANITIZE_NUMBER_INT);
        $format['award_id']            = \filter_var($data['award_id'], \FILTER_SANITIZE_NUMBER_INT);

        $clinic = Clinic::find($format['clinic_id']);

        if($clinic->name === $format['clinic'])
        {
            $format['clinic'] = null;
        }

        $award = Award::find($format['award_id']);

        $awardName = trim(strip_tags(
            str_replace(['<br>', '<br />', '<br/>', '</p>'], ' ', $award->name)
        ));

        if($awardName === $format['award'])
        {
            $format['award'] = null;
        }

        $day = Carbon::now()->format("l");
        $month = $data['month'];
        $year = $data['year'];

        $date = $day . '-' . $month . '-' . $year;

        $format['created_at'] = Carbon::createFromFormat('l-n-Y', $date)->format('Y-m-d H:i:s');

        return $format;

    }

    /**
     * Return award name
     *
     * @return string
     */
    public function getAwardName($withHTML = false) :string
    {
        if($this->award)
            return $this->award;

        return $withHTML ? $this->nomination->award->name :
            trim(trim(strip_tags(
                str_replace(['<br>', '<br />', '<br/>', '</p>'], ' ', $this->nomination->award->name)
                )) );
    }

    /**
     * Return award name
     *
     * @return string
     */
    public function getClinicNameAttribute() :string
    {
        return $this->clinic ??
        optional($this->nomination->clinic)->name ??
        $this->nomination->department->name;
    }

    /**
     * Get the nomination that owns the Winner
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nomination(): BelongsTo
    {
        return $this->belongsTo(AwardNomination::class, 'award_nomination_id', 'id');
    }
}
