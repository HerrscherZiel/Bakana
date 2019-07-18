@extends('layouts.app')

@section('content')

    <div class="row">
        <!-- <div class="tile">
        @foreach($users as $user)
        <h3>{{$user->name}} sebagai
        {{$user->nama_role}}</h3>
        @endforeach
        </div> -->
        <!-- //nek iso project e option value, select pertama ning project pertama -->
        @foreach($info as $infos)
  <div class="col-md-6">
        <div class="tile">
          <div class="tile-title-w-btn">
            <h3 class="title">{{$infos->nama_project}}</h3>
          </div>
          <div class="tile-body">
           <div class="row">
            <div class="col-md-6">
               <a>Status: <b>
              @if ($infos->status === 1 )
                    Ongoing
                @elseif($infos->status === 2 )
                    Queue
                @elseif($infos->status === 3 )
                    Pending
                @elseif($infos->status === 4 )
                    Completed
                @endif
               </b></a><br>
               <a>dari: {{ date("d-m-Y", strtotime($mulai = $infos->tgl_mulai))}}</a><br>
               <a>sampai: {{date("d-m-Y", strtotime($selesai = $infos->tgl_selesai))}}</a>
             </div>
             <div class="col-md-6">
               
               <a>Total Waktu (Hari): <b>{{$total = (strtotime($selesai) - strtotime($mulai)) / (60 * 60 * 24) }}</b></a><br>
               <a>Sisa Waktu (Hari): <b>{{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) }}</b></a>
             </div>
            </div>
          </div>
           <div class="tile-footer">
           <a href="/userInfo/module/{{$infos->id_project}}" class="btn btn-primary">Show Modul</a>
        </div>
        </div>
      </div>
      @endforeach
  </div>
@endsection
