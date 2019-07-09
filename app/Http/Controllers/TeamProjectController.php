<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TeamProject;
use App\Project;

class TeamProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $team_projects = TeamProject::join('users', 'users.id', '=', 'team_projects.user_id')
            ->join('project', 'project.id_project', '=', 'team_projects.project_id')
            ->select('team_projects.*', 'users.name', 'users.role_id', 'project.nama_project')
            ->getQuery()
            ->get();

        return view('team.index')->with('team_projects', $team_projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = User::all();
        $project = Project::all();

        return view('team.create', compact('user', 'project'));
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
        //
        $user = User::all();
        $project = Project::all();
        $team_projects = TeamProject::find($id);
        return view('team.edit', compact('team_projects','user', 'project'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $team_projects = TeamProject::find($id);
        $team_projects->delete();
        return redirect('/teamprojects')->with('success', 'Post Removed');
    }
}
