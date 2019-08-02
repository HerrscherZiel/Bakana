<?php

namespace App\Http\Controllers;


use App\Job;
use App\Module;
use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Timesheet;
use App\Util\Utils;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('title', 'Your Works');

        //

        $info = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->select('users.*', 'project.nama_project', 'project.status', 'project.tgl_mulai', 'project.tgl_selesai', 'project.id_project')
            ->where('users.id' ,'=', auth()->user()->id )
            ->where('project.status', '!=', 4)
            ->groupBy('project.nama_project')
            ->getQuery()
            ->get();

        $users = User::join('role', 'users.role_id', '=', 'role.id_role')
            ->select('users.*', 'role.nama_role')
            ->where('users.id', '=',auth()->user()->id )
            ->getQuery()
            ->get();

        $timesheets = Timesheet::select('timesheets.project', 'timesheets.tgl_timesheet', 'timesheets.jam_mulai', 'timesheets.jam_selesai', 'timesheets.keterangan_timesheet')
                    ->where('timesheets.user_id', '=', auth()->user()->id)
                    ->take(3)
                    ->orderBy('timesheets.id_timesheets', 'DESC')
                    ->getQuery()
                    ->get();

//        dd($info);
//        dd($users);

        return view('UserInfo.userInfo', compact('info', 'users', 'timesheets'))/*->with('timesheetView', $timesheetView)*/;
    }


    //Completed Project User

    public function completedProjectUser()
    {
        Session::put('title', 'My Works');

        //

        $info = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->select('users.*', 'project.nama_project', 'project.status', 'project.tgl_mulai', 'project.tgl_selesai', 'project.id_project')
            ->where('users.id' ,'=', auth()->user()->id )
            ->where('project.status', '=', 4)
            ->groupBy('project.nama_project')
            ->getQuery()
            ->get();

        $users = User::join('role', 'users.role_id', '=', 'role.id_role')
            ->select('users.*', 'role.nama_role')
            ->where('users.id', '=',auth()->user()->id )
            ->getQuery()
            ->get();



//        dd($info);
//        dd($users);

        return view('UserInfo.completedProjectUser', compact('info', 'users'));
    }



    //Detail Project User


    public function moduleUser($id)
    {
        //

        Session::put('title', 'My Jobs');
         

        $project = Project::select('nama_project')
                            ->where('id_project', '=', $id )
                            ->getQuery()
                            ->get();

        $modulpro = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                        , 'jobs.module_id')
            ->where(['users.id' => auth()->user()->id, 'project.id_project' => $id, 'jobs.user' => auth()->user()->name])
//            ->where('users.id', '=', auth()->user()->id)
            ->orderBy('module.nama_module')
            ->groupBy('module.nama_module')
            ->getQuery()
            ->get();

        $jobs = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where(['users.id' => auth()->user()->id, 'project.id_project' => $id, 'jobs.user' => auth()->user()->name])
//            ->where('users.id', '=', auth()->user()->id)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

//        dd($jobs);
//
//            $jobs = Job::all()->select('jobs.user', '=', auth()->user()->name );
//
//            $a = auth()->user()->name;
//        dd($jobs);

//        $job = Job::join('module', 'module_id', '=', 'id_module')
//            ->select('jobs.*','module.nama_module')
//            ->where('module.id_module', '=', $id )
//            ->getQuery()
//            ->get();

//        dd($modulpro);

//            foreach ($jobs as $i){
//
//            $i->nama_job;
//                dd($i);
//            }

        return view('UserInfo.userModule', compact('modulpro', 'project', 'jobs'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function editShowProject($id)
    {
        Session::put('title', 'Edit Modul');
        //


        $aa = Module::find($id)->user;

        $as = auth()->user()->name;

//        $as = $mo->user;

//        dd($aa);


        if (Auth::user()->hasRole('Project Manager')) {
            $project    = Project::all();
            $module     = Module::find($id);
            $user       = User::join('team_projects','users.id','=','team_projects.user_id')
                ->join('project', 'team_projects.project_id', '=', 'project.id_project')
                ->join('module', 'module.project_id', '=', 'project.id_project')
                ->select('users.*')
                ->where('module.id_module', '=', $id )
                ->groupBy('users.name')
                ->getQuery()
                ->get();


            return view('module.editShowProject', compact('module', 'project', 'user'));
        }

        elseif ( $aa === $as){


//            $aa = Module::find($id)->user;
//            $as = auth()->user()->name;
            $project    = Project::all();
            $module     = Module::find($id);
            $user       = User::join('team_projects','users.id','=','team_projects.user_id')
                ->join('project', 'team_projects.project_id', '=', 'project.id_project')
                ->join('module', 'module.project_id', '=', 'project.id_project')
                ->select('users.*')
                ->where('module.id_module', '=', $id )
                ->groupBy('users.name')
                ->getQuery()
                ->get();

            return view('module.editUser', compact('module', 'project', 'user'/*, 'aa', 'as'*/));

        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

    }

}
