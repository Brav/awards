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
        $images       = Storage::files('public/backgrounds');
        $logos        = Storage::files('public/logos');
        $background   = Background::first();
        $awardImages  = $images;
        $winnerImages = $images;
        $logoImages   = $logos;

        if($background)
        {
            if($background->award)
            {
                $award = 'public/backgrounds/' . $background->award;

                $index = array_search($award, $awardImages);

                unset($awardImages[$index]);

                \array_unshift($awardImages, $award);
            }

            if($background->winner)
            {
                $winner = 'public/backgrounds/' . $background->winner;

                $index = array_search($winner, $winnerImages);

                unset($winnerImages[$index]);

                \array_unshift($winnerImages, $winner);
            }

        }

        if($logos)
        {
            if($background->logo)
            {
                $logo = 'public/logos/' . $background->logo;

                $index = array_search($logo, $logos);

                unset($logos[$index]);

                \array_unshift($logoImages, $logo);
            }

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
            'awardImages'    => $awardImages,
            'winnerImages'   => $winnerImages,
            'logos'          => $logoImages,
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

        if(request()->hasFile('logo'))
        {
            $directory = 'public/logos';
            $file = request()->file('logo');

            Storage::putFileAs($directory,
                $file,
                $data['logo']);
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

        $images       = Storage::files('public/backgrounds');
        $logos        = Storage::files('public/logos');
        $background   = Background::first();
        $awardImages  = $images;
        $winnerImages = $images;
        $logoImages   = $logos;

        $defaultAward  = null;
        $defaultWinner = null;
        $defaultLogo   = null;

        if($award->background)
        {
            if($award->background['award'])
            {
                $defaultAward = $award->background['award'];
            }
            else
            {
                if($background)
                {
                    $defaultAward = $background->award;
                }
            }

            if($award->background['winner'])
            {
                $defaultWinner = $award->background['winner'];
            }
            else
            {
                if($background)
                {
                    $defaultWinner = $background->winner;
                }
            }

            if(isset($award->background['logo']) && $award->background['logo'])
            {
                $defaultLogo = $award->background['logo'];
            }
            else
            {
                if($background)
                {
                    $defaultLogo = $background->winner;
                }
            }
        }

        if($background)
        {

            $awardImageSet  = $defaultAward ?? $background->award;
            $winnerImageSet = $defaultWinner ?? $background->winner;

            if($awardImageSet)
            {
                $image = 'public/backgrounds/' . $awardImageSet;

                $index = array_search($image, $awardImages);

                unset($awardImages[$index]);

                \array_unshift($awardImages, $image);
            }

            if($winnerImageSet)
            {
                $winner = 'public/backgrounds/' . $winnerImageSet;

                $index = array_search($winner, $winnerImages);

                unset($winnerImages[$index]);

                \array_unshift($winnerImages, $winner);
            }

        }

        if($logos)
        {
            if($background->logo)
            {
                $logo = 'public/logos/' . $background->logo;

                $index = array_search($logo, $logos);

                unset($logos[$index]);

                \array_unshift($logoImages, $logo);
            }

        }

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
            'images'           => $images,
            'background'       => $background,
            'defaultAward'     => $defaultAward,
            'defaultWinner'    => $defaultWinner,
            'defaultLogo'      => $defaultLogo,
            'awardImages'      => $awardImages,
            'winnerImages'     => $winnerImages,
            'logos'            => $logoImages,
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

        if(request()->hasFile('logo'))
        {
            $directory = 'public/logos';
            $file = request()->file('logo');

            Storage::putFileAs($directory,
                $file,
                $data['logo']);
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
        $file = \filter_var($data['file'], \FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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
        $file = \filter_var($data['file'], \FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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
