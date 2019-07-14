<?php

namespace App\Http\Controllers;

use App\Timesheet;
use Illuminate\Http\Request;
use App\User;
use App\Project;
use Illuminate\Support\Facades\Auth;


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
    public function index(Request $request)
    {

        if (Auth::user()->hasRole('Project Manager')) {
            return view('home');
        }
        else{
           // $name = auth()->user()->name;
//            $user = User::find('id', 'name');
//            $timesheetView = Timesheet::all();
            return view('homeUser');
        }
//        , compact('user', 'timesheetView'))
//        ->with('timesheet', $timesheetView);

    }
}
