<?php

namespace App\Http\Controllers;

use App\Http\Requests\AwardCreateRequest;
use App\Http\Requests\AwardUpdateRequest;
use App\Models\Award;
use App\Models\ClinicManagers;
use App\Models\Nomination;
use App\Models\NominationCategory;
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
        $items = Award::orderBy('order', 'ASC')->paginate(20);

        return view('awards/index', [
            'items'   => $items,
            'periods' => Award::$periods,
        ]);
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
            'nominations'    => NominationCategory::orderBy('name')->get(),
            'periods'        => Award::$periods,
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
            'award'          => $award,
            'task'           => 'edit',
            'view'           => 'awards',
            'clinicManagers' => ClinicManagers::$managerTypes,
            'nominations'    => NominationCategory::orderBy('name')->get(),
            'periods'        => Award::$periods,
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function destroy(Award $award)
    {
        //
    }
}
