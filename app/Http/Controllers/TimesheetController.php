<?php

namespace App\Http\Controllers;

use App\Project;
use App\TeamProject;
use Illuminate\Http\Request;
use App\User;
use App\Timesheet;
use App\Util\Utils;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('title', 'Dashboard Timesheet');
        //
        $timesheet = Timesheet::join('users', 'users.id', '=', 'timesheets.user_id')
            /*->join('team_projects','team_projects.user_id','=','users.id')*/
            /*->join('project','project.id_project','=','team_projects.project_id')*/
            ->select('timesheets.*', 'users.name')
            ->getQuery()
            ->get();

        
        $timesheetView =  $timesheet;



        /*dd($timesheet);*/

        return view('timesheet.index')->with('timesheetView', $timesheetView);
    }

//    public function indexes(Request $request)
//    {
//        Session::put('title', 'Dashboard Timesheet');
//        //
//
//        $project = Project::join('team_projects','team_projects.project_id','=','project.id_project')
//            ->join('users', 'users.id', '=', 'team_projects.user_id')
//            ->select('project.nama_project','project.id_project')
//            ->where('users.id','=', auth()->user()->id)
//            ->getQuery()
//            ->get();
//
//        $timesheet = Timesheet::join('users', 'users.id', '=', 'timesheets.user_id')
//            ->join('team_projects','team_projects.user_id','=','users.id')
//            ->join('project','project.id_project','=','team_projects.project_id')
//            ->select('timesheets.*', 'users.name')
////            ->where('project.id_project','=',$id)
//            ->getQuery()
//            ->get();
//
//
//        if(request()->ajax())
//
//        {
//            return datatables()->of($timesheet)
//                ->addColumn('action', function($data){
//                    $button = '<button type="button" name="show" id="'.$data->id_timesheets.'" class="edit btn btn-primary btn-sm">Show</button>';
//                    return $button;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }
//
//
//
//        /*dd($timesheet);*/
//
//        return view('timesheet.pm_index', compact( 'project'));
//    }

