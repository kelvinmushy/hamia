<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\HamiaFastaMail;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function sendmails(Request $request)
    {

       
        $users = User::all();
  
        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new HamiaFastaMail($user));
        }
  
        return response()->json(['success'=>'Send email successfully.']);
    }
}
