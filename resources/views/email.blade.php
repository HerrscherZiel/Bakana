
    <h3>Halo, {{ $nama }} !</h3>

{{--    <p>Batas waktu pengerjaan <b>{{ $job }}</b> pada Module <b>{{ $module }}</b>--}}

{{--    <br> pada tanggal <p>{{ $deadline }}</p>--}}


    ///////////////////////////////////////////////////////////////////////////

    <p>Anda memiliki beberapa job seperti ...</p> <br>


    <table class="table table-striped">
        <thead>
        <tr>
            <th>Module</th>
            <th>Job</th>
            <th>Tanggal Mulai</th>
            <th>Deadline</th>
            {{--                                    <th>Tanggal Target</th>--}}
            <th>Sisa Waktu</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        {{--                            @foreach($job as $jobs)--}}

        @foreach($jobs as $job)
{{--            @if ($modules->id_module === $job->module_id)--}}
                <tr>
                    <td>{{$job->nama_module}}</td>
                    <td>{{$job->nama_job}}</td>
                    <td>{{date("d-m-Y", strtotime($mulai = $job->jobMulai))}}</td>
                    <td>{{date("d-m-Y", strtotime($selesai = $job->deadlineJob))}}</td>
                    {{--                                <td>{{$jobs->tgl_user ? date("d-m-Y", strtotime($jobs->tgl_user)) : ''}}</td>--}}
                    <td>
                        @if($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) > 0 )
                            {{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24)}} Hari
                        @elseif($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) == 0 )
                            Deadline
                        @else
                            Melewati Deadline
                        @endif
                    </td>
                    <td>@if ($job->status === 1 )
                            Ongoing
                        @elseif($job->status === 2 )
                            Queue
                        @elseif($job->status === 3 )
                            Pending
                        @elseif($job->status === 4 )
                            Completed
                        @endif</td>
                    <td>{{$job->keterangan}}</td>
                    <td>

                        <div class="btn-group">

{{--                            <a class="btn btn-info" href="/job/{{$job->id_job}}/edit">--}}
{{--                                <i class="fa fa-lg fa-edit">--}}
{{--                                </i>--}}
{{--                            </a>--}}
{{--                            @if(Auth::user()->hasRole('Project Manager'))--}}
{{--                                <form action="{{ route('jobs.destroy', $job->id_job)}}" method="post">--}}
{{--                                    <input type="hidden" name="_method" value="DELETE">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button class="btn btn-danger" type="submit" onclick="archiveFunction()" style="margin-left: -2px">--}}
{{--                                        <i class="fa fa-lg fa-trash">--}}
{{--                                        </i>--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            @endif--}}
                        </div>
                    </td>
                </tr>
                {{--@endforeach--}}
{{--            @endif--}}
        @endforeach
        </tbody>
    </table>
