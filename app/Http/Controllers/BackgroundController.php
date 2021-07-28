<?php

namespace App\Http\Controllers;

use App\Models\Background;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backgrounds/index', [
            'images'     => Storage::files('public/backgrounds'),
            'background' => Background::first(),
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

        $directory = 'public/backgrounds';

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = request()->all();
        $file = \filter_var($data['file'], \FILTER_SANITIZE_STRING);

        $file = \pathinfo($file);

        if($file['basename'])
        {
            $background = Background::first();

            if(!$background)
            {
                $background = new Background();
            }

            $background->default = $file['basename'];

            $background->save();

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
        $file = \filter_var($data['file'], \FILTER_SANITIZE_STRING);

        if(Storage::delete($file))
        {
            $file       = \pathinfo($file);
            $background = Background::first();

            if($background && ($background->default === $file['basename']))
            {
                $background->default = null;
                $background->update();
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
