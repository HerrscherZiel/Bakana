<?php

namespace App\Http\Controllers;

use App\Job;
use App\Module;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->hasRole('Project Manager')) {

//            $proj = Project::find('')
            $module = Module::join('project', 'project_id', '=', 'id_project')
                ->select('module.*', 'project.id_project', 'project.nama_project')
                ->getQuery()
                ->get();
            /*dd($module);*/
            /*$module = Module::orderBy('id_module','asc')->paginate(10);*/
            return view('module.index')->with('module', $module);
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
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $project = Project::all();

            return view('module.create')->with('project', $project);
        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

    }

    public function creates($id)
    {
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $project = Project::find($id);

            /*dd($project);*/
            return view('module.creates')->with('project', $project);
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

        return redirect('/projects/')->with('success', 'New support ticket has been created! Wait sometime to get resolved');
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
//        /*$project = Project::find($id);*/
//
//        /*dd($project);*/
//
//        $module = new Module([
//            'nama_module'           => $request->get('nama_module'),
//            'waktu'                 => $request->get('waktu'),
//            'status'                => $request->get('status'),
//            'project_id'            => projects()->id_project,
//            'keterangan'            => $request->get('keterangan'),
//        ]);
//
//        /*$module = Module::with('projects')->all();*/
//        $module->save();
//
//        /*dd($project);*/
//
////        return redirect('/modules')->with('success', 'New support ticket has been created! Wait sometime to get resolved');
//    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module = Module::join('project', 'project_id', '=', 'id_project')
            ->select('module.*', 'project.nama_project')
            ->where('module.id_module', '=', $id )
            ->getQuery()
            ->get();

        /*$modules = $module;*/
        /*$project = Project::all();*/
        /*$job = Job::join('jobs', 'module_id', '=', 'id_module')
            ->select('jobs.*','module.nama_module')
            ->where('module.id_module', '=', $id )
            ->getQuery()
            ->get();*/
        /*$job = Job::all();*/
        /*dd($modules);*/

        return view('module.show'/*, compact('module')*/)->with('module',$module);
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
        if (Auth::user()->hasRole('Project Manager')) {
            $project = Project::all();
            $module = Module::find($id);

            /*$module = Module::join('project','module.id_module','=','project.id_project')
                ->select('module.*', 'project.id_project', 'project.nama_project')
                ->where('module.id_module','=',4)
                ->getQuery()
                ->get();*/

            /*$project = Project::join('module','module.id_module','=','project.id_project')
                ->select('module.*', 'project.id_project', 'project.nama_project')
                ->where('module.id_module','=',2)
                ->getQuery()
                ->get();*/

            /*dd($module);*/

            return view('module.edit', compact('module', 'project'));
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
        if (Auth::user()->hasRole('Project Manager')) {
            $module = Module::find($id);
            $module->delete();

            return redirect('/modules')->with('success', 'Module has been deleted Successfully');
        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

    }
}
