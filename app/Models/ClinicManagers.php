<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Clinic;

class ClinicManagers extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'clinic_id',
        'manager_type_id',
    ];

    /**
     * The users associated with the clinic.
     *
     * @var array
     */
    static $managerTypes = [
        1 => 'lead_vet',
        2 => 'practice_manager',
        3 => 'veterinary_manager',
        4 => 'gm_veterinary_operations',
        5 => 'general_manager',
        6 => 'regional_manager',
        7 => 'gm_vet_services',
        8 => 'other',
    ];

    /**
     * Managers relation map
     *
     * @var array
     */
    static $managersRelationMap = [
        'lead_vet'                 => 'leadVet',
        'practice_manager'         => 'practiseManager',
        'veterinary_manager'       => 'vetManager',
        'gm_veterinary_operations' => 'gmVeterinaryOperation',
        'general_manager'          => 'generalManager',
        'regional_manager'         => 'regionalManager',
        'gm_vet_services'          => 'gmVetsServices',
        'other'                    => 'other',
    ];

    /**
     * Manager Label
     *
     * @var string[]
     */
    static $managersLabel = [
        'lead_vet'                 => 'Lead Vet',
        'practice_manager'         => 'Practise Manager',
        'veterinary_manager'       => 'Veterinary Manager',
        'gm_veterinary_operations' => 'GM Veterinary Operation',
        'general_manager'          => 'General Manager',
        'regional_manager'         => 'Regional Manager',
        'gm_vet_services'          => 'GM Vets Services',
        'other'                    => 'Other',
    ];

    /**
     *
     * @param \App\Models\Clinic $clinic
     * @param  \App\Http\Requests\ClinicCreateRequest  $request
     * @return void
     */
    static public function saveManagers($clinic, $request)
    {
        $managers = [];

        self::where('clinic_id', '=', $clinic->id)->delete();

        foreach (self::$managerTypes as $key => $type)
        {
            if($request->post($type))
            {
                if($type === 'lead_vet')
                {
                    foreach ($request->post('lead_vet') as $user)
                    {
                        $managers[] = [
                            'clinic_id'       => $clinic->id,
                            'user_id'         => $user,
                            'manager_type_id' => $key,
                        ];
                    }
                }
                else
                {
                    $managers[] = [
                        'clinic_id'       => $clinic->id,
                        'user_id'         => $request->post($type),
                        'manager_type_id' => $key,
                    ];
                }
            }
        }

        self::insert($managers);

    }

    /**
     * Get the clinic that owns the ClinicManagers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }

    /**
     * Get the user that owns the ClinicManagers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Find manager ID
     *
     * @param mixed $name
     * @return int|string|false
     */
    static public function managerID($name)
    {
        return \array_search($name, self::$managerTypes);
    }
}
