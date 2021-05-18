<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Department extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'manager_id',
    ];

    /**
     * Get the manager associated with the Department
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function manager(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'manager_id');
    }
}
