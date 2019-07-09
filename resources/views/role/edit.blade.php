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
            <form method="post" action="{{ route('roles.update', $role->id_project) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="nama_role">Kode Project:</label>
                    <input type="text" class="form-control" name="nama_role" value={{ $role->nama_role }} />
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="textarea" cols="5" rows="5" class="form-control" name="keterangan" value={{ $role->keterangan }} />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
