@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Show
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
                <h4>ID = {{$project->id_project}}</h4>
                <h4>Kode = {{$project->kode_project}}</h4>
                <h4>Nama = {{$project->nama_project}}</h4>
                <h4>Tgl Mulai = {{$project->tgl_mulai}}</h4>
                <h4>Tgl Selesai = {{$project->tgl_selesai}}</h4>
                <h4>Status = {{$project->status}}</h4>
                <h4>Keterangan = {{$project->ket}}</h4>
                <small>Written On {{$project->created_at}}</small>
        </div>
    </div>

    {{--<div class="navbar navbar-expand-lg  " id="navigation">

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/wilayah">
                    <span class="no-icon">Index Wilayah </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/wilayah/{{$wilayah->id_wilayah}}/edit">
                    <span class="no-icon">Edit Wilayah &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </span>
                </a>
            </li>
        </ul>

    </div>
    <hr>
    <h4>Id = {{$wilayah->id_wilayah}}</h4>
    <h4>Provinsi = {{$wilayah->provinsi}}</h4>
    <h4>Kabupaten = {{$wilayah->kabupaten}}</h4>
    <h4>Kecamatan = {{$wilayah->kecamatan}}</h4>
    <h4>Deskripsi = {{$wilayah->deskripsi}}</h4>
    <small>Written On {{$wilayah->created_at}}</small>

    <br>
    <br>

    <hr>--}}



@endsection
