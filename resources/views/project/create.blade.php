@extends('layouts.app')

@section('content')
<div class="col-md-12">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
{{--        {{ dd($errors) }}--}}

      <div class="tile">
        <h3 class="tile-title">Create Project</h3>
        <form method="post" action="{{url('/projects/create')}}">
            <div class="tile-body">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <input class="form-control  @error('kode_project') is-invalid @enderror" name="kode_project" type="text" placeholder="Project Code">
                    @error('kode_project')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" name="nama_project" placeholder="Project Name">
                </div>
                <div class="form-group input-group">
                    <input id="date1" class="form-control" name="tgl_mulai" placeholder="Start Date" readonly="">
                    <div class="mt-1 ml-3 mr-3">to</div>
                    <input id="date2" class="form-control" name="tgl_selesai" placeholder="Finish Date" readonly>
                </div>
                <div class="form-group">
                    <select class="form-control" name="status" required="">
                        <option disabled>Select Status</option>
                            <option value=1>Ongoing</option>
                            <option value=2>Queue</option>
                    </select>
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows="4" name="ket" placeholder="Description"></textarea>
                </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
              <a class="btn btn-secondary" href="{!! URL::previous() !!}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
        </form>
      </div>
</div>

@endsection
