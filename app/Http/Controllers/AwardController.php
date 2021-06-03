<?php

namespace App\Http\Controllers;

use App\Http\Requests\AwardCreateRequest;
use App\Http\Requests\AwardUpdateRequest;
use App\Models\Award;
use App\Models\ClinicManagers;
use App\Models\Nomination;
use App\Models\NominationCategory;
use App\Models\Roles;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Award::withCount(['submittedNominations'])
            ->when(!auth()->user()->admin, function($query)
            {
                return $query->whereJsonContains('roles', auth()->user()->role_id);
            })
            ->orderBy('order', 'ASC')->paginate(20);

        if(!request()->ajax())
            return view('awards/index', [
                'items'   => $items,
                'periods' => Award::$periods,
            ]);

        return [
            'html' => view('awards/partials/_items', [
                'items' => $items,
            ])->render(),
            'pagination' => view('pagination', [
                'paginator' => $items,
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'awards',
                'container' => 'awards-container',
            ])->render()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form', [
            'task'           => 'create',
            'view'           => 'awards',
            'clinicManagers' => ClinicManagers::$managerTypes,
            'managersLabels' => ClinicManagers::$managersLabel,
            'nominations'    => NominationCategory::orderBy('name')->get(),
            'periods'        => Award::$periods,
            'roles'          => Roles::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AwardCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AwardCreateRequest $request)
    {
        $model = new Award();

        $data = $model->formatData($request->all());

        $result = $model->create($data);

        return redirect()->route('awards.index')->with([
            'status' => [
                'message' => $result ? 'Award Created' : 'Something went wrong!',
                'type'    => $result ? 'success' : 'error',
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function show(Award $award)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function edit(Award $award)
    {
        return view('form', [
            'award'            => $award,
            'task'             => 'edit',
            'view'             => 'awards',
            'clinicManagers'   => ClinicManagers::$managerTypes,
            'managersLabels'   => ClinicManagers::$managersLabel,
            'nominations'      => NominationCategory::orderBy('name')->get(),
            'periods'          => Award::$periods,
            'roles'            => Roles::all(),
            'awardNominations' => $award['options']['nominations'] ?? null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AwardCreateRequest  $request
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function update(AwardUpdateRequest $request, Award $award)
    {

        $data = $award->formatData($request->all());

        $result = $award->update($data);

        return redirect()->route('awards.index')->with([
            'status' => [
                'message' => $result ? 'Award Updated' : 'Something went wrong!',
                'type'    => $result ? 'success' : 'error',
            ],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function delete(Award $award)
    {
        return view('modals/partials/_delete', [
            'id'        => $award->id,
            'routeName' => route('awards.destroy', $award->id),
            'itemName'  => $award->name,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function destroy(Award $award)
    {
        if($award->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
