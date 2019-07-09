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
            <form method="post" action="{{url('/projects/create')}}">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <label for="kode_project">Kode Project:</label>
                    <input type="text" class="form-control" name="kode_project"/>
                </div>
                <div class="form-group">
                    <label for="nama_project">Nama Project:</label>
                    <input type="text" class="form-control" name="nama_project"/>
                </div>
                <div class="form-group">
                    <label for="tgl_mulai">Tanggal Mulai:</label>
                    <input type="date" class="form-control" name="tgl_mulai"/>
                </div>
                <div class="form-group">
                    <label for="tgl_selesai">Tanggal Selesai:</label>
                    <input type="date" class="form-control" name="tgl_selesai"/>
                </div>
                <div class="form-group">
                    <label for="status">Status Project:</label>
                    <input type="text" class="form-control" name="status"/>
                </div>
                <div class="form-group">
                    <label for="ket">Deskripsi:</label>
                    <textarea cols="5" rows="5" class="form-control" name="ket"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
