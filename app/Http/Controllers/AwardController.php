<?php

namespace App\Http\Controllers;

use App\Http\Requests\AwardCreateRequest;
use App\Http\Requests\AwardUpdateRequest;
use App\Models\Award;
use App\Models\Background;
use App\Models\ClinicManagers;
use App\Models\Nomination;
use App\Models\NominationCategory;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            // ->withTrashed()
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
        $images     = Storage::files('public/backgrounds');
        $background = Background::first();

        if($background)
        {
            $default = 'public/backgrounds/' . $background->default;

            $index = array_search($default, $images);

            unset($images[$index]);

            \array_unshift($images, $default);
        }

        return view('form', [
            'task'           => 'create',
            'view'           => 'awards',
            'clinicManagers' => ClinicManagers::$managerTypes,
            'managersLabels' => ClinicManagers::$managersLabel,
            'nominations'    => NominationCategory::orderBy('name')->get(),
            'periods'        => Award::$periods,
            'roles'          => Roles::all(),
            'images'         => $images,
            'background'     => $background,
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

        if(request()->hasFile('background'))
        {

            $directory = 'public/backgrounds';
            $file = request()->file('background');

            Storage::putFileAs($directory,
                $file,
                $data['background']);

        }

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

        $images     = Storage::files('public/backgrounds');
        $background = Background::first();

        $default = null;

        if($award->background)
        {
            $default = $award->background;
        }
        else
        {
            if($background)
            {
                $default = $background->default;
            }
        }

        if($default)
        {
            $default = 'public/backgrounds/' . $default;

            $index = array_search($default, $images);

            unset($images[$index]);

            \array_unshift($images, $default);
        }

        $defaultBackground = pathinfo($default);

        return view('form', [
            'award'             => $award,
            'task'              => 'edit',
            'view'              => 'awards',
            'clinicManagers'    => ClinicManagers::$managerTypes,
            'managersLabels'    => ClinicManagers::$managersLabel,
            'nominations'       => NominationCategory::orderBy('name')->get(),
            'periods'           => Award::$periods,
            'roles'             => Roles::all(),
            'awardNominations'  => $award['options']['nominations'] ?? null,
            'images'            => $images,
            'background'        => $background,
            'default'           => $default,
            'defaultBackground' => $defaultBackground,
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

        if(request()->hasFile('background'))
        {

            $directory = 'public/backgrounds';
            $file = request()->file('background');

            Storage::putFileAs($directory,
                $file,
                $data['background']);

        }

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
        {
            $name = $award->name . ' deleted';
            $slug =  Str::slug($name);

            $awardExist = Award::where('slug', 'like', '%' . $slug)
            ->orderBy('name', 'DESC')
            ->get();

            if($awardExist->count())
            {
                $last = $awardExist->first();

                $deletedSuffix = explode('||', $last->name);

                if(isset($deletedSuffix[1]))
                {
                    $name = $name . '||' . ($deletedSuffix + 1);
                }
            }

            $award->name = $name;
            $award->slug = Str::slug($name);
            $award->update();

            return response()->json([
                'Deleted'
            ], 200);
        }


        return response()->json([
            'Something went wrong!'
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function deleteBackground(Award $award)
    {
        $data = request()->all();
        $file = \filter_var($data['file'], \FILTER_SANITIZE_STRING);

        if(Storage::delete($file))
        {
            $file = \pathinfo($file);

            if($award->background === $file['basename'])
            {
                $award->background = null;
                $award->update();
            }

            return response()->json([
                'deleted!'
            ], 200);
        };

        return response()->json([
            'Something went wrong!'
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function setBackground(Award $award)
    {

        $data = request()->all();
        $file = \filter_var($data['file'], \FILTER_SANITIZE_STRING);

        $file = \pathinfo($file);

        if($file['basename'])
        {
            $award->background = $file['basename'];
            $award->update();

            return response()->json([
                'set!'
            ], 200);
        }

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
