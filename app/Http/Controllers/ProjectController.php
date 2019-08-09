<?php

namespace App\Http\Controllers;

use App\Module;
use App\TeamProject;
use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Session;
use App\Util\Utils;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProjectRequest;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('title', 'Dashboard Project');
        //

        $project = Project::all();
        $project = Project::where('status','!=', 4)->orderBy('id_project','desc')->paginate(20);


            return view('project.index')->with('project', $project);


    }


    // Completed Project

    public function completedProject()
    {
        Session::put('title', 'Completed Project');

        $project = Project::all();
        $project = Project::where('status','=', 4)->orderBy('id_project','desc')->paginate(20);

        return view('project.projectComplete')->with('project', $project);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('title', 'Create Project');

        if (Auth::user()->hasRole('Project Manager')) {
            return view('project.create');
        }

        else{
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
            $request->validate( [
            'kode_project'=>'required',
            'nama_project'=>'required',
            'tgl_mulai'=>'required',
            'tgl_selesai'=>'required|after:tgl_mulai',
            'status'=>'required|integer',
            'ket' => 'nullable'
        ]);

        $project = new Project([
            'kode_project' => $request->get('kode_project'),
            'nama_project'=> $request->get('nama_project'),
            'tgl_mulai'=> $request->get('tgl_mulai'),
            'tgl_selesai'=> $request->get('tgl_selesai'),
            'status'=> $request->get('status'),
            'ket'=> $request->get('ket')
        ]);

        $project->save();

        return redirect('projects')->with('success', 'Project Berhasil Dibuat ');
          
        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Session::put('title', 'Detail Project');

        $project = Project::findOrFail($id);
        $module = Module::join('project', 'project_id', '=', 'id_project')
            ->select('module.*')
            ->where('project.id_project', '=', $id )
            ->getQuery()
            ->get();

            return view('project.show', compact('project', 'module'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Session::put('title', 'Edit Project');
        $a = false;
        if (Auth::user()->hasRole('Project Manager')) {
            $project = Project::findOrFail($id);

            return view('project.edit')->with('project', $project);
        }

        else{
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

        $project = new Project();

        $request->validate([
            'kode_project' => 'required',
            'nama_project' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required|after:tgl_mulai',
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

        return redirect('projects')->with('success', 'Project Berhasil Diubah ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasRole('Project Manager')) {
            $project = Project::find($id);
            $project->delete();

            return redirect()->back();
        }

        else{
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

    }
    public function back()
    {

            return view('back');

    }

}
