<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
class WebNotificationController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('home');
    }
  
    public function storeToken(Request $request)
    {
        auth()->user()->update(['device_key'=>$request->token]);
        return response()->json(['Token successfully stored.']);
    }
}