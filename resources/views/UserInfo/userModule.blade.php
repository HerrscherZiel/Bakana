@extends('layouts.app')

@section('content')
   <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
        	<h3>
        		@foreach($project as $pro)
        			{{$pro->nama_project}}
        		@endforeach
    </h3>
          <table class="table table-hover table-bordered" id="sampleTable">
            <!-- <a href="{{url('/register')}}" class="btn btn-primary mb-3">Tambah User</a> -->
            <thead>
              <tr>
                <th>Module</th>
                <th>Job</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                 @foreach($modulpro as $mod)
                <td> {{$mod->nama_module}}</td>
                <td>{{$mod->nama_job}}</td>
                <td>@if ($mod->status === 1 )
	                Ongoing
	            @elseif($mod->status === 2 )
	                Queue
	            @elseif($mod->status === 3 )
	                Pending
	            @elseif($mod->status === 4 )
	                Completed
	            @endif</td>
                <td>{{$mod->keterangan}}</td>
                <td><a class="btn btn-info" href="/module/{{$mod->id_module}}/edit">
                        <i class="fa fa-lg fa-edit">
                        </i>
                    </a></td>
              </tr>
               @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection
