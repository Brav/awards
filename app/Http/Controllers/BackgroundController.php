<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Background;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Image;

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
            'files.*' => ['image' , 'mimes:jpeg,png,jpg', 'max:20048',]
        ]);

        if($request->totalFiles > 0)
        {

            $images = [];

           for ($x = 0; $x < $request->totalFiles; $x++)
           {

            if ($request->hasFile('files' . $x))
            {
                $images[] = self::upload($request->file('files' . $x));
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
        $file = \filter_var($data['file'], \FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $file = \pathinfo($file);

        if($file['basename'])
        {
            $background = Background::first();

            if(!$background)
            {
                $background = new Background();
            }

            $column = 'award';

            if(request()->post('column') === 'winner')
            {
                $column = 'winner';
            }

            $background->$column = $file['basename'];

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
        $file = \filter_var($data['file'], \FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(Storage::delete($file))
        {
            $file       = \pathinfo($file);
            $background = Background::first();

            if($background)
            {
                if ($background->award === $file['basename'])
                {
                    $background->award = null;
                }

                if ($background->winner === $file['basename'])
                {
                    $background->winner = null;
                }

                $background->update();

                Award::where('background->award', $file['basename'])
                ->update(['background->award' => null]);

                Award::where('background->winner', $file['basename'])
                ->update(['background->winner' => null]);
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
     *
     * @param Illuminate\Http\UploadedFile $image
     * @return string
     * @throws Exception
     */
    static public function upload(UploadedFile $image, ?string $imageName = null): string
    {

        $publicPath = \public_path('media/backgrounds');
        $storagePath = 'public/backgrounds';

        $name = $imageName ?? Str::random(16) . '.png';

        $image = Image::make($image->path());

        $imagePath = $publicPath . '/' . $name;

        $image->resize(350, 215, function ($const) {
            $const->aspectRatio();
        })
        ->encode('png', 75)
        ->save($imagePath);

        Storage::putFileAs($storagePath,
        $imagePath,
        $name);

        \File::delete($imagePath);

        return $name;
    }
}
