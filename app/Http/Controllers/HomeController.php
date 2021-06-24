<?php

namespace App\Http\Controllers;

use App\Models\Award;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::now()->timezone('Australia/Sydney')->format('Y-m-d H:m');
        $role  = null;

        if (auth()->user() && !auth()->user()->admin)
        {
            $role = auth()->user()->role_id;
        }

        $awards = Award::where('always_visible', '=', true)
            ->orWhereRaw('(starting_at <= ? AND ending_at >= ?)', [$today, $today])
            ->orderBy('order')
            ->get();

        $awards = $awards->filter(function($item) use ($role)
        {

            if(!auth()->user())
            {
                return $item->roles_can_access_for_nomination === null;
            }

            if (!auth()->user()->admin)
            {
                if($item->roles_can_access_for_nomination === null)
                {
                    return $item;
                }

                if(in_array(auth()->user()->role_id, $item->roles_can_access_for_nomination))
                {
                    return $item;
                }

            }

            return $item;


        });

        return view('home', [
            'awards' => $awards,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function thanks()
    {
        return view('thanks');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('home');
    }
}
