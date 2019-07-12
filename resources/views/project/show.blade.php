@extends('layouts.app')

@section('content')
<div class="card uper">
    <div class="card-header">
        <h4>{{$project->nama_project}}</h4>
        <a href="/module/creates/{{$project->id_project}}" class="btn btn-primary pull-right">Add Module</a>
        <br>
        <br>
        <br>
        <a href="/team/creates/{{$project->id_project}}" class="btn btn-primary pull-right">Add Team</a>
    </div>
    <div class="card-body">
        <h6>Kode = {{$project->kode_project}}</h6>
        <h6>Nama = {{$project->nama_project}}</h6>
        <h6>Tgl Mulai = {{$project->tgl_mulai}}</h6>
        <h6>Tgl Selesai = {{$project->tgl_selesai}}</h6>
        <h6>Status = {{$project->status}}</h6>
        <h6>Keterangan = {{$project->ket}}</h6>

{{--        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h3 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  Module #1
                </button>
              </h3>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. 
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Module #2
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Module #3
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
        </div>--}}
        <small>Written On {{$project->created_at}}</small>

    </div>


    <table class="table table-striped">
        <thead>
        <tr>
{{--            <td>ID</td>--}}
            <td>Nama</td>
            <td>Waktu</td>
            <td>Status</td>
{{--            <td>Project Name</td>--}}
            <td>Keterangan</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach($module as $modules)
            <tr>
{{--                <td>{{$modules->id_module}}</td>--}}
                <td>{{$modules->nama_module}}</td>
                <td>{{$modules->waktu}}</td>
                <td>{{$modules->status}}</td>
{{--                <td>{{$modules->nama_project}}</td>--}}
                <td>{{$modules->keterangan}}</td>

                <td>
                    <div class="btn-group">
                        <a class="btn btn-primary" href="/modules/{{$modules->id_module}}">
                            <i class="fa fa-lg fa-eye">
                            </i>
                        </a>
                        <a class="btn btn-info" href="/modules/{{$modules->id_module}}/edit">
                            <i class="fa fa-lg fa-edit">
                            </i>
                        </a>

                            <form action="{{ route('modules.destroy', $modules->id_module)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                <i class="fa fa-lg fa-trash">
                                </i>
                                </button>

                            </form>

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


</div>

@endsection
