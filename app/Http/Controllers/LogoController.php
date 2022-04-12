<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('logos/index', [
            'images'     => Storage::files('public/logos'),
            'background' => Logo::first(),
        ]);
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'files'   => 'required',
            'files.*' => ['image' , 'mimes:jpeg,png,jpg', 'max:2048',]
        ]);

        $directory = 'public/logos';

        if($request->totalFiles > 0)
        {

            $images = [];

           for ($x = 0; $x < $request->totalFiles; $x++)
           {

               if ($request->hasFile('files' . $x))
                {
                    $file = $request->file('files' . $x);

                    $name = Str::random(16);

                    $images[] = $name;

                    Storage::putFileAs($directory,
                    $file,
                    $name . '.png');

                }

           }

            return response()->json(
                [
                    'success'=>'Images has been uploaded',
                    'images' => $images,
                ]
            );

        }

        return response()->json([
            'Please try again!'
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show(Logo $logo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logo $logo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logo $logo)
    {
        $data = request()->all();
        $file = \filter_var($data['file'], \FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $file = \pathinfo($file);

        if($file['basename'])
        {
            $logo = Logo::first();

            if(!$logo)
            {
                $logo = new Logo();
            }

            $logo->name = $file['basename'];

            $logo->save();

            return response()->json([
                'set!'
            ], 200);
        }

        return response()->json([
            'Something went wrong!'
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $data = request()->all();
        $file = \filter_var($data['file'], \FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(Storage::delete($file))
        {
            $file = \pathinfo($file);
            $logo = Logo::first();

            if($logo)
            {
                if ($logo->name === $file['basename'])
                {
                    $logo->name = null;
                }

                $logo->update();

                // $awards = Award::whereNotNull('background')->get();

                // foreach($awards as $award)
                // {

                // }

                $awards = Award::whereNotNull('background')
                ->get()
                ->filter(function($item) use ($file)
                {
                    if($item->background && isset($item->background['logo']))
                        return $item->background['logo'] === $file['basename'];
                });

                foreach ($awards as $award) {
                    $background = $award->background;

                    $background['logo'] = null;

                    $award->update($background);
                }

            }

            return response()->json([
                'deleted!'
            ], 200);
        };

        return response()->json([
            'Something went wrong!'
        ], 500);
    }
}
