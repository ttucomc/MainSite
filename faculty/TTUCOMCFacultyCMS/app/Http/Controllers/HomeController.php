<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

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
     * Show the faculty edit screen for the logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('id', '=', Auth::id())->get()->first();
        if($user->made_changes) {
            return view('/waiting-for-approval');
        }

        return view('/home', compact('user'));
    }
}
