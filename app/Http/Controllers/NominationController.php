<?php

namespace App\Http\Controllers;

use App\Http\Requests\NominationCreateRequest;
use App\Http\Requests\NominationUpdateRequest;
use App\Models\Nomination;
use App\Models\NominationCategory;
use Illuminate\Http\Request;

class NominationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nominations = Nomination::with(['category'])->paginate(20);

        if(!request()->ajax())
        {
            $categories  = NominationCategory::paginate(20);

            return view('nominations/index', [
                'nominations' => $nominations,
                'categories'  => $categories,
            ]);
        }

        return [
            'html' => view('nominations/partials/_container', [
                'nominations' => $nominations,
            ])->render(),
            'pagination' => view('pagination', [
                'paginator' => $nominations,
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'nominations',
                'container' => 'nominations-container',
            ])->render(),
            'id' => 'nomination'
        ];

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(
            view('form-ajax', [
                'task'       => 'create',
                'view'       => 'nominations',
                'categories' => NominationCategory::all(),
            ])->render()
        , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NominationCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NominationCreateRequest $request)
    {
        $nomination = Nomination::create($request->all());

        return response()->json(
            view('nominations/partials/_nomination', [
                'nomination' => $nomination,
            ])->render()
            , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function show(Nomination $nomination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function edit(Nomination $nomination)
    {
        return response()->json(
            view('form-ajax', [
                'task'       => 'edit',
                'view'       => 'nominations',
                'nomination' => $nomination,
                'categories' => NominationCategory::all(),
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NominationUpdateRequest  $request
     * @param  \App\Models\Nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function update(NominationUpdateRequest $request, Nomination $nomination)
    {
        $nomination->update($request->all());

        return response()->json(
            view('nominations/partials/_nomination', [
                'nomination' => $nomination,
            ])->render()
            , 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function delete(Nomination $nomination)
    {
        return view('modals/partials/_delete', [
            'id'        => $nomination->id,
            'routeName' => route('nominations.destroy', $nomination->id),
            'itemName'  => $nomination->name,
            'table'     => 'nominations-table',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nomination $nomination)
    {
        if($nomination->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
