<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\Department;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Department::with(['manager'])->paginate(20);

        if(!request()->ajax())
        {
            return view('departments/index', [
                'items' => $items,
            ]);
        }

        return [
            'html' => view('departement/partials/_container', [
                'items' => $items,
            ])->render(),
            'pagination' => view('pagination', [
                'paginator' => $items,
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'departments',
                'container' => 'departments-container',
            ])->render(),
            'id' => 'department'
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
                'task'  => 'create',
                'view'  => 'departments',
                'users' => User::all(),
            ])->render()
        , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DepartmentCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentCreateRequest $request)
    {
        $item = Department::create($request->all());

        return response()->json(
            view('departments/partials/_item', [
                'item' => $item,
            ])->render()
            , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return response()->json(
            view('form-ajax', [
                'task'  => 'edit',
                'view'  => 'departments',
                'item'  => $department,
                'users' => User::all(),
            ])->render()
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DepartmentUpdateRequest  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentUpdateRequest $request, Department $department)
    {
        $department->update($request->all());

        return response()->json(
            view('departments/partials/_item', [
                'item' => $department,
            ])->render()
            , 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function delete(Department $department)
    {
        return view('modals/partials/_delete', [
            'id'        => $department->id,
            'routeName' => route('departments.destroy', $department->id),
            'itemName'  => $department->name,
            'table'     => 'departments-table',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        if($department->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
