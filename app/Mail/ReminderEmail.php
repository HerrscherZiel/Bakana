<?php

namespace App\Mail;

use App\User;
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
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        $jobs = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
//            ->where('users.id', '=', auth()->user()->id)
            ->orderBy('module.nama_module')
            ->groupBy('jobs.nama_job')
            ->getQuery()
            ->get();

//        foreach ($jobs as $i){
//
//            $ii = $i->nama_job;
//            $iii = $i->nama_module;
//            $iiii = $i->deadline;

//        dd($ii);

        return $this->from('PM@mail.com')
            ->view('email')
            ->with(
                [
                    'nama' => auth()->user()->name,
                    'jobs' => $jobs,
//                    'job' => $ii,
//                    'deadline' => $iiii,

                ]);    }

//    }
}
