<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NominationCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get all of the nominations for the NominationCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nominations(): HasMany
    {
        return $this->hasMany(Nomination::class, 'nomination_category_id', 'id');
    }

    /**
     *
     * @param array $options
     * @return string
     */
    public function nomination(array $options) :string
    {
        $categoryKey  = array_search($this->id, array_column($options, 'category'));
        $nominationID = $options[$categoryKey]['nomination'];

        $nomination = $this->nominations->first(function($item) use ($nominationID)
        {
            return $item->id = $nominationID;
        });

        if($nomination->count())
        {
            return $nomination->name;
        }

        return '/';
    }
}
