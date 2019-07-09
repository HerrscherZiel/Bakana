<?php

namespace App\Http\Controllers;

use App\Module;
use App\Project;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*$module = Module::orderBy('id_module', 'asc')->paginate(10);*/
        $module = Module::join('project','project_id','=','id_project')
            ->select('module.*','project.id_project','project.nama_project')
            ->getQuery()
            ->get();
        /*dd($module);*/
        /*$module = Module::orderBy('id_module','asc')->paginate(10);*/
        return view('module.index')->with('module', $module);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $project = Project::all();

        return view('module.create')->with('project', $project);
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
            'nama_module'   =>'required',
            'waktu'         =>'required',
            'status'        =>'required',
            'keterangan'    =>'nullable'
        ]);

        $module = new Module([
            'nama_module'   => $request->get('nama_module'),
            'waktu'         => $request->get('waktu'),
            'status'        => $request->get('status'),
            'project_id'    => $request->get('project_id'),
            'keterangan'    => $request->get('keterangan'),
        ]);

        /*$module = Module::with('projects')->all();*/
        $module->save();

        return redirect('/modules')->with('success', 'New support ticket has been created! Wait sometime to get resolved');
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
        /*$ticket = Ticket::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->first();*/

        $project = Project::all();
        $module = Module::find($id);

        return view('module.edit', compact('module', 'project'));
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
        $module = new Module();
        $request->validate( [
            'nama_module'   => 'required',
            'waktu'         =>'required',
            'status'        =>'required',
            'keterangan'    => 'nullable']);

        $module = Module::find($id);
        $module->nama_module = $request->get('nama_module');
        $module->waktu = $request->get('waktu');
        $module->status = $request->get('status');
        $module->project_id = $request->get('project_id');
        $module->keterangan = $request->get('keterangan');
        $module->save();

        return redirect('/modules')->with('success', 'New support ticket has been updated!!');
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
        $module = Module::find($id);
        $module->delete();

        return redirect('/modules')->with('success', 'Module has been deleted Successfully');
    }
}
