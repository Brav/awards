<?php

namespace App\Http\Controllers;

use App\Models\Award;
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
        $today = date('Y-m-d');
        $awards = Award::where('always_visible', '=', true)
            ->orWhereRaw('(starting_at <= ? AND ending_at >= ?)', [$today, $today])
            ->orderBy('order')
            ->get();

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
