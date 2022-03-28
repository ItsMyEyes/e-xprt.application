<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Peserta;
use App\Models\Tender;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tender = Tender::count();
        $tenaga = Peserta::count();
        $user = User::count();
        $notifikasi = Notification::where('to', auth()->user()->role)->count();
        return view('home', compact('tender','tenaga','user','notifikasi'));
    }
}
