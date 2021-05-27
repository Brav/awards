<?php

namespace App\Http\Controllers;

use App\Exports\FormsExport;
use App\Http\Requests\AwardNominationCreateRequest;
use App\Models\Award;
use App\Models\AwardNomination;
use App\Models\Clinic;
use App\Models\ClinicManagers;
use App\Models\Department;
use App\Models\NominationCategory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

        if(!auth()->user()->admin && $award)
        {
            if(! \in_array(auth()->user()->role_id, $award->roles))
            {
                abort(404);
            }
        }

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

            $filterOptions = ['options' => [
                'max_range' => date('Y'),
            ]];

            $year = request()->get('year');

            $items =
                AwardNomination::with($with)
                ->where('award_id', '=', (int) $award->id)
                ->when(filter_var($year, \FILTER_VALIDATE_INT, $filterOptions), function($query) use($year){
                    return $query->whereYear('created_at', '=', $year);
                })
                ->paginate(20);

            if(isset($award['options']['nominations']['categories']))
            {
                $nominationCategories = NominationCategory::with(['nominations'])
                ->find($award['options']['nominations']['categories']);
            }

        }

        if (!request()->ajax())
        {

            $awards = Award::whereJsonContains('roles_can_access_for_nomination', auth()->user()->role_id)
            ->orWhereNull('roles_can_access_for_nomination')
            ->withCount('submittedNominations')
            ->orderBy('name')->get();

            $firstNomination = AwardNomination::orderBy('created_at', 'DESC')->first();

            return view('award-nominations/index', [
                'items'                => $items,
                'award'                => $award,
                'actions'              => true,
                'managers'             => $award['options']['clinic_managers_shown'] ?? [],
                'managersRelationMap'  => ClinicManagers::$managersRelationMap,
                'managerTypes'         => ClinicManagers::$managerTypes,
                'managersLabel'        => ClinicManagers::$managersLabel,
                'nominationCategories' => $nominationCategories ?? [],
                'awards'               => $awards,
                'startingYear'         => $firstNomination->created_at->format('Y'),
                'currentYear'          => date('Y'),
            ]);
        }

        return [
            'html' => view('award-nominations/partials/_table', [
                'items'                => $items,
                'award'                => $award,
                'actions'              => true,
                'managers'             => $award['options']['clinic_managers_shown'] ?? [],
                'managersRelationMap'  => ClinicManagers::$managersRelationMap,
                'managerTypes'         => ClinicManagers::$managerTypes,
                'managersLabel'        => ClinicManagers::$managersLabel,
                'nominationCategories' => $nominationCategories ?? [],
            ])->render(),
            'pagination' => view('pagination', [
                'paginator' => $items,
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'award-nominations',
                'container' => 'award-nominations-container',
            ])->render()
        ];

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $award)
    {
        $today = date('Y-m-d');

        $award = Award::where('name', 'like', '%' . \str_replace('_', ' ', $award))
            ->where('always_visible', '=', true)
            ->orWhereRaw('(starting_at <= ? AND ending_at >= ?)', [$today, $today])
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

        if(!$result)
        {
            return redirect()->back()->withInput()
            ->with([
                'status' => [
                    'message' => 'Something went wrong!',
                    'type'    => 'error',
                ],
            ]);
        }

        return redirect()->route('thanks');
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
        abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\AwardNomination  $award
     * @return \Illuminate\Http\Response
     */
    public function delete(AwardNomination $awardNomination)
    {
        return view('modals/partials/_delete', [
            'id'        => $awardNomination->id,
            'routeName' => route('award-nominations.destroy', $awardNomination->id),
            'itemName'  => $awardNomination->name,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AwardNomination  $awardNomination
     * @return \Illuminate\Http\Response
     */
    public function destroy(AwardNomination $awardNomination)
    {
        if($awardNomination->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }

    public function export(Award $award)
    {
        $fileName = \strtolower(\str_replace(' ', '_', $award->name));
        return Excel::download(new FormsExport($award), $fileName . '.xlsx');
    }
}
