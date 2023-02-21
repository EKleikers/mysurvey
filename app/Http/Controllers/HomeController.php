<?php

namespace App\Http\Controllers;

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
         //if user is Admin return view is landing page with Surveys, MKBs and Reports links
        //if user is SME   return view is landing page  with list of surveys and profile page link
        $user = \Auth::user();
        //dd($user->role);
        if($user->role == "admin")
        {
            return redirect('/surveys');
        }
        else
        {
            return redirect('/home');
        }

     
    }
}
