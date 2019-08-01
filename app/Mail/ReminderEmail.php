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

//        $d7 = Job::where('deadline','==', $seven)->get();
//        $d3 = Job::where('deadline','==', $third)->get();
//        $d2 = Job::where('deadline','==', $second)->get();
//        $d1 = Job::where('deadline','==', $first)->get();
//        $d0 = Job::where('deadline','==', $today)->get();

        $uni = User::join('team_projects','users.id','=','team_projects.user_id')
            ->join('project','team_projects.project_id','=','project.id_project')
            ->join('module', 'project.id_project', '=', 'module.project_id')
            ->join('jobs', 'module.id_module', '=' ,'jobs.module_id')
            ->select( 'module.*', 'jobs.nama_job', 'jobs.id_job', 'jobs.tgl_mulai as jobMulai','jobs.deadline as deadlineJob', 'jobs.status as statusJob', 'jobs.keterangan as ketJobs'
                , 'jobs.module_id')
            ->where('users.id', '=', auth()->user()->id)
            ->where('jobs.user', '=',  auth()->user()->name)
            ->where('jobs.status', '!=', 4)
//            ->where('users.id', '=', auth()->user()->id)
            ->where('project.status', '!=', 4)
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

//        dd($d0);

        $i = $this->q;

//        $d7 = $jobs::where('deadline','==', $seven)->get();
//        $d3 = $jobs::where('deadline','==', $third)->get();
//        $d2 = $jobs::where('deadline','==', $second)->get();
//        $d1 = $jobs::where('deadline','==', $today)->get();

//        $jobs = 0;
//        $dead = 0;
//
//        foreach ($uni as $j){
//            if($j->deadlineJob == $seven){
//                $jobs = $d7;
//                $dead = 7;
//            }elseif ($j->deadlineJob == $third){
//                $jobs = $d3;
//                $dead = 3;
//            }elseif ($j->deadlineJob == $second){
//                $jobs = $d2;
//                $dead = 2;
//            }elseif ($j->deadlineJob == $first){
//                $jobs = $d1;
//                $dead = 1;
//            }elseif ($j->deadlineJob == $today){
//                $jobs = $d0;
//                $dead = 0;
//            }else{
//                $jobs = $dn;
//            }
//        }

//        if($today == $seven){
//            $jobs = $d7;
//            $dead = 7;
//        }elseif ($today == $third){
//            $jobs = $d3;
//            $dead = 3;
//        }elseif ($today == $second){
//            $jobs = $d2;
//            $dead = 2;
//        }elseif ($today == $first){
//            $jobs = $d1;
//            $dead = 1;
//        }elseif ($today == $today){
//            $jobs = $d0;
//            $dead = 0;
//        }

//        dd($jobs);

//        foreach ($jobs->deadlineJob as $dj){
//            if($dj == $seven){
//                $w[] = array_merge($w, $d7);
//                $dead = 7;
//            }elseif ($dj == $third){
//                $w[] = array_merge($w, $d3);
//                $dead = 3;
//            }elseif ($dj == $second){
//                $w[] = array_merge($w, $d2);
//                $dead = 2;
//            }elseif ($dj == $today){
//                $w[] = array_merge($w, $d1);
//                $dead = 1;
//            }else{
//                $w[] = array_merge($w, $d0);
//                $dead = 0;
//            }
//        }

//        if ($d7){
//            return $this->from('PM@mail.com')
//                ->view('email')
//                ->with(
//                    [
//                        'nama' => auth()->user()->name,
//                        'jobs' => $d7,
//
//                    ]);
//        }elseif ($d3){
//            return $this->from('PM@mail.com')
//                ->view('email')
//                ->with(
//                    [
//                        'nama' => auth()->user()->name,
//                        'jobs' => $d3,
//                    ]);
//        }elseif ($d2){
//            return $this->from('PM@mail.com')
//                ->view('email')
//                ->with(
//                    [
//                        'nama' => auth()->user()->name,
//                        'jobs' => $d2,
//                    ]);
//        }elseif ($d1){
//            return $this->from('PM@mail.com')
//                ->view('email')
//                ->with(
//                    [
//                        'nama' => auth()->user()->name,
//                        'jobs' => $d1,
//                    ]);
//        }

//        dd($dn);

        $min73 = array_merge($d3->toArray(), $d7->toArray() );
//        dd($min73);

        $min732 = array_merge($d2->toArray(), $d3->toArray(), $d7->toArray());
//        dd($min732);

        $min7321 = array_merge($d1->toArray(), $d2->toArray(), $d3->toArray(), $d7->toArray());
//        dd($min7321);

        $min73210 = array_merge($d0->toArray(), $d1->toArray(), $d2->toArray(), $d3->toArray(), $d7->toArray());
//        dd($min73210);


        if ($i == 9){
            return $this->from('PM@mail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $uni,
                        'dead'  => 0,

                    ]);
        }elseif ($i == 7){
            return $this->from('PM@mail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $d7,
                        'dead'  => 7,

                    ]);
        }elseif ($i == 3){
            return $this->from('PM@mail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $min73,
                        'dead'  => 3,

                    ]);
        }elseif ($i == 2){
            return $this->from('PM@mail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $min732,
                        'dead'  => 2,

                    ]);
        }elseif ($i == 1){
            return $this->from('PM@mail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $min7321,
                        'dead'  => 1,

                    ]);
        }elseif ($i == 0){
            return $this->from('PM@mail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $min73210,
                        'dead'  => 0,

                    ]);
        }else{
            return $this->from('PM@mail.com')
                ->view('email')
                ->with(
                    [
                        'nama'  => auth()->user()->name,
                        'jobs'  => $dn,
                        'dead'  => 9,
//                    'job' => $ii,
//                    'deadline' => $iiii,
                    ]);
        }

    }



//    }
}
