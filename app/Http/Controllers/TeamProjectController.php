<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use App\TeamProject;
use App\Project;
use App\Util\Utils;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TeamProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('title', 'Dashboard Team');
        //

        $team_projects = TeamProject::join('project', 'project.id_project', '=', 'team_projects.project_id')
            ->join('users', 'users.id', '=', 'team_projects.user_id')
            ->select('team_projects.*', /*'users.name',*/ 'project.nama_project'/*,'role.nama_role'*/)
            ->where('project.status', '!=', 4)
            ->groupBy('team_projects.project_id')
            ->getQuery()
            ->get();

//        dd($team_projects);

        return view('team.index')->with('team_projects', $team_projects);



    }

    //Team from Show Project

    public function indexes($id)
    {
        Session::put('title', 'Dashboard Team');
        //
        $project = Project::find($id);

        $team_projects = TeamProject::join('users', 'users.id', '=', 'team_projects.user_id')
            ->distinct('users.id')
            ->join('project', 'project.id_project', '=', 'team_projects.project_id')
            ->join('role', 'role.id_role', '=', 'users.role_id')
            ->select('team_projects.*', 'users.name' ,'users.role_id', 'project.nama_project','role.nama_role')
            ->where('project.id_project', '=', $id )
            ->groupBy('users.name')
            ->getQuery()
            ->get();

        return view('team.teamindex', compact('project', 'team_projects'));
    }



    // Disbanded Team

    public function disbandedTeam()
    {
        Session::put('title', 'Disbanded Team');
        //

        $team_projects = TeamProject::join('project', 'project.id_project', '=', 'team_projects.project_id')
            ->join('users', 'users.id', '=', 'team_projects.user_id')
            ->select('team_projects.*', /*'users.name',*/ 'project.nama_project'/*,'role.nama_role'*/)
            ->where('project.status', '=', 4)
            ->groupBy('team_projects.project_id')
            ->getQuery()
            ->get();

//        dd($team_projects);

        return view('team.disbandedTeam')->with('team_projects', $team_projects);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('title', 'Create Team');
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $user = User::all();
            $project = Project::all();
            $role = Role::all();

            return view('team.create', compact('user', 'project', 'role'));
        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }
    }

    //Show Project Creates

    public function creates($id)
    {
        Session::put('title', 'Add to Team');
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $project = Project::find($id);
            $role = Role::all();
            $user = User::all();


//            dd($project);
            return view('team.creates', compact('user', 'project', 'role'));
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
            'user_id' => 'required',
            'project_id' => 'required']);


        $team_projects = new TeamProject();
        $team_projects->user_id = $request->input('user_id');
        $team_projects->project_id = $request->input('project_id');
        $team_projects->save();
        return redirect('/teamprojects')->with('success', 'User Ditambahkan');
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
        Session::put('title', 'Edit Team');
        //
        if (Auth::user()->hasRole('Project Manager')) {

            $user = User::all();
            $project = Project::all();
            $role = Role::all();

            $team_projects = TeamProject::find($id);
            return view('team.edit', compact('team_projects', 'user', 'project', 'role'));

        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

    }

    //Edit from TeamProject

    public function editTeamProject($id)
    {
        Session::put('title', 'Edit Team');
        //
        if (Auth::user()->hasRole('Project Manager')) {

            $user = User::all();
            $project = Project::all();
            $role = Role::all();


            $team_projects = TeamProject::find($id);
            return view('team.edit_team_project_index', compact('team_projects', 'user', 'project', 'role'));

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
        $request->validate( [
            'user_id' => 'required',
            'project_id' => 'required']);


        $team_projects =  TeamProject::find($id);
        $team_projects->user_id = $request->input('user_id');
        $team_projects->project_id = $request->input('project_id');
        $team_projects->save();
        return redirect('/teamprojects')->with('success', 'User Ditambahkan');
    }


    //Update editTeamProject

    public function updateTeamProject(Request $request, $id)
    {
        //
        $request->validate( [
            'user_id' => 'required',
            'project_id' => 'required']);

        $id_project = Project::find($id);
        $team_projects =  TeamProject::find($id);
        $team_projects->user_id = $request->input('user_id');
        $team_projects->project_id = $request->input('project_id');
        $team_projects->save();
        return redirect('/team/'/$id_project)->with('success', 'User Ditambahkan');
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

            $team_projects = TeamProject::find($id);
            $team_projects->delete();
            return redirect('/teamprojects')->with('success', 'Post Removed');

        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }


    }
}
