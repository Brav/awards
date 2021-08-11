<?php

namespace App\Http\Controllers;

use App\Http\Requests\WinnerCreateRequest;
use App\Models\Winner;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WinnerCreateRequest $request)
    {
        $model = new Winner();

        $data = $model->formatData($request->all());

        if($model->create($data))
        {
            return response()->json([
                'Added'
            ], 200);
        }

        return response()->json([
            'Error'
        ], 500);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function show(Winner $winner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function edit(Winner $winner)
    {
        return view('form-ajax', [
            'winner' => $winner->load([
                'nomination',
                'nomination.clinic',
                'nomination.award',
            ]),
            'view' => 'winners',
            'task' => 'edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function update(WinnerCreateRequest $request, Winner $winner)
    {
        $data = $winner->formatData($request->all());

        $winner->update($data);

        return response()->json([
            'Update'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Winner $winner)
    {
        if($winner->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
