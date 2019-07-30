<?php

namespace App\Http\Controllers;

use App\Job;
use App\Mail\ReminderEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Util\Utils;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


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

    public function error404(){


        return view('layouts.err404');

    }




    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Session::put('title', 'Timeline');


        $jobs = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'jobs.deadline')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
//            ->where('users.id', '=', auth()->user()->id)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

        $a = auth()->user()->email;

        $seven  = Carbon::now()->addDay(6)->toDateString();
        $third  = Carbon::now()->addDay(2)->toDateString();
        $second = Carbon::now()->addDay(1)->toDateString();
        $today  = Carbon::now()->toDateString();

        $d7 = Job::where('deadline','==', $seven)->get();
        $d3 = Job::where('deadline','==', $third)->get();
        $d2 = Job::where('deadline','==', $second)->get();
        $d1 = Job::where('deadline','==', $today)->get();


//        dd($jobs);

        if($d7){
            Mail::to($a)->send(new ReminderEmail());
        }elseif ($d3){
            Mail::to($a)->send(new ReminderEmail());
        }elseif ($d2){
            Mail::to($a)->send(new ReminderEmail());
        }elseif ($d1){
            Mail::to($a)->send(new ReminderEmail());
        }

//        Mail::to($a)->send(new ReminderEmail());



        if (Auth::user()->hasRole('Project Manager')) {

//            $user = User::join('role', 'users.role_id', '=', 'role.id_role')
//                ->select('users.name','role.name')
//                ->where('users.name','=',auth()->user()->name)
//                ->getQuery()
//                ->get();


            return view('home');
        }
        else{
           // $name = auth()->user()->name;
//            $user = User::find('id', 'name');
//            $timesheetView = Timesheet::all();





            return view('home');
        }
//        , compact('user', 'timesheetView'))
//        ->with('timesheet', $timesheetView);

    }


}
