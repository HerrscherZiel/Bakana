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
            <form method="post" action="{{url('/modules/create')}}">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <label for="id_module">ID:</label>
                    <input type="text" class="form-control" name="id_module"/>
                </div>
                <div class="form-group">
                    <label for="nama_module">Nama:</label>
                    <input type="text" class="form-control" name="nama_module"/>
                </div>
                 <div class="form-group">
                    <label for="waktu">Waktu:</label>
                    <input type="text" class="form-control" name="waktu"/>
                </div>
                 <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" class="form-control" name="status"/>
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
