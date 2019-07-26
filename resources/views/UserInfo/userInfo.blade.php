@extends('layouts.app')

@section('content')

<div class="row user">
  <div class="col-md-3">
    <div class="tile p-0">
      <ul class="nav flex-column nav-tabs user-tabs">
        <li class="nav-item"><a class="nav-link active" href="#user-profile" data-toggle="tab">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="#user-timesheet" data-toggle="tab">Timesheet</a></li>
        <li class="nav-item"><a class="nav-link" href="#user-project" data-toggle="tab">Project</a></li>
      </ul>
    </div>
  </div>
  <div class="col-md-9">
    <div class="tab-content">
      <div class="col-md-7 tab-pane active" id="user-profile">
        <div class="tile">
          @foreach($users as $user)
          <div class="row">
            <div class="col-md-6">
              <h5 class="text-muted">Username </h5>
              <h5 class="text-muted">Email </h5>
              <h5 class="text-muted">Role </h5>
              <h5 class="text-muted">Password </h5>
            </div>
            <div class="col-md-6">
              <h5>: {{$user->name}}</h5>
              <h5>: {{$user->email}}</h5>
              <h5>: {{$user->nama_role}}</h5>
              : <a class="btn btn-outline-info btn-sm" href="/change/pass">Change Password</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="tab-pane fade" id="user-timesheet">
        <div class="tile">
        <div class="tile-body">
        <table class="table table-striped">
            <a href="{{url('/timesheets/create')}}" class="btn btn-primary mb-3 mr-2"> <i class="fa fa-plus"></i>Add Timesheet</a>
            <a href="{{url('/myCompletedProject')}}" class="btn btn-primary mb-3"> Completed Project</a>
            <h3>Your Last Timesheet</h3>
            <thead>
              <tr>
                <th>Project</th>
                <th>Tanggal</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Total Waktu</th>
                <th>Keterangan</th>
            </tr>
            </thead>
            <tbody>
              <tr>
                 @foreach($timesheets as $timesheet)
                <td>{{$timesheet->project}}</td>
                <td>{{date("d-m-Y", strtotime($timesheet->tgl_timesheet))}}</td>
                <td>{{$mulai = $timesheet->jam_mulai}}</td>
                <td>{{$selesai = $timesheet->jam_selesai}}</td>
                <td>{{$total = (strtotime($selesai) - strtotime($mulai))/60 }} menit</td>
                <td>{{$timesheet->keterangan_timesheet}}</td>
                </tr>
               @endforeach
            </tbody>
          </table>
          <div class="row d-print-none mt-2">
             <div class="col-12 text-right"><a href="{{url('/timesheetss')}}" class="btn btn-warning pull-right">Show More</a></div>
          </div>
        </div>
        </div>
      </div>
      <div class="tab-pane fade" id="user-project">
        @foreach($info as $infos)
        <div class="tile">
          <div class="tile-title-w-btn">
            <h3 class="title">{{$infos->nama_project}}</h3>
            <a href="/userInfo/module/{{$infos->id_project}}" class="btn btn-primary">Show Modul</a>
          </div>
          <div class="tile-body">
           <div class="row">
            <div class="col-md-6">
               <a>Status: <b>
              @if ($infos->status === 1 )
                    <span class="badge badge-pill badge-primary">Ongoing</span>
                @elseif($infos->status === 2 )
                    <span class="badge badge-pill badge-secondary">Queue</span>
                @elseif($infos->status === 3 )
                    <span class="badge badge-pill badge-warning">Pending</span>
                @elseif($infos->status === 4 )
                    <span class="badge badge-pill badge-success">Completed</span>
                @elseif($infos->status === 5 )
                    <span class="badge badge-pill badge-dark">Canceled</span>
                @endif
               </b></a><br>
               <a>dari: {{ date("d-m-Y", strtotime($mulai = $infos->tgl_mulai))}}</a><br>
               <a>sampai: {{date("d-m-Y", strtotime($selesai = $infos->tgl_selesai))}}</a>
             </div>
             <div class="col-md-6">
               
               <a>Total Waktu: <b>{{$total = (strtotime($selesai) - strtotime($mulai)) / (60 * 60 * 24) }} hari</b></a><br>
               <a>Sisa Waktu: <b>{{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) }} hari</b></a>
             </div>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
