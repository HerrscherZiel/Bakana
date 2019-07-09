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
            <form method="post" action="{{ route('roles.update', $role->id_project) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" name="id" value={{ $user->id }} />
                </div>
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" name="name" value={{ $user->name }} />
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value={{ $user->email }} />
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" class="form-control" name="password" value={{ $user->password }} />
                </div>
                <div class="form-group">
                    <label for="role_id">Role ID:</label>
                    <input type="text" class="form-control" name="role_id" value={{ $user->role_id }} />
                </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
