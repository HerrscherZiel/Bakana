<?php

namespace App\Http\Controllers;


use App\Job;
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
        Session::put('title', 'Dashboard User Info');
        //


        $info = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->select('users.*', 'project.nama_project', 'project.status', 'project.tgl_mulai', 'project.tgl_selesai', 'project.id_project')
            ->where('users.id', '=', auth()->user()->id )
            ->groupBy('project.nama_project')
            ->getQuery()
            ->get();

        $users = User::join('role', 'users.role_id', '=', 'role.id_role')
            ->select('users.*', 'role.nama_role')
            ->where('users.id', '=',auth()->user()->id )
            ->getQuery()
            ->get();



//        $a = $info::select('id_project');

//        dd($modulpro);


//        $timesheetView =  $timesheet;
//        dd($info);
//        dd($users);

        return view('UserInfo.userInfo', compact('info', 'users'))/*->with('timesheetView', $timesheetView)*/;
    }


    //Timesheets User


    public function moduleUser($id)
    {
        //

        Session::put('title', 'My Module');

        $project = Project::select('nama_project')
                            ->where('id_project', '=', $id )
                            ->getQuery()
                            ->get();

        $modulpro = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.nama_module', 'module.status', 'jobs.nama_job', 'jobs.user', 'jobs.keterangan')
            ->where(['users.id' => auth()->user()->id, 'project.id_project' => $id, 'jobs.user' => auth()->user()->name])
//            ->where('users.id', '=', auth()->user()->id)
            ->orderBy('module.nama_module')
            ->getQuery()
            ->get();

//        $job = Job::join('module', 'module_id', '=', 'id_module')
//            ->select('jobs.*','module.nama_module')
//            ->where('module.id_module', '=', $id )
//            ->getQuery()
//            ->get();

//        dd($modulpro);


//            dd($modulpro);
        return view('UserInfo.userModule', compact('modulpro', 'project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('title', 'Create Timesheet');
        //
        /*$user = User::all();*/
        /*$project = Project::all();*/
        /*$id = auth()->user()->id;*/
        $usher = User::join('team_projects','team_projects.user_id','=','users.id')
            ->join('project','project.id_project','=','team_projects.project_id')
            ->select('users.*','project.nama_project')
            ->where('users.id','=',auth()->user()->id)
            ->getQuery()
            ->get();
        /*$date = Carbon::now()->format('d-m-Y');*/

        /*dd($timesheet);*/

        return view('timesheet.create', compact(/*'user',*/'usher'/*,'date'*/));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $request->validate([
                'tgl_timesheet' => 'required',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
                'keterangan_timesheet' => 'required']);


//            $date = Carbon::now()->format('d-m-Y');
            $timesheet = new Timesheet();
            $timesheet->tgl_timesheet = $request->input('tgl_timesheet');
            $timesheet->project = $request->input('project');
            $timesheet->jam_mulai = $request->input('jam_mulai');
            $timesheet->jam_selesai = $request->input('jam_selesai');
            $timesheet->keterangan_timesheet = $request->input('keterangan_timesheet');
            $timesheet->user_id = auth()->user()->id;
            $timesheet->save();

            /*dd($timesheet);*/
            return redirect('/timesheetss')->with('success', 'User Ditambahkan');

        }

        else  {
            $request->validate([
                'tgl_timesheet' => 'required',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
                'keterangan_timesheet' => 'required']);


            $timesheet = new Timesheet();
            $timesheet->tgl_timesheet = $request->input('tgl_timesheet');
            $timesheet->project = $request->input('project');
            $timesheet->jam_mulai = $request->input('jam_mulai');
            $timesheet->jam_selesai = $request->input('jam_selesai');
            $timesheet->keterangan_timesheet = $request->input('keterangan_timesheet');
            $timesheet->user_id = auth()->user()->id;
            $timesheet->save();

//            dd($timesheet);
            return redirect('/timesheetss')->with('success', 'User Ditambahkan');

        }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Session::put('title', 'Edit Timesheet');
        //
        $user = User::all();

        $cek = Timesheet::find($id)->user_id;

        $timesheet = Timesheet::find($id);

        if (Auth::user()->hasRole('Project Manager')) {

            return view('timesheet.edit', compact('timesheet','user'));

        }

        else {

            if ($cek ==  auth()->user()->id ) {

                return view('timesheet.edit', compact('timesheet', 'user'));

            }

            else {

                return view('home')->with(abort(403, 'Unauthorized action.'));

            }

        }

//        return view('timesheet.edit', compact('timesheet','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate( [
            'tgl_timesheet' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'keterangan_timesheet' => 'required']);

        $timesheet =  Timesheet::find($id);
        $timesheet->tgl_timesheet = $request->input('tgl_timesheet');
        $timesheet->project = $request->input('project');
        $timesheet->jam_mulai = $request->input('jam_mulai');
        $timesheet->jam_selesai = $request->input('jam_selesai');
        $timesheet->keterangan_timesheet = $request->input('keterangan_timesheet');
        $timesheet->save();
        return redirect('/timesheetss')->with('success', 'User Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $timesheet = Timesheet::find($id)->user_id;

        if (Auth::user()->hasRole('Project Manager')) {
            $timesheet = Timesheet::find($id);
            $timesheet->delete();
            return redirect('/timesheets')->with('success', 'Post Removed');
        }


        elseif ($timesheet ==  auth()->user()->id ){
            $timesheet = Timesheet::find($id);
            $timesheet->delete();
            return redirect('/timesheets')->with('success', 'Post Removed');
        }


        else{

            return view('home')->with(abort(403, 'Unauthorized action.'));

        }


    }
}
