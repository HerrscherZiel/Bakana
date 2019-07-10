<?php

namespace App\Http\Controllers;

use App\Job;
use App\Module;
use App\Project;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $job = Job::join('module','module_id','=','id_module')
            ->join('project','project_id','=','id_project')
            ->select('jobs.*','module.id_module','module.nama_module','project.nama_project')
            ->getQuery()
            ->get();

        /*$job = Job::orderBy('id_job', 'asc')->paginate(10);*/
        return view('job.index')->with('job', $job);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $module = Module::all();
        $project = Project::all();

        return view('job.create', compact('module','project'))/*->with('module', $module)*/;
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
            'nama_job'   =>'required',
            'keterangan'    =>'nullable'
        ]);

        $job = new Job([
            'nama_job'   => $request->get('nama_job'),
            'module_id'    => $request->get('module_id'),
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
        //
        $job = Job::find($id);
        $module = Module::all();
        $project = Project::all();
        return view('job.edit', compact('job','module','project'));
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
            'nama_job'   => 'required',
            'keterangan'    => 'nullable']);

        $job = job::find($id);
        $job->nama_job = $request->get('nama_job');
        $job->module_id = $request->get('module_id');
        $job->keterangan = $request->get('keterangan');
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
        $job = Job::find($id);
        $job->delete();

        return redirect('/jobs')->with('success', 'job has been deleted Successfully');
    }
}
