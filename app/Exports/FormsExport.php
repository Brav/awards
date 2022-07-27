<?php

namespace App\Exports;

use App\Models\Award;
use App\Models\AwardNomination;
use App\Models\ClinicManagers;
use App\Models\NominationCategory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FormsExport implements FromView
{
    protected $award;

    function __construct (Award $award)
    {
        $this->award = $award;
    }

    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     $userClinics = null;

    //     if(auth()->user()->admin !== 1)
    //     {
    //         $userID  = auth()->id();
    //         $clinics = Clinic::query();

    //         foreach ($clinics as $field )
    //         {
    //             $clinics->orWhere($field, '=', $userID);
    //         }

    //         $userClinics = $clinics->get();
    //     }

    //     $forms = ComplaintForm::when(auth()->user()->admin !== 1, function($query) use($userClinics){
    //         return $query->whereIn('clinic_id', $userClinics->pluck('id')->toArray());
    //     })
    //     ->with(['clinic', 'location', 'category', 'type', 'channel'])
    //     ->get();

    //     return $forms;
    // }

    public function view(): View
    {
        $award = $this->award;

        if($award)
        {
            if ($award->options['office_type'] === 'clinic')
            {
                $with = [
                    'clinic',
                    'clinic.managers' => function($query) use ($award)
                    {
                        return
                            $query->whereIn('manager_type_id', $award['options']['clinic_managers_shown'] ?? []);
                    },
                    'clinic.managers.user',];
            }
            else
            {
                $with = [
                    'department',
                    'department.manager',];
            }

            $filterOptions = ['options' => [
                'max_range' => date('Y'),
            ]];

            $year    = request()->get('year');
            $month   = request()->get('month');
            $status  = request()->get('status');
            $clinic  = request()->get('clinic');
            $nominee = \filter_var(request()->get('nominee'));

            $items =
                AwardNomination::with($with)
                ->where('award_id', '=', (int) $award->id)
                ->when(filter_var($year, \FILTER_VALIDATE_INT, $filterOptions), function($query) use($year){
                    return $query->whereYear('created_at', '=', $year);
                })
                ->when(filter_var($month, \FILTER_VALIDATE_INT, [
                    'min_range' => 1,
                    'max_range' => 12,
                ]), function($query) use($month){
                    return $query->whereMonth('created_at', '=', $month);
                })
                ->when($status !== 'all', function($query) use ($status)
                {
                    $status = $status === 'winners' ? true : false;

                    return $query->where('winner', '=', $status);
                })
                ->when($clinic !== 'select' && \is_numeric($clinic),
                    function($query) use ($clinic)
                {
                    return $query->where('clinic_id', '=', $clinic);
                })
                ->when($nominee !== 'select' && $nominee !== '',
                    function($query) use ($nominee)
                {
                    return $query->where('nominee', '=', $nominee);
                })
                ->orderBy('created_at', 'DESC')
                ->get();

            if(isset($award['options']['nominations']['categories']))
            {
                $nominationCategories = NominationCategory::withTrashed()
                ->with(['nominations'])
                ->find($award['options']['nominations']['categories']);
            }

        }

    return view('exports.forms', [
            'items'                => $items,
            'award'                => $award,
            'actions'              => false,
            'managers'             => $award['options']['clinic_managers_shown'] ?? [],
            'managersRelationMap'  => ClinicManagers::$managersRelationMap,
            'managerTypes'         => ClinicManagers::$managerTypes,
            'managersLabel'        => ClinicManagers::$managersLabel,
            'nominationCategories' => $nominationCategories ?? [],
            'supportOfficeValues'  => AwardNomination::$supportOfficeValue,
        ]);
    }
}
