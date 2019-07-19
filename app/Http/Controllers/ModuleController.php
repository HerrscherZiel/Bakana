<?php

namespace App\Http\Controllers;

use App\Job;
use App\Module;
use App\Project;
use App\TeamProject;
use App\User;
use Illuminate\Support\Facades\Session;
use App\Util\Utils;
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
        Session::put('title', 'Dashboard Modul');
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

    public function indexes($id)
    {
        Session::put('title', 'Dashboard Modul');
        //
        $project = Project::find($id);

        $module = Module::join('project', 'project_id', '=', 'id_project')
            ->select('module.*', 'project.id_project', 'project.nama_project')
            ->where('project.id_project', '=', $id )
            ->getQuery()
            ->get();



        return view('module.indexproject', compact('project', 'module'));


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('title', 'Create Modul');
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $mod = Project::join('team_projects','project.id_project','=','team_projects.project_id')
                ->join('users','team_projects.user_id','=','users.id')
                ->select('users.*')
                ->distinct('users.id')
                ->getQuery()
                ->get();

//            dd($mod);

            $project = Project::all();

            return view('module.create', compact('project','mod'))/*->with('project', $project, 'mod', $mod)*/;
        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

    }

    public function creates($id)
    {
        Session::put('title', 'Create Modul');
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $mod = Project::join('team_projects','project.id_project','=','team_projects.project_id')
                ->join('users','team_projects.user_id','=','users.id')
                ->select('users.*')
                ->distinct('users.id')
                ->getQuery()
                ->get();

            $project = Project::find($id);

            /*dd($project);*/
            return view('module.creates', compact('project','mod'))/*->with('project', $project, 'mod', $mod)*/;
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
            'user'          =>'required',
            'tgl_mulai'     =>'required',
            'deadline'      =>'required',
            'tgl_user'      =>'nullable',
            'status'        =>'required',
            'keterangan'    =>'nullable'
        ]);

        $module = new Module([
            'nama_module'   => $request->get('nama_module'),
            'user'          => $request->get('user'),
            'tgl_mulai'     => $request->get('tgl_mulai'),
            'deadline'      => $request->get('deadline'),
            'tgl_user'      => $request->get('tgl_user'),
            'status'        => $request->get('status'),
            'project_id'    => $request->get('project_id'),
            'keterangan'    => $request->get('keterangan'),
        ]);

        /*$module = Module::with('projects')->all();*/
        $module->save();

/*        return Redirect::to('projects/'.$idProject);*/
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
        Session::put('title', 'Detail Modul');
        $module = Module::join('project', 'project_id', '=', 'id_project')
            ->select('module.*','project.id_project', 'project.nama_project')
            ->where('module.id_module', '=', $id )
            ->getQuery()
            ->get();

        /*$modules = $module;*/
        /*$project = Project::all();*/
        $job = Job::join('module', 'module_id', '=', 'id_module')
            ->select('jobs.*','module.nama_module')
            ->where('module.id_module', '=', $id )
            ->getQuery()
            ->get();
        /*$job = Job::all();*/
        /*dd($job);*/

        $mod = Module::find($id);

            return view('module.show', compact('module','job','mod'))/*->with('module',$module)*//*->with('module', $job)*/;


//        return view('module.show', compact('module','job','mod'))/*->with('module',$module)*//*->with('module', $job)*/;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Session::put('title', 'Edit Modul');
        //
        /*$ticket = Ticket::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->first();*/
        if (Auth::user()->hasRole('Project Manager')) {
            $project    = Project::all();
            $module     = Module::find($id);
            $user       = User::all();


            return view('module.edit', compact('module', 'project', 'user'));
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
            'user'          => 'required',
            'tgl_mulai'     =>'required',
            'deadline'      =>'required',
            'tgl_user'      =>'nullable',
            'status'        =>'required',
            'keterangan'    => 'nullable']);

        $module = Module::find($id);
        $module->nama_module    = $request->get('nama_module');
        $module->user           = $request->get('user');
        $module->tgl_mulai      = $request->get('tgl_mulai');
        $module->deadline       = $request->get('deadline');
        $module->tgl_user       = $request->get('tgl_user');
        $module->status         = $request->get('status');
        $module->project_id     = $request->get('project_id');
        $module->keterangan     = $request->get('keterangan');
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
