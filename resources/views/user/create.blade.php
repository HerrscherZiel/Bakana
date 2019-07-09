@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif
        <div class="row">
            <form method="post" action="{{url('/users/create')}}">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                </div>
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" name="name"/>
                </div>
                 <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email"/>
                </div>
                 <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password"/>
                </div>
                <div class="form-group">
                    <label for="role_id">Role:</label>
                    <select name="role_id" id="" class="form-control">
                        @foreach($role as $roles)
                            <option value="{{$roles->id_role}}">{{$roles->nama_role}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
