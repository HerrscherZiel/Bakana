@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Edit User
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('users.update', $user->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" name="name" value={{ $user->name }} />
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value={{ $user->email }} />
                </div>
                <div class="form-group">
                    <label for="role_id">Role:</label>
                    <select name="role_id" id="" class="form-control">
                        @foreach($role as $roles)
                            <option value="{{$roles->id_role}}"
                            @if ($roles->id_role === $user->role_id)
                                selected
                            @endif
                            >
                                {{$roles->nama_role}}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
