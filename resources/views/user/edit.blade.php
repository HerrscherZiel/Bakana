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
        <h3 class="tile-title">Edit User</h3>
        <form method="post" action="{{ route('users.update', $user->id) }}">
            @method('PATCH')
            @csrf
            <div class="tile-body">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <label class="control-label">Role</label>
                    <select class="form-control" name="role_id" required="">
                       @foreach($role as $roles)
                            <option value="{{$roles->id_role}}"
                            @if ($roles->id_role === $user->role_id)
                                selected
                            @endif
                            >{{$roles->nama_role}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Nama</label>
                  <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                </div>
               <div class="form-group">
                <label class="control-label">Email</label>
                  <input class="form-control" type="text" name="email" value="{{ $user->email }}">
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
