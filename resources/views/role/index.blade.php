@extends('layouts.app')

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body table-responsive">
          <table class="table table-hover table-bordered" id="sampleTable">
            <a href="{{url('/roles/create')}}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Create Role</a>
            <thead>
              <tr>
                <th>Nama Role</th>
                <th>Keterangan</th>
                <th style="width: 10%">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($role as $roles)
                <td>{{$roles->nama_role}}</td>
                <td>{{$roles->keterangan}}</td>
                <td>
                    <div class="btn-group">
                        <a class="btn btn-info" href="/roles/{{$roles->id_role}}/edit">
                            <i class="fa fa-lg fa-edit">
                            </i>
                        </a>
                            <form class="delete" action="{{ route('roles.destroy', $roles->id_role)}}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger delete-btn" type="submit" style="margin-left: -2px">
                                <i class="fa fa-lg fa-trash">
                                </i>
                                </button>
                            </form>
                    </div>
                </td>
              </tr>
               @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection
