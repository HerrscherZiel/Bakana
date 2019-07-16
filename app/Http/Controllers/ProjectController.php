<?php

namespace App\Http\Controllers;

use App\Module;
use App\TeamProject;
use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Session;
use App\Util\Utils;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
//        $tickets = Ticket::where('user_id', auth()->user()->id)->get();
        $project =  Project::orderBy('id_project', 'asc')->paginate(10);

        /*$today = strtotime('today GMT');*/
        //$sisa = date("d/m/Y", strtotime('today'));

            return view('project.index')->with('project', $project);


//        return view('project.index', compact('project', 'module'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('title', 'Create Project');
        // replace the point from the european date format with a dash
        
        //
        if (Auth::user()->hasRole('Project Manager')) {
            return view('project.create');
        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }
    }

//    public function creates($id)
//    {
//        //
//        if (Auth::user()->hasRole('Project Manager')) {
//            $project = Project::all($id);
//
//            return view('project.creates')->with('project', $project);
//        }
//
//        else{
//            //Tambah warning
//            return view('home')->with(abort(403, 'Unauthorized action.'));
//        }
//
//    }

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

//    public function stores(Request $request, $id)
//    {
//        //
//        $request->validate( [
//            'nama_module'   =>'required',
//            'waktu'         =>'required',
//            'status'        =>'required',
//            'keterangan'    =>'nullable'
//        ]);
//
//        $project = Project::find($id);
//
//        $module = new Module([
//            'nama_module'           => $request->get('nama_module'),
//            'waktu'                 => $request->get('waktu'),
//            'status'                => $request->get('status'),
//            $project->id_project    => $request->get('project_id'),
//            'keterangan'            => $request->get('keterangan'),
//        ]);
//
//        /*$module = Module::with('projects')->all();*/
//        $module->save();
//
//        return redirect('/projects')->with('success', 'New support ticket has been created! Wait sometime to get resolved');
//
//    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Session::put('title', 'Detail Project');
        // dd($id);
        //
        $project = Project::find($id);
        $module = Module::join('project', 'project_id', '=', 'id_project')
            ->select('module.*')
            ->where('project.id_project', '=', $id )
            ->getQuery()
            ->get();

            if(count($module) <= 0){
                exit();
            }

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
        //
        /*$ticket = Ticket::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->first();*/

        if (Auth::user()->hasRole('Project Manager')) {
            $project = Project::find($id);
            return view('project.edit')->with('project', $project);
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
        if (Auth::user()->hasRole('Project Manager')) {
            $project = Project::find($id);
            $project->delete();

            return redirect('/projects')->with('success', 'Stock has been deleted Successfully');
        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

    }
}
