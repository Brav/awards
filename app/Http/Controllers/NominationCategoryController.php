<?php

namespace App\Http\Controllers;

use App\Models\Nomination;
use App\Models\NominationCategory;
use Illuminate\Http\Request;

class NominationCategoryController extends Controller
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
        return response()->json(
            view('form-ajax', [
                'task' => 'create',
                'view' => 'nominations-category',
            ])->render()
        , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = NominationCategory::create($request->all());

        return response()->json(
            view('nominations-category/partials/_category', [
                'category' => $category,
            ])->render()
            , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NominationCategory  $nominationCategory
     * @return \Illuminate\Http\Response
     */
    public function show(NominationCategory $nominationCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NominationCategory  $nominationCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(NominationCategory $nominationCategory)
    {
        return response()->json(
            view('form-ajax', [
                'task'     => 'edit',
                'view'     => 'nominations-category',
                'category' => $nominationCategory,
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NominationCategory  $nominationCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NominationCategory $nominationCategory)
    {
        $nominationCategory->update($request->all());

        return response()->json(
            view('nominations-category/partials/_category', [
                'category' => $nominationCategory,
            ])->render()
            , 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\NominationCategory  $nominationCategory
     * @return \Illuminate\Http\Response
     */
    public function delete(NominationCategory $nominationCategory)
    {
        return view('modals/partials/_delete', [
            'id'        => $nominationCategory->id,
            'routeName' => route('nominations-category.destroy', $nominationCategory->id),
            'itemName'  => $nominationCategory->name,
            'table'     => 'nomination-categories-table',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NominationCategory  $nominationCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(NominationCategory $nominationCategory)
    {

        if($nominationCategory->delete())
        {
            Nomination::where('nomination_category_id', '=', $nominationCategory->id)
                ->delete();

            return response()->json([
                'link'       => route('nominations.index'),
                'container'  => 'nominations-container',
                'pagination' => 'pagination-nominations',
            ]);
        }

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
