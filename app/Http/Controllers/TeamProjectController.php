<?php

namespace App\Http\Controllers;

use App\Mail\NewProjectMail;
use App\Mail\ReminderEmail;
use App\Role;
use Illuminate\Http\Request;
use App\User;
use App\TeamProject;
use App\Project;
use App\Util\Utils;
use Illuminate\Support\Facades\Mail;
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
        $project = Project::findOrFail($id);

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

//    public function indexAjax()


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
            $project = Project::all()->where('status', '!=', 4);
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

            $use = User::join('team_projects', 'users.id', '=', 'team_projects.user_id')
                        ->join('project', 'project.id_project', '=', 'team_projects.project_id')
                        ->select('users.*')
                        ->where('team_projects.project_id', '=', $id)
                        ->where('team_projects.user_id', '!=','users.id' )
                        ->getQuery()
                        ->get();

//            $a = $use->id;

            $user = User::all();

//            dd($use);

            return view('team.creates', compact('user', 'project', 'role', 'use'));
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
        /*|unique:team_projects,user_id*/

        $team_projects = new TeamProject();
        $team_projects->user_id = $request->input('user_id');
        $team_projects->project_id = $request->input('project_id');
        $team_projects->save();


        $useremail = User::join('team_projects', 'team_projects.user_id', '=', 'users.id')
            ->select('users.email')
            ->where('users.id' , '=', $request->input('user_id'))
            ->groupBy('users.email')
            ->getQuery()
            ->get();

//        dd($useremail);

        $projects = Project::join('team_projects', 'team_projects.project_id', '=', 'project.id_project')
            ->select('project.nama_project')
            ->where('project.id_project' , '=', $request->input('project_id'))
            ->groupBy('project.nama_project')
            ->getQuery()
            ->get();

//        dd($projects);

        Mail::to($useremail)->send(new NewProjectMail($projects));


        return redirect('team/'.$team_projects->project_id)->with('success', 'Team Berhasil Ditambah');
    }


    public function email($umail, $pro){


        $useremail = User::join('team_projects', 'team_projects.user_id', '=', 'users.id')
            ->select('users.email')
            ->where('users.id' , '=',$umail)
            ->groupBy('users.email')
            ->getQuery()
            ->get();

//        dd($useremail);

        $projects = Project::join('team_projects', 'team_projects.project_id', '=', 'project.id_project')
            ->select('project.nama_project')
            ->where('project.id_project' , '=', $pro)
            ->groupBy('project.nama_project')
            ->getQuery()
            ->get();

//        dd($projects);

        Mail::to($umail)->send(new NewProjectMail($pro));



    }

    public function storeFromShow(Request $request)
    {
        //

//        $request->validate( [
//
//
//            'user_id' => 'required|unique_with:team_projects,project_id',
//            'project_id' => 'required']);
//
//
//        $team_projects = new TeamProject();
//        $team_projects->user_id = $request->input('user_id');
//        $team_projects->project_id = $request->input('project_id');
//        $team_projects->save();
//
//
        $request->validate( [


            'user_id' => 'required|unique_with:team_projects,project_id',
            'project_id' => 'required']);

        $a = $request->user_id;
        $b = $request->project_id;

        $this->email($a, $b);




//        return redirect('team/'.$team_projects->project_id)->with('success', 'Team Berhasil Ditambah');




        $form_data = array(
            'project_id'             =>  $request->project_id,
            'user_id'                 =>  $request->user_id,

        );





        TeamProject::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']
    );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showAjax($id){

        $project = Project::findOrFail($id);
//        $project = Project::find($id);
        $role = Role::all();
        $user = User::all();


        if(request()->ajax())

        {
            return datatables()->of(TeamProject::join('users', 'users.id', '=', 'team_projects.user_id')
                ->distinct('users.id')
                ->join('project', 'project.id_project', '=', 'team_projects.project_id')
                ->join('role', 'role.id_role', '=', 'users.role_id')
                ->select('team_projects.*', 'users.name' ,'users.role_id', 'project.nama_project','role.nama_role')
                ->where('project.id_project', '=', $id )
                ->groupBy('users.name')
                ->getQuery()
                ->get())
                ->addColumn('action', function($data){
//                    $button = '<button type="button" name="edit" id="'.$data->id_team_projects.'" class="edit btn btn-primary btn-sm">Edit</button>';
//                    $button .= '&nbsp;&nbsp;';


                    $button /*.*/= '<button type="button" name="delete" id="'.$data->id_team_projects.'" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('team.team', compact('project', 'role', 'user'));

    }

    public function show($id)
    {
        $project = Project::findOrFail($id);

        $team_projects = TeamProject::join('users', 'users.id', '=', 'team_projects.user_id')
            ->distinct('users.id')
            ->join('project', 'project.id_project', '=', 'team_projects.project_id')
            ->join('role', 'role.id_role', '=', 'users.role_id')
            ->select('team_projects.*', 'users.name' ,'users.role_id', 'project.nama_project','role.nama_role')
            ->where('project.id_project', '=', $id )
            ->groupBy('users.name')
            ->getQuery()
            ->get();

        return view('team.show', compact('project', 'team_projects'));

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

            $team_projects = TeamProject::findOrFail($id);
            return view('team.edit', compact('team_projects', 'user', 'project', 'role'));

        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

    }

    //Edit from TeamProject

    public function editAjax($id){

        Session::put('title', 'Edit Team');
        //
        if (Auth::user()->hasRole('Project Manager')) {

//            $user = User::all();
//            $project = Project::all();
//            $role = Role::all();

            if(request()->ajax())
            {
                $data = TeamProject::findOrFail($id);
                return response()->json(['data' => $data]);
            }


//            $team_projects = TeamProject::findOrFail($id);
//            return view('team.edit_team_project_index', compact('team_projects', 'user', 'project', 'role'));

        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }

    }

    public function editTeamProject($id)
    {
        Session::put('title', 'Edit Team');
        //
        if (Auth::user()->hasRole('Project Manager')) {

            $user = User::all();
            $project = Project::all();
            $role = Role::all();


            $team_projects = TeamProject::findOrFail($id);
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
        return redirect('team/'.$team_projects->project_id)->with('success', 'Team Berhasil Diubah');
    }


    //Update editTeamProject

    public function updateAjax(Request $request){

        $request->validate( [
            'project_id' => 'required|date',
            'user_id' => 'required',
        ]);

        $form_data = array(
//            'id_timesheets'         =>  $request->id_timesheets,
            'project_id'         =>  $request->project_id,
            'user_id'             =>  $request->user_id,
        );

        TeamProject::where('id_team_projects','=',$request->id_team_projects)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

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
        return redirect('teamprojects')->with('success', 'Team Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroyAjax($id){




            $data = TeamProject::findOrFail($id);
            $data->delete();

    }


    public function destroy($id)
    {
        //
        if (Auth::user()->hasRole('Project Manager')) {

            $team_projects = TeamProject::find($id);
            $team_projects->delete();
            return redirect()->back()->with('success', 'Post Removed');

        }

        else{
            //Tambah warning
            return view('home')->with(abort(403, 'Unauthorized action.'));
        }


    }
}
