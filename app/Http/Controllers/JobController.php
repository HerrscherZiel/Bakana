<?php

namespace App\Http\Controllers;

use App\Job;
use App\Module;
use App\Project;
use App\Util\Utils;
use Illuminate\Support\Facades\Session;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('title', 'Dashboard Job');
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $job = Job::join('module', 'module_id', '=', 'id_module')
                ->join('project', 'project_id', '=', 'id_project')
                ->select('jobs.*', 'module.id_module', 'module.nama_module', 'project.nama_project')
                ->where('project.status', '!=', 4)
                ->getQuery()
                ->get();

            /*$job = Job::orderBy('id_job', 'asc')->paginate(10);*/
            return view('job.index')->with('job', $job);
        }
        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }
    }


    //Completed Job

    public function completedJob()
    {
        Session::put('title', 'Completed Job');
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $job = Job::join('module', 'module_id', '=', 'id_module')
                ->join('project', 'project_id', '=', 'id_project')
                ->select('jobs.*', 'module.id_module', 'module.nama_module', 'project.nama_project')
                ->where('project.status', '=', 4)
                ->getQuery()
                ->get();

            /*$job = Job::orderBy('id_job', 'asc')->paginate(10);*/
            return view('job.index')->with('job', $job);
        }
        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('title', 'Create Job');
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $mod = Module::join('project','module.project_id','=','project.id_project')
            ->join('team_projects','project.id_project','=','team_projects.project_id')
            ->join('users','team_projects.user_id','=','users.id')
            ->select('users.*')
            ->distinct('users.id')
            ->getQuery()
            ->get();

            /*dd($mod);*/
            $module = Module::join('project', 'project.id_project', '=', 'module.project_id')
                ->select('module.*')
                ->where('project.status', '!=', 4)
                ->getQuery()
                ->get();;;
            $project = Project::all();

            return view('job.create', compact('module', 'project','mod'))/*->with('module', $module)*/ ;
        }
        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }
    }

    public function createFromModule($id)
    {
        Session::put('title', 'Create Job');
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $mod = Module::join('project','module.project_id','=','project.id_project')
                ->join('team_projects','project.id_project','=','team_projects.project_id')
                ->join('users','team_projects.user_id','=','users.id')
                ->select('users.*')
                ->distinct('users.id')
                ->getQuery()
                ->get();

            $module = Module::find($id);
            $project = Project::all();

            /*dd($module);*/

            return view('job.creates', compact('module', 'project','mod'))/*->with('module', $module)*/ ;
        }
        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }
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
        $request->validate( [
            'nama_job'      =>'required',
            'user'          =>'nullable',
            'status'        =>'required|integer',
            'keterangan'    =>'nullable'
        ]);

        $job = new Job([
            'nama_job'      => $request->get('nama_job'),
            'user'          => $request->get('user'),
            'status'        => $request->get('status'),
            'module_id'     => $request->get('module_id'),
            'keterangan'    => $request->get('keterangan'),
        ]);
        $job->save();

        return redirect('/jobs')->with('success', 'New support ticket has been created! Wait sometime to get resolved');



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
        Session::put('title', 'Edit Job');
        //

        if (Auth::user()->hasRole('Project Manager')) {
            $job = Job::find($id);
            $module = Module::join('project', 'project.id_project', '=', 'module.project_id')
                ->select('module.*')
                ->where('project.status', '!=', 4)
                ->getQuery()
                ->get();;
            $project = Project::all();
            $user = \App\User::all();

//            dd($module);

            return view('job.edit', compact('job', 'module', 'project','user'));

        }
        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }
    }

    // Edit Show Module

    public function editShowModule($id)
    {
        Session::put('title', 'Edit Job');
        //

        if (Auth::user()->hasRole('Project Manager')) {
            $module = Module::all();
            $project = Project::all();
            $job = Job::find($id);
            $user = \App\User::all();

            return view('job.editShowModule', compact('job', 'module', 'project','user'));

        }
        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }
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
        $job = new Job();
        $request->validate( [
            'nama_job'      => 'required',
            'user'          => 'nullable',
            'status'        => 'required|integer',
            'keterangan'    => 'nullable']);

        $job = job::find($id);
        $job->nama_job      = $request->get('nama_job');
        $job->user          = $request->get('user');
        $job->status        = $request->get('status');
        $job->module_id     = $request->get('module_id');
        $job->keterangan    = $request->get('keterangan');
        $job->save();

        return redirect('/jobs')->with('success', 'New support ticket has been updated!!');
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
        if (Auth::user()->hasRole('Project Manager')) {
            $job = Job::find($id);
            $job->delete();

            return redirect('/jobs')->with('success', 'job has been deleted Successfully');
        }
        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

    }
}
