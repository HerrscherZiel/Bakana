<?php

namespace App\Http\Controllers;

use App\Job;
use App\Module;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use MaddHatter\LaravelFullcalendar\Calendar;
//use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $val = Project::all();

        $events = Module::all();
        $event_list = [];
        foreach ($events as $key => $event) {
            $event_list[] = Calendar::event(
                $event->nama_module,
                true,
                $event->tgl_mulai,
                $event->deadline,
                $event->id_module,
                [
                    'color' => $event->colors,
                    'url' => '/modules/'. $event->id_module,
                    'description' => $event->keterangan,
                    'textColor' => '#0A0A0A'
                ]
            );
        }
        $calendar = \MaddHatter\LaravelFullcalendar\Facades\Calendar::addEvents($event_list);

        return view('timeline.index', compact('calendar','val', 'events'))/*->with('calendar', $calendar, 'val', $val)*/;

//        return view('home', compact( 'module', 'calendar'));
    }

    public function indexProject(){

        $events = Project::all();
        $event_list = [];
        foreach ($events as $key => $event) {
            $event_list[] = Calendar::event(
                $event->nama_project,
                true,
                $event->tgl_mulai,
                $event->tgl_selesai,
                $event->id_project
            );
        }

        $calendar = \MaddHatter\LaravelFullcalendar\Facades\Calendar::addEvents($event_list);

        return view('timeline.indexOfProjects')->with('calendar', $calendar);

    }

    public function dropProject($id){

        $events = Project::join('module','project.id_project','=','module.project_id')
            ->select('module.*')
            ->where('project.id_project','=',$id)
            ->getQuery()
            ->get();

//        dd($events);

        $event_list = [];
        foreach ($events as $key => $event) {
            $event_list[] = Calendar::event(
                $event->nama_module,
                true,
                $event->tgl_mulai,
                $event->deadline,
                $event->id_module,
                [
                    'color' => $event->colors,
                    'url' => '/modules/'. $event->id_module,
                    'description' => $event->keterangan,
                    'textColor' => '#0A0A0A'
                ]
            );
        }

//        dd($event_list);

        $calendar = \MaddHatter\LaravelFullcalendar\Facades\Calendar::addEvents($event_list);

        return response()->json([
            'error' => false,
            'calendar'  => $calendar,
        ], 200);

//        return view('timeline.index,')->with('calendar', $calendar);

    }

    public function indexJob(){

        $events = Job::all();
        $event_list = [];
        foreach ($events as $key => $event) {
            $event_list[] = Calendar::event(
                $event->nama_job,
                true,
                $event->tgl_mulai,
                $event->deadline,
                $event->id_job,
                [
                    'color' => $event->colors,
                    'url' => '/modules/'. $event->id_job,
                    'description' => $event->keterangan,
                    'textColor' => '#0A0A0A'
                ]
            );
        }

        $calendar = \MaddHatter\LaravelFullcalendar\Facades\Calendar::addEvents($event_list);

        return view('timeline.indexOfJobs')->with('calendar', $calendar);

    }

    /*public function addEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('warnning','Please enter the valid details');
            return Redirect::to('/events')->withInput()->withErrors($validator);
        }

        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->save();

        Session::flash('success','Event added successfully.');
        return Redirect::to('/timeline');
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
}