//    public function indexesView()
//    {
//        Session::put('title', 'Dashboard Timesheet');
//        //
////        $query = $request->get('query');
//
//        $project = Project::join('team_projects','team_projects.project_id','=','project.id_project')
//            ->join('users', 'users.id', '=', 'team_projects.user_id')
//            ->select('project.nama_project','project.id_project')
//            ->where('users.id','=', auth()->user()->id)
//            ->getQuery()
//            ->get();
//
//        $timesheet = Timesheet::join('users', 'users.id', '=', 'timesheets.user_id')
//            ->join('team_projects','team_projects.user_id','=','users.id')
//            ->join('project','project.id_project','=','team_projects.project_id')
//            ->select('timesheets.*', 'users.name')
//            ->where('project.id_project','=',request()->id)
//            ->getQuery()
//            ->get();
//
//        /*$data = Dtr::where('fempidno', '=', request()->id)
//            ->get();*/
//
//        if(request()->ajax())
//
//        {
//            return datatables()->of($timesheet)
//                ->addColumn('action', function($data){
//                    $button = '<button type="button" name="show" id="'.$data->id_timesheets.'" class="edit btn btn-primary btn-sm">Show</button>';
//                    return $button;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }
//
//
//
//        /*dd($timesheet);*/
//
////        return view('timesheet.pm_index', compact( 'project'));
//
////        return Response::json($data);
//
//        return response()->json(['success' => 'Data Added successfully.', $timesheet, $project]);
//    }


    //Timesheets User


    public function UserTimesheets()
    {
        //

        Session::put('title', 'My Timesheet');
        $timesheet = Timesheet::join('users', 'users.id', '=', 'timesheets.user_id')
//            ->join('team_projects','team_projects.user_id','=','users.id')
//            ->join('project','project.id_project','=','team_projects.project_id')
            ->select('timesheets.*', 'users.name')
            ->where('users.id','=',auth()->user()->id)
            ->getQuery()
            ->get();


        $id = auth()->user()->id;
        $timesheetView =  $timesheet;

        $user = User::find($id);


        return view('timesheet.user_timesheets')->with('timesheetView', $timesheetView, 'id', $id);


    }

    public function indexTeam()
    {
        Session::put('title', 'Dashboard Team Timesheet');
        //

        $team_projects = TeamProject::join('project', 'project.id_project', '=', 'team_projects.project_id')
            ->join('users', 'users.id', '=', 'team_projects.user_id')
            ->select('team_projects.*', /*'users.name',*/ 'project.nama_project'/*,'role.nama_role'*/)
            ->where('project.status', '!=', 4)
            ->groupBy('team_projects.project_id')
            ->getQuery()
            ->get();

//        dd($team_projects);


        return view('timesheet.team_timesheets')->with('team_projects', $team_projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('title', 'Create Timesheet');
        //
        /*$user = User::all();*/
        /*$project = Project::all();*/
        /*$id = auth()->user()->id;*/
        $usher = User::join('team_projects','team_projects.user_id','=','users.id')
            ->join('project','project.id_project','=','team_projects.project_id')
            ->select('users.*','project.nama_project')
            ->where('users.id','=',auth()->user()->id)
            ->groupBy('project.nama_project')
            ->getQuery()
            ->get();
        /*$date = Carbon::now()->format('d-m-Y');*/

        /*dd($timesheet);*/

        return view('timesheet.create', compact(/*'user',*/'usher'/*,'date'*/));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function test(){
        Session::put('title', 'Dashboard Timesheet');

        $usher = User::join('team_projects','team_projects.user_id','=','users.id')
            ->join('project','project.id_project','=','team_projects.project_id')
            ->select('users.*','project.nama_project')
            ->where('users.id','=',auth()->user()->id)
            ->groupBy('project.nama_project')
            ->getQuery()
            ->get();

        if(request()->ajax())

        {
            return datatables()->of(Timesheet::join('users', 'users.id', '=', 'timesheets.user_id')
                ->select('timesheets.*')
                ->where('users.id','=',auth()->user()->id)
                ->getQuery()
                ->get())
                ->addColumn('action', function($data){
                    $button = '<a name="edit" id="'.$data->id_timesheets.'" class="edit btn btn-info btn-sm" style="color: #FFF" value="Edit"><i class="fa fa-lg fa-edit" style="margin:0">
                            </i></a>';
                    $button .= '<a name="delete" id="'.$data->id_timesheets.'" class="delete btn btn-danger btn-sm" style="color: #FFF;margin-left: -2px" value="Delete"><i class="fa fa-lg fa-trash" style="margin:0"></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('timesheet.timesheets', compact('usher'));
    }



    public function store(Request $request)
    {
//        //
//        if (Auth::user()->hasRole('Project Manager')) {
//            $request->validate([
//                'tgl_timesheet' => 'required|date',
//                'jam_mulai' => 'required',
//                'jam_selesai' => 'required|after:jam_mulai',
//                'keterangan_timesheet' => 'required']);
//
//            $timesheet = new Timesheet();
//            $timesheet->tgl_timesheet = $request->input('tgl_timesheet');
//            $timesheet->project = $request->input('project');
//            $timesheet->jam_mulai = $request->input('jam_mulai');
//            $timesheet->jam_selesai = $request->input('jam_selesai');
//            $timesheet->keterangan_timesheet = $request->input('keterangan_timesheet');
//            $timesheet->user_id = auth()->user()->id;
//            $timesheet->save();
//
//            /*dd($timesheet);*/
//            return redirect('timesheetss')->with('success', 'Timesheet Berhasil Ditambahkan');
//
//        }
//
//        else  {
//            $request->validate([
//                'tgl_timesheet' => 'required|date',
//                'jam_mulai' => 'required',
//                'jam_selesai' => 'required|after:jam_mulai',
//                'keterangan_timesheet' => 'required']);
//
//
//            $timesheet = new Timesheet();
//            $timesheet->tgl_timesheet = $request->input('tgl_timesheet');
//            $timesheet->project = $request->input('project');
//            $timesheet->jam_mulai = $request->input('jam_mulai');
//            $timesheet->jam_selesai = $request->input('jam_selesai');
//            $timesheet->keterangan_timesheet = $request->input('keterangan_timesheet');
//            $timesheet->user_id = auth()->user()->id;
//            $timesheet->save();
//
////            dd($timesheet);
//            return redirect('timesheetss')->with('success', 'Timesheet Berhasil Ditambahkan');
//
//        }
        $request->validate([
                'tgl_timesheet' => 'required|date',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required|after:jam_mulai',
                'keterangan_timesheet' => 'required']);

        $form_data = array(
            'tgl_timesheet'             =>  $request->tgl_timesheet,
            'jam_mulai'                 =>  $request->jam_mulai,
            'jam_selesai'               =>  $request->jam_selesai,
            'keterangan_timesheet'      =>  $request->keterangan_timesheet,
            'project'                   =>  $request->project,
            'user_id'                   =>  auth()->user()->id
        );

        Timesheet::create($form_data);

        return response()->json(['success' => 'Timesheet berhasil ditambahkan.']);
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

    public function editAjax($id){


        if(request()->ajax())
        {
            $data = Timesheet::findOrFail($id);
            return response()->json(['data' => $data]);
        }

    }


    public function edit($id)
    {
        Session::put('title', 'Edit Timesheet');

        $user = User::all();

        $cek = Timesheet::findOrFail($id)->user_id;

        $timesheet = Timesheet::findOrFail($id);

        if (Auth::user()->hasRole('Project Manager')) {

            return view('timesheet.edit', compact('timesheet','user'));

        }

        else {

            if ($cek ==  auth()->user()->id ) {

                return view('timesheet.edit', compact('timesheet', 'user'));

            }

            else {

                return view('home')->with(abort(403, 'Unauthorized action.'));

            }

        }


//        return view('timesheet.edit', compact('timesheet','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function upAjax(Request $request){

//        $rules = array(
//
//            'tgl_timesheet' => 'required|date',
//            'jam_mulai' => 'required',
//            'jam_selesai' => 'required|after:jam_mulai',
//            'keterangan_timesheet' => 'required'
//        );
//
//        $error = Validator::make($request->all(), $rules);
//
//        if($error->fails())
//        {
//            return response()->json(['errors' => $error->errors()->all()]);
//        }
//        $request->validate([
////            'id_timesheets'        =>  $request->tgl_timesheet,
//            'tgl_timesheet' => 'required|date',
//            'jam_mulai' => 'required',
//            'jam_selesai' => 'required|after:jam_mulai',
//            'keterangan_timesheet' => 'required']);

        $form_data = array(
            'id_timesheets'         =>  $request->id_timesheets,
            'tgl_timesheet'         =>  $request->tgl_timesheet,
            'jam_mulai'             =>  $request->jam_mulai,
            'jam_selesai'           =>  $request->jam_selesai,
            'keterangan_timesheet'  =>  $request->keterangan_timesheet,
            'user_id'               =>  auth()->user()->id
        );

        Timesheet::where('id_timesheets','=',$request->id_timesheets)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);

    }



    public function update(Request $request, $id)
    {
        //
        $request->validate( [
            'tgl_timesheet' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keterangan_timesheet' => 'required']);

        $timesheet =  Timesheet::find($id);
        $timesheet->tgl_timesheet = $request->input('tgl_timesheet');
//        $timesheet->project = $request->input('project');
        $timesheet->jam_mulai = $request->input('jam_mulai');
        $timesheet->jam_selesai = $request->input('jam_selesai');
        $timesheet->keterangan_timesheet = $request->input('keterangan_timesheet');
        $timesheet->project = $request->input('project');
        $timesheet->save();

        return redirect('timesheetss')->with('success', 'Timesheet Berhasil Diubah');





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroyAjax($id){

        $data = Timesheet::findOrFail($id);
        $data->delete();
    }


    public function destroy($id)
    {
        //

        $timesheet = Timesheet::find($id)->user_id;

        if (Auth::user()->hasRole('Project Manager')) {
            $timesheet = Timesheet::find($id);
            $timesheet->delete();
            return redirect()->back()->with('success', 'Post Removed');
        }


        elseif ($timesheet ==  auth()->user()->id ){
            $timesheet = Timesheet::find($id);
            $timesheet->delete();
            return redirect()->back()->with('success', 'Post Removed');
        }


        else{

            return view('home')->with(abort(403, 'Unauthorized action.'));

        }


    }



}
