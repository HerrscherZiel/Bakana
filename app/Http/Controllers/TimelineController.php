<?php

namespace App\Http\Controllers;

use App\Job;
use App\Module;
use App\Project;
use App\Util\Utils;
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
        Session::put('title', 'Timeline All Modul');
        $val = Project::all()->where('status','!=',4);

//        $eevee = Project::join('module','project.id_project','=','module.project_id')
//            ->select('module.*', 'project.nama_project')
//            ->where('project.id_project','=',$id)
//            ->getQuery()
//            ->get();

        $events = Module::all();
        $event_list = [];
        foreach ($events as $key => $event) {
            $event_list[] = Calendar::event(
                $event->nama_module . ' : ' .$event->user,
                true,
                $event->tgl_mulai,
                $event->deadline,
                $event->id_module,
                [
                    'color' => $event->color,
                    'url' => '/timelines/job/'. $event->id_module,
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
        Session::put('title', 'Timeline Project');
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

    public function indexJob($id){
        Session::put('title', 'Timeline Job');
        $val = Project::all()->where('status','!=',4);

        $events = Project::join('module','project.id_project','=','module.project_id')
            ->join('jobs','module.id_module','=','jobs.module_id')
            ->select('jobs.*', 'module.id_module','module.nama_module', 'project.id_project','project.nama_project')
            ->where('project.id_project','=',$id)
//            ->where('module.id_module', '=', 'jobs.module_id')
            ->getQuery()
            ->get();

//        dd($events);

        $event_list = [];
        foreach ($events as $key => $event) {
            $event_list[] = Calendar::event(
                $event->nama_job . ' : ' . $event->nama_module,
                true,
                $event->tgl_mulai,
                $event->deadline,
                $event->id_job,
                [
                    'color' => $event->color,
                    'description' => $event->keterangan,
                    'textColor' => '#0A0A0A'
                ]
            );
        }

        foreach($events as $i){

            $ui = $i->id_project;
            $ii = $i->nama_project;

        }

        $calendar = \MaddHatter\LaravelFullcalendar\Facades\Calendar::addEvents($event_list);

        return view('timeline.indexBD', compact('calendar','val', 'ii', 'ui'));

    }

    public function dropProject($id){

        Session::put('title', 'Timeline Project > Modul');
        $val = Project::all()->where('status','!=',4);

        $events = Project::join('module','project.id_project','=','module.project_id')
            ->select('module.*','project.id_project', 'project.nama_project')
            ->where('project.id_project','=',$id)
            ->getQuery()
            ->get();

        $eventss = Project::select('project.id_project', 'project.nama_project')
            ->where('project.id_project','=',$id)
            ->getQuery()
            ->get();

//        dd($eventss);
        foreach($eventss as $i){

            $ui = $i->id_project;
            $ii = $i->nama_project;
        }

        $event_list = [];
        foreach ($events as $key => $event) {
            $event_list[] = Calendar::event(
                $event->nama_module . ' : ' .$event->user,
                true,
                $event->tgl_mulai,
                $event->deadline,
                $event->id_module,
                [
                    'color' => $event->color,
                    'url' => '/timelines/job/'. $event->id_module,
                    'description' => $event->keterangan,
                    'textColor' => '#0A0A0A'
                ]
            );
        }

//        dd($events);

//        dd($event_list);

        $calendar = \MaddHatter\LaravelFullcalendar\Facades\Calendar::addEvents($event_list);

//        return response()->json([
//            'error' => false,
//            'calendar'  => $calendar,
//        ], 200);

        return view('timeline.indexBD', compact('calendar','val', 'ii', 'ui'))/*->with('eevee', $eevee)*/;

    }

    public function dropJob($id){
        Session::put('title', 'Timeline Module > Job');

        $val = Module::all()->where('status','!=',4);

        $events = Module::join('jobs','module.id_module','=','jobs.module_id')
            ->select('module.nama_module', 'jobs.*')
            ->where('module.id_module','=',$id)
            ->getQuery()
            ->get();

        $eventss = Module::select('module.id_module', 'module.nama_module')
            ->where('module.id_module','=',$id)
            ->getQuery()
            ->get();

//        dd($events);

        foreach($eventss as $i){
            $ii = $i->nama_module;
        }

        $event_list = [];
        foreach ($events as $key => $event) {
            $event_list[] = Calendar::event(
                $event->nama_job . ' : ' .$event->user,
                true,
                $event->tgl_mulai,
                $event->deadline,
                $event->id_job,
                [
                    'color' => $event->color,
                    'description' => $event->keterangan,
                    'textColor' => '#0A0A0A'
                ]
            );
        }



        $calendar = \MaddHatter\LaravelFullcalendar\Facades\Calendar::addEvents($event_list);

        return view('timeline.indexMJ', compact('calendar','val', 'ii'));

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
