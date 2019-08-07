@extends('layouts.app')

@section('content')
<div class="col-md-12">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
     <div class="tile">
        <h3 class="tile-title">Edit Role</h3>
        <form method="post" action="{{ route('roles.update', $role->id_role) }}">
            @method('PATCH')
            @csrf
            <div class="tile-body">
                <div class="form-group">
                    <label class="control-label">Nama Role</label>
                  <input class="form-control" type="text" name="nama_role"  value="{{ $role->nama_role }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Keterangan</label>
                  <textarea class="form-control" rows="4" name="keterangan">{{ $role->keterangan }}</textarea>
                </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
              <a class="btn btn-secondary" href="{{URL::previous()}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
        </form>
      </div>
</div>
@endsection
