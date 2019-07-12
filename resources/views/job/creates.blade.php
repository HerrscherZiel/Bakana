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
            <form method="post" action="{{url('/jobs/create')}}">
                {{--<div class="form-group">--}}
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    {{--<label for="id_job">ID:</label>
                    <input type="text" class="form-control" name="id_job"/>--}}
                {{--</div>--}}
                <div class="form-group">
                    <label for="nama_job">Nama:</label>
                    <input type="text" class="form-control" name="nama_job"/>
                </div>
                <div class="form-group">
                    <label for="user">User:</label>
                    {{--<input type="text" class="form-control" name="user"/>--}}
                    <select class="form-control" name="user">
                        <option value="">Select Module</option>
                        @foreach($mod as $mods)
                            <option value="{{$mods->name}}">{{$mods->name}}</option>
                        @endforeach
                    </select>
                </div>
                 <div class="form-group">
                    <label for="module_id">Modul:</label>
                     <select class="form-control" name="module_id">
                             <option value="{{$module->id_module}}" selected>{{$module->nama_module}}</option>
                     </select>
                </div>
                 <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" class="form-control" name="keterangan"/>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
