<?php

namespace App\Http\Controllers;

use App\Http\Requests\AwardNominationCreateRequest;
use App\Models\Award;
use App\Models\AwardNomination;
use App\Models\Clinic;
use App\Models\ClinicManagers;
use App\Models\Department;
use App\Models\NominationCategory;
use Illuminate\Http\Request;

class AwardNominationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string|null $awardID
     * @return \Illuminate\Http\Response
     */
    public function index(Award $award = null)
    {
        $items = null;

        if($award)
        {
            if ($award->options['office_type'] === 'clinic')
            {
                $with = [
                    'clinic',
                    'clinic.managers' => function($query) use ($award)
                    {
                        return
                            $query->whereIn('manager_type_id', $award['options']['clinic_managers_shown']);
                    },
                    'clinic.managers.user',];
            }
            else
            {
                $with = [
                    'department',
                    'department.manager',];
            }

            $items =
                AwardNomination::with($with)
                ->where('award_id', '=', (int) $award->id)->paginate(20);

            if(isset($award['options']['nominations']['categories']))
            {
                $nominationCategories = NominationCategory::with(['nominations'])
                ->find($award['options']['nominations']['categories']);
            }

        }

        return view('award-nominations/index', [
            'items'               => $items,
            'award'               => $award,
            'managers'             => $award['options']['clinic_managers_shown'] ?? [],
            'managersRelationMap'  => ClinicManagers::$managersRelationMap,
            'managerTypes'         => ClinicManagers::$managerTypes,
            'managersLabel'        => ClinicManagers::$managersLabel,
            'nominationCategories' => $nominationCategories ?? [],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $award)
    {
        $award = Award::where('name', 'like', '%' . \str_replace('_', ' ', $award))
            ->firstOrFail();

        $awardOffice = $award['options']['office_type'];

        if($awardOffice === 'clinic')
        {
            $offices = Clinic::with([
                'managers' => function($query) use ($award)
                {
                    return
                        $query->whereIn('manager_type_id', $award['options']['clinic_managers_shown']);
                },
                'managers.user'])
                ->orderBy('name', 'asc')
                ->get();
        }
        else
        {
            $offices = Department::with(['manager'])->orderBy('name')->get();
        }

        if(isset($award['options']['nominations']['categories']))
        {
            $nominationCategories = NominationCategory::with(['nominations'])
            ->find($award['options']['nominations']['categories']);
        }

        return view('form', [
            'task'                 => 'create',
            'view'                 => 'award-nominations',
            'award'                => $award,
            'offices'              => $offices,
            'awardOffice'          => $awardOffice,
            'managers'             => $award['options']['clinic_managers_shown'] ?? [],
            'managersRelationMap'  => ClinicManagers::$managersRelationMap,
            'managerTypes'         => ClinicManagers::$managerTypes,
            'managersLabel'        => ClinicManagers::$managersLabel,
            'nominationCategories' => $nominationCategories ?? [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AwardNominationCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AwardNominationCreateRequest $request)
    {
        $model = new AwardNomination();

        $data = $model->formatData($request->all());

        $result = $model->create($data);

        return redirect()->route('home')->with([
            'status' => [
                'message' => $result ? 'Thank you for submiting your nomination' : 'Something went wrong!',
                'type'    => $result ? 'success' : 'error',
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AwardNomination  $awardNomination
     * @return \Illuminate\Http\Response
     */
    public function show(AwardNomination $awardNomination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AwardNomination  $awardNomination
     * @return \Illuminate\Http\Response
     */
    public function edit(AwardNomination $awardNomination)
    {
        $award = Award::findOrFail($awardNomination->id);

        $awardOffice = $award['options']['office_type'];

        if($awardOffice === 'clinic')
        {
            $offices = Clinic::with([
                'managers' => function($query) use ($award)
                {
                    return
                        $query->whereIn('manager_type_id', $award['options']['clinic_managers_shown']);
                },
                'managers.user'])
                ->orderBy('name', 'asc')
                ->get();
        }
        else
        {
            $offices = Department::with(['manager'])->orderBy('name')->get();
        }

        $nominationCategories = NominationCategory::with(['nominations'])
            ->find($award['options']['nominations']['categories']);

        return view('form', [
            'item'                 => $awardNomination,
            'task'                 => 'edit',
            'view'                 => 'award-nominations',
            'award'                => $award,
            'offices'              => $offices,
            'awardOffice'          => $awardOffice,
            'managers'             => $award['options']['clinic_managers_shown'] ?? [],
            'managersRelationMap'  => ClinicManagers::$managersRelationMap,
            'managerTypes'         => ClinicManagers::$managerTypes,
            'managersLabel'        => ClinicManagers::$managersLabel,
            'nominationCategories' => $nominationCategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AwardNomination  $awardNomination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AwardNomination $awardNomination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AwardNomination  $awardNomination
     * @return \Illuminate\Http\Response
     */
    public function destroy(AwardNomination $awardNomination)
    {
        //
    }
}
