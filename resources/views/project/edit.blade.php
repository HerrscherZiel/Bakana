@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Edit Share
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
            <form method="post" action="{{ route('projects.update', $project->id_project) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="kode_project">Kode Project:</label>
                    <input type="text" class="form-control" name="kode_project" value={{ $project->kode_project }} />
                </div>
                <div class="form-group">
                    <label for="nama_project">Nama Project:</label>
                    <input type="text" class="form-control" name="nama_project" value={{ $project->nama_project }} />
                </div>
                <div class="form-group">
                    <label for="tgl_mulai">Tanggal Mulai:</label>
                    <input type="date" class="form-control" name="tgl_mulai" value={{ $project->tgl_mulai }} />
                </div>
                <div class="form-group">
                    <label for="tgl_selesai">Tanggal Selesai:</label>
                    <input type="date" class="form-control" name="tgl_selesai" value={{ $project->tgl_selesai }} />
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" class="form-control" name="status" value={{ $project->status }} />
                </div>
                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <input type="textarea" cols="5" rows="5" class="form-control" name="ket" value={{ $project->ket }} />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
