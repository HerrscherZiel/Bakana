<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Timesheet;


class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $timesheetView = Timesheet::join('users', 'users.id', '=', 'timesheets.user_id')
            ->select('timesheets.*', 'users.name')
            ->getQuery()
            ->get();

        return view('timesheet.index')->with('timesheet', $timesheetView);
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

        return view('timesheet.create')->with('user', $user);
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
            'tgl_timesheet' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'keterangan_timesheet' => 'required',
            'user_id' => 'required']);


        $timesheet = new Timesheet();
        $timesheet->tgl_timesheet = $request->input('tgl_timesheet');
        $timesheet->jam_mulai = $request->input('jam_mulai');
        $timesheet->jam_selesai = $request->input('jam_selesai');
        $timesheet->keterangan_timesheet = $request->input('keterangan_timesheet');
        $timesheet->user_id = $request->input('user_id');
        $timesheet->save();
        return redirect('/timesheets')->with('success', 'User Ditambahkan');
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

        $timesheet = Timesheet::find($id);
        return view('timesheet.edit', compact('timesheet','user'));
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
        $timesheet->jam_mulai = $request->input('jam_mulai');
        $timesheet->jam_selesai = $request->input('jam_selesai');
        $timesheet->keterangan_timesheet = $request->input('keterangan_timesheet');
        $timesheet->save();
        return redirect('/timesheets')->with('success', 'User Diedit');
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
        $timesheet = Timesheet::find($id);
        $timesheet->delete();
        return redirect('/timesheets')->with('success', 'Post Removed');
    }
}
