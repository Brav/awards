<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Winner;
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


        $awardWinners = Winner::with([
                'nomination',
                'nomination.clinic',
                'nomination.award',
            ])->get();

        return view('home', [
            'awards'       => $awards,
            'awardWinners' => $awardWinners,
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
