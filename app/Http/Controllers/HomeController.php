<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Util\Utils;
use Illuminate\Support\Facades\Session;
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
    public function index()
    {
        Session::put('title', 'Timeline');
        if (Auth::user()->hasRole('Project Manager')) {

            $user = User::join('role', 'users.role_id', '=', 'role.id_role')
                ->select('users.name','role.name')
                ->where('users.name','=',auth()->user()->name)
                ->getQuery()
                ->get();

            return view('home')->with('user', $user);
        }
        else{
           // $name = auth()->user()->name;
//            $user = User::find('id', 'name');
//            $timesheetView = Timesheet::all();
            $user = User::join('role', 'users.role_id', '=', 'role.id_role')
                ->select('users.name','role.name')
                ->where('users.name','=',auth()->user()->name)
                ->getQuery()
                ->get();

            return view('home')->with('user', $user);
        }
//        , compact('user', 'timesheetView'))
//        ->with('timesheet', $timesheetView);

    }
}
