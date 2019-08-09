<?php

namespace App\Mail;

use App\Job;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($q)
    {
        //
        $this->q = $q;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->q;

        $seven  = Carbon::now()->addDay(7)->toDateString();
        $third  = Carbon::now()->addDay(3)->toDateString();
        $second = Carbon::now()->addDay(2)->toDateString();
        $first  = Carbon::now()->addDay(1)->toDateString();
        $today  = Carbon::now()->toDateString();


        $uni = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
            ->where('project.status', '!=', 4)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();


        $d7 = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
            ->where('project.status', '!=', 4)
            ->where('jobs.deadline','=', $seven)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

        $d3 = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
            ->where('project.status', '!=', 4)
            ->where('jobs.deadline','=', $third)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

        $d2 = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
            ->where('jobs.deadline','=', $second)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

        $d1 = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
            ->where('project.status', '!=', 4)
            ->where('jobs.deadline','=', $first)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

        $d0 = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
            ->where('project.status', '!=', 4)
            ->where('jobs.deadline','<=', $today)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

        $dn = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
            ->where('project.status', '!=', 4)
            ->where('jobs.deadline','<=', $today)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

        $dead = 0 ;

        $i = $this->q;


        $min73 = array_merge($d3->toArray(), $d7->toArray() );

        $min732 = array_merge($d2->toArray(), $d3->toArray(), $d7->toArray());

        $min7321 = array_merge($d1->toArray(), $d2->toArray(), $d3->toArray(), $d7->toArray());

        $min73210 = array_merge($d0->toArray(), $d1->toArray(), $d2->toArray(), $d3->toArray(), $d7->toArray());


        if ($i == 9){
            return $this->from('magangbtv@gmail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $uni,
                        'dead'  => 0,

                    ]);
        }elseif ($i == 7){
            return $this->from('magangbtv@gmail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $d7,
                        'dead'  => 7,

                    ]);
        }elseif ($i == 3){
            return $this->from('magangbtv@gmail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $min73,
                        'dead'  => 3,

                    ]);
        }elseif ($i == 2){
            return $this->from('magangbtv@gmail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $min732,
                        'dead'  => 2,

                    ]);
        }elseif ($i == 1){
            return $this->from('magangbtv@gmail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $min7321,
                        'dead'  => 1,

                    ]);
        }elseif ($i == 0){
            return $this->from('magangbtv@gmail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $min73210,
                        'dead'  => 0,

                    ]);
        }else{
            return $this->from('magangbtv@gmail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $dn,
                        'dead'  => 9,

                    ]);
        }

    }

}
