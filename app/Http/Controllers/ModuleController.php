<?php

namespace App\Http\Controllers;

use App\Job;
use App\Module;
use App\Project;
use App\TeamProject;
use App\Timeline;
use App\User;
use Illuminate\Support\Facades\Session;
use App\Util\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MaddHatter\LaravelFullcalendar\Calendar;
use PhpParser\Node\Expr\AssignOp\Mod;

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
        if (Auth::user()->hasRole('Project Manager')) {

            $module = Module::join('project', 'project_id', '=', 'id_project')
                ->select('module.*', 'project.id_project', 'project.nama_project')
                ->where('project.status', '!=', 4)
                ->where('module.status', '!=', 4)
                ->getQuery()
                ->get();
//            dd($module);
            return view('module.index')->with('module', $module);
        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

    }

    //Module per Project

    public function indexes($id)
    {
        Session::put('title', 'Dashboard Modul');
        //
        $project = Project::findOrFail($id);

        $module = Module::join('project', 'project_id', '=', 'id_project')
            ->select('module.*', 'project.id_project', 'project.nama_project')
            ->where('project.id_project', '=', $id )
            ->getQuery()
            ->get();

//        dd($project);

        return view('module.indexproject', compact('project', 'module'));


    }


    // Completed Module

    public function completedModule()
    {
        Session::put('title', 'Completed Module');
        //
//        $project =  Project::orderBy('id_project', 'asc')->paginate(10);
        if (Auth::user()->hasRole('Project Manager')) {

            $module = Module::join('project', 'project_id', '=', 'id_project')
                ->select('module.*', 'project.id_project', 'project.nama_project')
                ->where(function($q) {
                    $q->where('module.status', 4)
                        ->orWhere('project.status', 4);
                })
                ->getQuery()
                ->get();

            return view('module.moduleComplete')->with('module', $module);
        }

//        dd($module);


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

            $project = Project::all()->where('status', '!=', 4)
            ;

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
                ->where('project.id_project', '=', $id)
                ->select('users.*')
                ->distinct('users.id')
                ->getQuery()
                ->get();


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
            'user'          =>'nullable',
            'tgl_mulai'     =>'required',
            'deadline'      =>'required|after_or_equal:tgl_mulai',
            'tgl_user'      =>'nullable',
            'status'        =>'required|integer',
            'color'         =>'nullable',
            'keterangan'    =>'nullable'
        ]);

        $module = new Module([
            'nama_module'   => $request->get('nama_module'),
            'user'          => $request->get('user'),
            'tgl_mulai'     => $request->get('tgl_mulai'),
            'deadline'      => $request->get('deadline'),
            'tgl_user'      => $request->get('tgl_user'),
            'status'        => $request->get('status'),
            'color'         => $request->get('color'),
            'project_id'    => $request->get('project_id'),
            'keterangan'    => $request->get('keterangan'),
        ]);

        $module->save();

        return redirect('modules')->with('success', 'Module Berhasil Dibuat');
    }


    // stores

    public function stores(Request $request)
    {
        //

        $project = Project::findOrFail($tgl_mulai);
        $request->validate( [
            'nama_module'   =>'required',
            'user'          =>'nullable',
            'tgl_mulai'     =>'required',
            'deadline'      =>'required|after_or_equal:tgl_mulai',
            'tgl_user'      =>'nullable',
            'status'        =>'required|integer',
            'color'         =>'nullable',
            'keterangan'    =>'nullable'
        ]);

        $module = new Module([
            'nama_module'   => $request->get('nama_module'),
            'user'          => $request->get('user'),
            'tgl_mulai'     => $request->get('tgl_mulai'),
            'deadline'      => $request->get('deadline'),
            'tgl_user'      => $request->get('tgl_user'),
            'status'        => $request->get('status'),
            'color'         => $request->get('color'),
            'project_id'    => $request->get('project_id'),
            'keterangan'    => $request->get('keterangan'),
        ]);

        $module->save();

        return redirect('projects/'.$module->project_id)->with('success', 'Module Berhasil Dibuat');
    }
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

        $mod = Module::findOrFail($id);
//
//        if($mod < 1){
//            return view('home')->with(abort(404, 'Unauthorized action.'));
//
//        }

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

        if (Auth::user()->hasRole('Project Manager')) {
            $project    = Project::all()->where('status', '!=', 4);
            $module     = Module::findOrFail($id);
            $user       = User::all();

//            if($module < 1){
//                return view('home')->with(abort(404, 'Unauthorized action.'));
//
//            }
            return view('module.edit', compact('module', 'project', 'user'));
        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

    }

    //Edit Show Project

    public function editShowProject($id)
    {
        Session::put('title', 'Edit Modul');
        //


        $aa = Module::findOrFail($id)->user;

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
            'user'          => 'nullable',
            'tgl_mulai'     =>'required',
            'deadline'      =>'required|after_or_equal:tgl_mulai',
            'tgl_user'      =>'nullable',
            'status'        =>'required|integer',
            'color'         =>'nullable',
            'keterangan'    => 'nullable']);

        $module = Module::find($id);
        $module->nama_module    = $request->get('nama_module');
        $module->user           = $request->get('user');
        $module->tgl_mulai      = $request->get('tgl_mulai');
        $module->deadline       = $request->get('deadline');
        $module->tgl_user       = $request->get('tgl_user');
        $module->status         = $request->get('status');
        $module->color          = $request->get('color');
        $module->project_id     = $request->get('project_id');
        $module->keterangan     = $request->get('keterangan');
        $module->save();
        
        return redirect('/modules')->with('success', 'Module Berhasil Diubah');
    }


    // updates

    public function updates(Request $request, $id)
    {
        //
        $module = new Module();
        $request->validate( [
            'nama_module'   => 'required',
            'user'          => 'nullable',
            'tgl_mulai'     =>'required',
            'deadline'      =>'required|after_or_equal:tgl_mulai',
            'tgl_user'      =>'nullable',
            'status'        =>'required|integer',
            'color'         =>'nullable',
            'keterangan'    => 'nullable']);

        $module = Module::find($id);
        $module->nama_module    = $request->get('nama_module');
        $module->user           = $request->get('user');
        $module->tgl_mulai      = $request->get('tgl_mulai');
        $module->deadline       = $request->get('deadline');
        $module->tgl_user       = $request->get('tgl_user');
        $module->status         = $request->get('status');
        $module->color          = $request->get('color');
        $module->project_id     = $request->get('project_id');
        $module->keterangan     = $request->get('keterangan');
        $module->save();

        return redirect('/projects/'.$module->project_id)->with('success', 'Module Berhasil Diubah');
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

            return redirect()->back();
        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

    }
}
