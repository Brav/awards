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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

        $clinics = \DB::table('clinics')
            ->select('id', 'name')
            ->orderBy('name', 'ASC')
            ->get();

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

            $with[] = 'winnerShown';
            $with[] = 'award';

            $filterOptions = ['options' => [
                'max_range' => date('Y'),
            ]];

            $year    = request()->get('year');
            $month   = request()->get('month');
            $status  = request()->get('status');
            $clinic  = request()->get('clinic');
            $nominee = \filter_var(request()->get('nominee'));

            $items =
                AwardNomination::query()->with($with)
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
                });

            if(isset($award['options']['nominations']['categories']))
            {
                $nominationCategories = NominationCategory::withTrashed()
                ->with(['nominations'])
                ->find($award['options']['nominations']['categories']);
            }

        }

        $data = [
            'clinics'              => $clinics,
            'items'                => $items ? $items->orderBY('created_at', 'DESC')->paginate(20) : $items,
            'award'                => $award,
            'actions'              => true,
            'managers'             => $award['options']['clinic_managers_shown'] ?? [],
            'managersRelationMap'  => ClinicManagers::$managersRelationMap,
            'managerTypes'         => ClinicManagers::$managerTypes,
            'managersLabel'        => ClinicManagers::$managersLabel,
            'supportOfficeValues'  => AwardNomination::$supportOfficeValue,
            'nominationCategories' => $nominationCategories ?? [],
        ];

        if (!request()->ajax())
        {

            $awards = Award::when(!auth()->user()->admin, function($query)
            {
                return $query->whereJsonContains('roles_can_access_for_nomination', auth()->user()->role_id)
                            ->orWhereNull('roles_can_access_for_nomination');
            })
            ->withCount('submittedNominations')
            ->orderBy('name')->get();

            $firstNomination = \DB::table('award_nominations')
                ->select('created_at')
                ->orderBy('created_at', 'ASC')->first();

            return view('award-nominations/index', \array_merge($data, [
                'awards'       => $awards,
                'startingYear' => date('Y', strtotime($firstNomination->created_at)),
                'currentYear'  => date('Y'),
            ]));
        }

        return [
            'html' => view('award-nominations/partials/_table', $data)->render(),
            'pagination' => view('pagination', [
                'paginator' => $items->orderBY('created_at', 'DESC')->paginate(20),
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'award-nominations',
                'container' => 'award-nominations-table',
            ])->render(),
            'container' => 'award-nominations-table',
            'nominees'  => $items->select('nominee')->limit(10000)->get()->sortBy('nominee')->pluck('nominee'),
        ];

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $award)
    {

        if(trim($award) === '')
        {
            abort(404);
        }

        $today = Carbon::now()->timezone('Australia/Sydney')->format('Y-m-d H:m');

        $award = Award::where('slug', '=', $award)
            ->whereRaw('((starting_at <= ? AND ending_at >= ?) OR always_visible = 1)', [$today, $today])
            ->when(auth()->user() && ! auth()->user()->admin, function($query)
            {
                return $query->where(function($queury){
                    $queury->whereJsonContains('roles_can_access_for_nomination', strval(auth()->user()->role_id));
                    $queury->orWhereNull('roles_can_access_for_nomination');
                });
            })
            ->firstOrFail();

        if(auth()->guest() && $award->roles_can_access_for_nomination !== null)
        {
            request()->session()->put('url.intended', route('award-nominations.create', $award->slug));

            return redirect('login');
        }

        if($award->always_visible &&
            $award->starting_at->gt($today)
        )
        {
            return view('award-nominations/comeback-later');
        }

        $awardOffice = $award['options']['office_type'];

        if($awardOffice === 'clinic')
        {
            $offices = Clinic::with([
                'managers' => function($query) use ($award)
                {
                    return
                        $query->whereIn('manager_type_id', $award['options']['clinic_managers_shown'] ?? []);
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
            'supportOfficeValues'  => AwardNomination::$supportOfficeValue,
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
                        $query->whereIn('manager_type_id', $award['options']['clinic_managers_shown'] ?? []);
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
            'supportOfficeValues'  => AwardNomination::$supportOfficeValue,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AwardNomination  $awardNomination
     * @return \Illuminate\Http\Response
     */
    public function changeWinnerStatus(AwardNomination $awardNomination)
    {
        $awardNomination->winner = !$awardNomination->winner;

        if($awardNomination->save())
            return response()->json([
                'status' => $awardNomination->winner,
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);


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
        $fileName = \strtolower(Str::slug($award->name, '_'));
        return Excel::download(new FormsExport($award), $fileName . '.xlsx');
    }
}
