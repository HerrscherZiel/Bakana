<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $tickets = Ticket::where('user_id', auth()->user()->id)->get();
        $project =  Project::orderBy('id_project', 'asc')->paginate(10);
        return view('project.index')->with('project', $project);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('project.create');
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
            'kode_project'=>'required',
            'nama_project'=>'required',
            'tgl_mulai'=>'required',
            'tgl_selesai'=>'required',
            'status'=>'required',
            'ket' => 'nullable'
        ]);

        // $this->user_id = auth()->user()->id;
        $project = new Project([
            'kode_project' => $request->get('kode_project'),
            'nama_project'=> $request->get('nama_project'),
            'tgl_mulai'=> $request->get('tgl_mulai'),
            'tgl_selesai'=> $request->get('tgl_selesai'),
            'status'=> $request->get('status'),
            'ket'=> $request->get('ket')
        ]);
        $project->save();

        return redirect('/projects')->with('success', 'New support ticket has been created! Wait sometime to get resolved');
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
        $project = Project::find($id);

        return view('project.show')->with('project', $project);
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

        $project = Project::find($id);
        return view('project.edit')->with('project', $project);

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

        $project = new Project();
        $data = $this->validate($request, [
            'kode_project' => 'required',
            'nama_project' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'status' => 'required|integer',
            'ket' => 'nullable']);

        $project = Project::find($id);
        //$ticket->user_id = auth()->user()->id;
        $project->kode_project = $request->get('kode_project');
        $project->nama_project = $request->get('nama_project');
        $project->tgl_mulai = $request->get('tgl_mulai');
        $project->tgl_selesai = $request->get('tgl_selesai');
        $project->status = $request->get('status');
        $project->ket = $request->get('ket');
        $project->save();

        return redirect('/projects')->with('success', 'New support ticket has been updated!!');
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
        $project = Project::find($id);
        $project->delete();

        return redirect('/projects')->with('success', 'Stock has been deleted Successfully');
    }
}
