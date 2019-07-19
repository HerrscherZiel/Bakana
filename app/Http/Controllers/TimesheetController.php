<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Timesheet;
use App\Util\Utils;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


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

        $start = Timesheet::select('timesheets.jam_mulai')
        ->getQuery()
        ->get();
        $end = Timesheet::select('timesheets.jam_selesai')
        ->getQuery()
        ->get();
        // $starttime = $timesheet->get(jam_mulai);
        // $stoptime = '12:59';
        $starts = strtotime($start);
        $ends = strtotime($end);
        $diff = (strtotime($ends) - strtotime($starts));
        $total = $diff/60;
        $time = sprintf("%02dh %02dm", floor($total/60), $total%60);


        // $time = Timesheet()->duration();

        /*dd($timesheet);*/

        return view('timesheet.index')->with('timesheetView', $timesheetView);
    }


    //Timesheets User


    public function UserTimesheets()
    {
        //

        Session::put('title', 'My Timesheet');
        $timesheet = Timesheet::join('users', 'users.id', '=', 'timesheets.user_id')
            /*->join('team_projects','team_projects.user_id','=','users.id')*/
            /*->join('project','project.id_project','=','team_projects.project_id')*/
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
    public function store(Request $request)
    {
        //
        if (Auth::user()->hasRole('Project Manager')) {
            $request->validate([
                'tgl_timesheet' => 'required',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
                'keterangan_timesheet' => 'required']);


//            $date = Carbon::now()->format('d-m-Y');
            $timesheet = new Timesheet();
            $timesheet->tgl_timesheet = $request->input('tgl_timesheet');
            $timesheet->project = $request->input('project');
            $timesheet->jam_mulai = $request->input('jam_mulai');
            $timesheet->jam_selesai = $request->input('jam_selesai');
            $timesheet->keterangan_timesheet = $request->input('keterangan_timesheet');
            $timesheet->user_id = auth()->user()->id;
            $timesheet->save();

            /*dd($timesheet);*/
            return redirect('/timesheetss')->with('success', 'User Ditambahkan');

        }

        else  {
            $request->validate([
                'tgl_timesheet' => 'required',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
                'keterangan_timesheet' => 'required']);


            $timesheet = new Timesheet();
            $timesheet->tgl_timesheet = $request->input('tgl_timesheet');
            $timesheet->project = $request->input('project');
            $timesheet->jam_mulai = $request->input('jam_mulai');
            $timesheet->jam_selesai = $request->input('jam_selesai');
            $timesheet->keterangan_timesheet = $request->input('keterangan_timesheet');
            $timesheet->user_id = auth()->user()->id;
            $timesheet->save();

//            dd($timesheet);
            return redirect('/timesheetss')->with('success', 'User Ditambahkan');

        }
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
        Session::put('title', 'Edit Timesheet');
        //
        $user = User::all();

        $cek = Timesheet::find($id)->user_id;

        $timesheet = Timesheet::find($id);

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
    public function update(Request $request, $id)
    {
        //
        $request->validate( [
            'tgl_timesheet' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'keterangan_timesheet' => 'required']);

        $timesheet =  Timesheet::find($id);
        $timesheet->tgl_timesheet = $request->input('tgl_timesheet');
        $timesheet->project = $request->input('project');
        $timesheet->jam_mulai = $request->input('jam_mulai');
        $timesheet->jam_selesai = $request->input('jam_selesai');
        $timesheet->keterangan_timesheet = $request->input('keterangan_timesheet');
        $timesheet->save();
        return redirect('/timesheetss')->with('success', 'User Diedit');
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

        $timesheet = Timesheet::find($id)->user_id;

        if (Auth::user()->hasRole('Project Manager')) {
            $timesheet = Timesheet::find($id);
            $timesheet->delete();
            return redirect('/timesheets')->with('success', 'Post Removed');
        }


        elseif ($timesheet ==  auth()->user()->id ){
            $timesheet = Timesheet::find($id);
            $timesheet->delete();
            return redirect('/timesheets')->with('success', 'Post Removed');
        }


        else{

            return view('home')->with(abort(403, 'Unauthorized action.'));

        }


    }
}
