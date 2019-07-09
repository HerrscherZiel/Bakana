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
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" name="id"/>
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
                    <input type="text" class="form-control" name="password"/>
                </div>
                <div class="form-group">
                    <label for="role_id">Role ID:</label>
                    <input type="text" class="form-control" name="role_id"/>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
