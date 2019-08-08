<?php

namespace App\Http\Controllers;

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

        $usher = User::join('team_projects','team_projects.user_id','=','users.id')
            ->join('project','project.id_project','=','team_projects.project_id')
            ->select('users.*','project.nama_project')
            ->where('users.id','=',auth()->user()->id)
            ->groupBy('project.nama_project')
            ->getQuery()
            ->get();

        if(request()->ajax())

        {
            return datatables()->of(Timesheet::latest()->get())
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id_timesheets.'" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id_timesheets.'" class="delete btn btn-danger btn-sm">Delete</button>';
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
            'project'      =>  $request->project,
            'user_id'                   =>  auth()->user()->id
        );

        Timesheet::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
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
//            'id_timesheets'         =>  $request->id_timesheets,
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
