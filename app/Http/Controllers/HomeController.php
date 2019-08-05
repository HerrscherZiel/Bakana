<?php

namespace App\Http\Controllers;

use App\Job;
use App\Mail\ReminderEmail;
use App\Module;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Util\Utils;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use MaddHatter\LaravelFullcalendar\Calendar;


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

        $q = 0;


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

        $seven  = Carbon::now()->addDay(7)->toDateString();
        $third  = Carbon::now()->addDay(3)->toDateString();
        $second = Carbon::now()->addDay(2)->toDateString();
        $first  = Carbon::now()->addDay(1)->toDateString();
        $today  = Carbon::now()->toDateString();

//        $d7 = Job::where('deadline','==', $seven)->get();
//        $d3 = Job::where('deadline','==', $third)->get();
//        $d2 = Job::where('deadline','==', $second)->get();
//        $d1 = Job::where('deadline','==', $first)->get();
//        $d0 = Job::where('deadline','==', $today)->get();

        $d7 = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
            ->where('project.status', '!=', 4)
            ->where('jobs.deadline','=', $seven)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

        $d3 = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
            ->where('project.status', '!=', 4)
            ->where('jobs.deadline','=', $third)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

        $d2 = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
            ->where('project.status', '!=', 4)
            ->where('jobs.deadline','=', $second)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

        $d1 = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
            ->where('project.status', '!=', 4)
            ->where('jobs.deadline','=', $first)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

        $d0 = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
            ->where('project.status', '!=', 4)
            ->where('jobs.deadline','<=', $today)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

//        $h = $jobs;

//        dd($jobs);
//        $t = count($d1);
//        dd($t);

//        if(count($d0) || count($d1) || count($d2) || count($d3) || count($d7) != NULL){
            if(count($d0) != 0){
                Mail::to($a)->send(new ReminderEmail(0));
            }elseif (count($d1) != 0){
                Mail::to($a)->send(new ReminderEmail(1));
            }elseif (count($d2) != 0){
                Mail::to($a)->send(new ReminderEmail(2));
            }elseif (count($d3) != 0){
                Mail::to($a)->send(new ReminderEmail(3));
            }elseif (count($d7) != 0){
                Mail::to($a)->send(new ReminderEmail(7));
            }
//        }
//        else{
//            Mail::to($a)->send(new ReminderEmail($q = 9));
//        }

//        Mail::to($a)->send(new ReminderEmail());

        Session::put('title', 'Timeline All Modul');
        $val = Project::all()->where('status','!=',4);

//        $eevee = Project::join('module','project.id_project','=','module.project_id')
//            ->select('module.*', 'project.nama_project')
//            ->where('project.id_project','=',$id)
//            ->getQuery()
//            ->get();

        $events = Module::all();
        $event_list = [];
        foreach ($events as $key => $event) {
            $event_list[] = Calendar::event(
                $event->nama_module . ' : ' .$event->user,
                true,
                $event->tgl_mulai,
                $event->deadline,
                $event->id_module,
                [
                    'color' => $event->color,
                    'url' => '/timelines/job/'. $event->id_module,
                    'description' => $event->keterangan,
                    'textColor' => '#0A0A0A'
                ]
            );
        }
        $calendar = \MaddHatter\LaravelFullcalendar\Facades\Calendar::addEvents($event_list);



        if (Auth::user()->hasRole('Project Manager')) {

//            $user = User::join('role', 'users.role_id', '=', 'role.id_role')
//                ->select('users.name','role.name')
//                ->where('users.name','=',auth()->user()->name)
//                ->getQuery()
//                ->get();


            return view('timeline.index', compact('calendar','val', 'events'));
        }
        else{
           // $name = auth()->user()->name;
//            $user = User::find('id', 'name');
//            $timesheetView = Timesheet::all();





            return view('timeline.index', compact('calendar','val', 'events'));
        }
//        , compact('user', 'timesheetView'))
//        ->with('timesheet', $timesheetView);

    }


}
