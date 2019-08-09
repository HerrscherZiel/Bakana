<!DOCTYPE html>
<html lang="en" style="font-family: sans-serif; line-height: 1.15; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -ms-overflow-style: scrollbar; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Reminder</title>
    </head>
    <body style='font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 0.875rem; font-weight: 400; line-height: 1.5; color: #212529; text-align: left; margin: 0;' bgcolor="#FFF">
        <input type="hidden" value=" {{$rekrusif = 0}}"/>
        <input type="hidden" value=" {{$rekrusif1 = 0}}"/>
        <input type="hidden" value=" {{$rekrusif2 = 0}}"/>
        <input type="hidden" value=" {{$rekrusif3 = 0}}"/>
        <input type="hidden" value=" {{$rekrusif7 = 0}}"/>
        <div style="position: relative; background-color: #ffffff; border-radius: 3px; -webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); margin-bottom: 30px; -webkit-transition: all 0.3s ease-in-out; -o-transition: all 0.3s ease-in-out; transition: all 0.3s ease-in-out; padding: 20px;">
         <div class="page-header">
            <h2 style="margin-top: 0; margin-bottom: 0.5rem; font-family: inherit; border-radius: 3px; background-color: #009688; color: #FFF !important; padding: 10px;" align="center">Timeline Reminder</h2>
         </div>
            <div style="margin-bottom: 2rem; background-color: #e9ecef; border-radius: 0.3rem; padding: 2rem 1rem;">
	          	@if($dead == 0)
	                  <h1 style="margin-top: 0; margin-bottom: 0.5rem; font-family: inherit; font-size: 4.5rem; font-weight: 300; line-height: 1.2;">Deadline !</h1>
	                  <p>Halo, {{ $nama }} ! Anda memiliki beberapa job yang sudah mencapai deadline. Segera selesaikan. Lihat tabel di bawah.</p>
	              @else
	                  <h1 style="margin-top: 0; margin-bottom: 0.5rem; font-family: inherit; font-size: 4.5rem; font-weight: 300; line-height: 1.2;">{{ $dead }} hari lagi !</h1>
	                  <p style="margin-top: 0; margin-bottom: 1rem;">Halo, {{ $nama }} ! Anda memiliki beberapa job yang harus segera diselesaikan dalam {{ $dead }} hari. Lihat tabel di bawah.</p>
	              @endif
          </div>
        @foreach($jobs as $jo)
            @if((strtotime($jo->deadlineJob) - strtotime('today')) / (60 * 60 * 24) <= 0)
                @if($rekrusif < 1)
                <table style="border-collapse: collapse; width: 100%; max-width: 100%; margin-bottom: 1rem;" bgcolor="transparent">
                    <thead>
                        <tr>
                            <th style="width: 20%" align="inherit">Modul</th>
                            <th style="width: 30%" align="inherit">Job</th>
                            <th style="width: 10%" align="inherit">Deadline</th>
                            <th style="width: 10%" align="inherit">Sisa Waktu</th>
                            <th style="width: 10%" align="inherit">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                            @if((strtotime($job->deadlineJob) - strtotime('today')) / (60 * 60 * 24) <= 0)
                                <tr>
                                    <td>{{$job->nama_module}}</td>
                                    <td>{{$job->nama_job}}</td>
                                    <td>{{date("d-m-Y", strtotime($selesai = $job->deadlineJob))}}</td>
                                    <td>
                                        @if($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) > 0 )
                                            {{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24)}} Hari
                                        @elseif($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) == 0 )
                                           <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 0.25rem; color: #212529; background-color: #ffc107; padding: 0.25em 0.4em;">Deadline</span>
                                        @else
                                           <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 0.25rem; color: #FFF; background-color: #dc3545; padding: 0.25em 0.4em;">Melewati Deadline</span>
                                        @endif
                                    </td>
                                    <td>@if ($job->status === 1 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #009688; padding: 0.25em 0.6em;">Ongoing</span>
                                        @elseif($job->status === 2 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #6c757d; padding: 0.25em 0.6em;">Queue</span>
                                        @elseif($job->status === 3 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #212529; background-color: #ffc107; padding: 0.25em 0.6em;">Pending</span>
                                        @elseif($job->status === 4 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #28a745; padding: 0.25em 0.6em;">Completed</span>
                                        @elseif($projects->status === 5 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #343a40; padding: 0.25em 0.6em;">Canceled</span>
                                        @endif</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <input type="hidden" value="{{$re = 1}}"/>
                <input type="hidden" value="{{$rekrusif += $re}}"/>
                    @endif
                @elseif((strtotime($jo->deadlineJob) - strtotime('today')) / (60 * 60 * 24) == 1)
                    @if($rekrusif1 < 1)
                     <div>
                        <h3 style="margin: 0; font-family: inherit; background-color: #e9ecef; color: #555 !important; padding:7px;" align="center">Deadline dalam 1 hari</h3>
                     </div>
                        <table style="border-collapse: collapse; width: 100%; max-width: 100%; margin-bottom: 1rem;" bgcolor="transparent">
                            <thead>
                            <tr>
                                <th style="width: 20%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Modul</th>
                                <th style="width: 30%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Job</th>
                                <th style="width: 10%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Deadline</th>
                                <th style="width: 10%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Sisa Waktu</th>
                                <th style="width: 10%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $job)
                                @if((strtotime($job->deadlineJob) - strtotime('today')) / (60 * 60 * 24) == 1)
                                <tr>
                                    <td style="border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; padding: 0.75rem;" valign="top">{{$job->nama_module}}</td>
                                    <td style="border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; padding: 0.75rem;" valign="top">{{$job->nama_job}}</td>
                                    <td style="border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; padding: 0.75rem;" valign="top">{{date("d-m-Y", strtotime($selesai = $job->deadlineJob))}}</td>
                                    <td style="border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; padding: 0.75rem;" valign="top">
                                        @if($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) > 0 )
                                            {{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24)}} Hari
                                        @elseif($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) == 0 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 0.25rem; color: #212529; background-color: #ffc107; padding: 0.25em 0.4em;">Deadline</span>
                                        @else
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 0.25rem; color: #FFF; background-color: #dc3545; padding: 0.25em 0.4em;">Melewati Deadline</span>
                                        @endif
                                    </td>
                                    <td style="border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; padding: 0.75rem;" valign="top">@if ($job->status === 1 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #009688; padding: 0.25em 0.6em;">Ongoing</span>
                                        @elseif($job->status === 2 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #6c757d; padding: 0.25em 0.6em;">Queue</span>
                                        @elseif($job->status === 3 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #212529; background-color: #ffc107; padding: 0.25em 0.6em;">Pending</span>
                                        @elseif($job->status === 4 )
                                            <span  style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #28a745; padding: 0.25em 0.6em;">Completed</span>
                                        @elseif($projects->status === 5 )
                                            <span  style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #343a40; padding: 0.25em 0.6em;">Canceled</span>
                                        @endif</td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <input type="hidden" value="{{$re = 1}}"/>
                        <input type="hidden" value="{{$rekrusif1 += $re}}"/>
                        @endif

                @elseif((strtotime($jo->deadlineJob) - strtotime('today')) / (60 * 60 * 24) == 2)
                    @if($rekrusif2 < 1)
                    <div>
                        <h3 style="margin: 0; font-family: inherit; background-color: #e9ecef; color: #555 !important; padding:7px;" align="center">Deadline dalam 2 hari</h3>
                     </div>
                    <table style="border-collapse: collapse; width: 100%; max-width: 100%; margin-bottom: 1rem;" bgcolor="transparent">
                        <thead>
                        <tr>
                            <th style="width: 20%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Modul</th>
                            <th style="width: 30%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;">Job</th>
                            <th style="width: 10%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Deadline</th>
                            <th style="width: 10%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Sisa Waktu</th>
                            <th style="width: 10%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($jobs as $job)
                            @if((strtotime($job->deadlineJob) - strtotime('today')) / (60 * 60 * 24) == 2)
                                <tr>
                                    <td>{{$job->nama_module}}</td>
                                    <td>{{$job->nama_job}}</td>
                                    <td>{{date("d-m-Y", strtotime($selesai = $job->deadlineJob))}}</td>
                                    <td>
                                        @if($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) > 0 )
                                            {{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24)}} Hari
                                        @elseif($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) == 0 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 0.25rem; color: #212529; background-color: #ffc107; padding: 0.25em 0.4em;">Deadline</span>
                                        @else
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 0.25rem; color: #FFF; background-color: #dc3545; padding: 0.25em 0.4em;">Melewati Deadline</span>
                                        @endif
                                    </td>
                                    <td>@if ($job->status === 1 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #009688; padding: 0.25em 0.6em;">Ongoing</span>
                                        @elseif($job->status === 2 )
                                            <span  style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #6c757d; padding: 0.25em 0.6em;">Queue</span>
                                        @elseif($job->status === 3 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #212529; background-color: #ffc107; padding: 0.25em 0.6em;">Pending</span>
                                        @elseif($job->status === 4 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #28a745; padding: 0.25em 0.6em;">Completed</span>
                                        @elseif($projects->status === 5 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #343a40; padding: 0.25em 0.6em;">Canceled</span>
                                        @endif</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" value="{{$re = 1}}"/>
                    <input type="hidden" value="{{$rekrusif2 += $re}}"/>
                @endif

                @elseif((strtotime($jo->deadlineJob) - strtotime('today')) / (60 * 60 * 24) == 3)

                    @if($rekrusif3 < 1)
                    <div>
                        <h3 style="margin: 0; font-family: inherit; background-color: #e9ecef; color: #555 !important; padding:7px;" align="center">Deadline dalam 3 hari</h3>
                     </div>
                    <table style="border-collapse: collapse; width: 100%; max-width: 100%; margin-bottom: 1rem;" bgcolor="transparent">
                        <thead>
                        <tr>
                            <th style="width: 20%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Modul</th>
                            <th style="width: 30%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Job</th>
                            <th style="width: 10%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Deadline</th>
                            <th style="width: 10%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Sisa Waktu</th>
                            <th style="width: 10%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobs as $job)
                            @if((strtotime($job->deadlineJob) - strtotime('today')) / (60 * 60 * 24) == 3)
                                <tr>
                                    <td>{{$job->nama_module}}</td>
                                    <td>{{$job->nama_job}}</td>
                                    <td>{{date("d-m-Y", strtotime($selesai = $job->deadlineJob))}}</td>
                                    <td>
                                        @if($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) > 0 )
                                            {{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24)}} Hari
                                        @elseif($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) == 0 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 0.25rem; color: #212529; background-color: #ffc107; padding: 0.25em 0.4em;">Deadline</span>
                                        @else
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 0.25rem; color: #FFF; background-color: #dc3545; padding: 0.25em 0.4em;">Melewati Deadline</span>
                                        @endif
                                    </td>
                                    <td>@if ($job->status === 1 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #009688; padding: 0.25em 0.6em;">Ongoing</span>
                                        @elseif($job->status === 2 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #6c757d; padding: 0.25em 0.6em;">Queue</span>
                                        @elseif($job->status === 3 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #212529; background-color: #ffc107; padding: 0.25em 0.6em;">Pending</span>
                                        @elseif($job->status === 4 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #28a745; padding: 0.25em 0.6em;">Completed</span>
                                        @elseif($projects->status === 5 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #343a40; padding: 0.25em 0.6em;">Canceled</span>
                                        @endif</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" value="{{$re = 1}}"/>
                    <input type="hidden" value="{{$rekrusif3 += $re}}"/>
                    @endif

                @elseif((strtotime($jo->deadlineJob) - strtotime('today')) / (60 * 60 * 24) == 7)

                    @if($rekrusif7 < 1)
                    <div>
                        <h3 style="margin: 0; font-family: inherit; background-color: #e9ecef; color: #555 !important; padding:7px;" align="center">Deadline dalam 7 hari</h3>
                     </div>
                    <table style="border-collapse: collapse; width: 100%; max-width: 100%; margin-bottom: 1rem;" bgcolor="transparent">
                        <thead>
                        <tr>
                            <th style="width: 20%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Modul</th>
                            <th style="width: 30%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Job</th>
                            <th style="width: 10%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Deadline</th>
                            <th style="width: 10%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Sisa Waktu</th>
                            <th style="width: 10%; border-top-width: 1px; border-top-color: #dee2e6; border-top-style: solid; border-bottom-width: 2px; border-bottom-color: #dee2e6; border-bottom-style: solid; padding: 0.75rem;" align="inherit" valign="bottom">Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($jobs as $job)
                            @if((strtotime($job->deadlineJob) - strtotime('today')) / (60 * 60 * 24) == 7)
                                <tr>
                                    <td>{{$job->nama_module}}</td>
                                    <td>{{$job->nama_job}}</td>
                                    <td>{{date("d-m-Y", strtotime($selesai = $job->deadlineJob))}}</td>
                                    <td>
                                        @if($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) > 0 )
                                            {{$stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24)}} Hari
                                        @elseif($stotal = (strtotime($selesai) - strtotime('today')) / (60 * 60 * 24) == 0 )
                                            <span  style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 0.25rem; color: #212529; background-color: #ffc107; padding: 0.25em 0.4em;">Deadline</span>
                                        @else
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 0.25rem; color: #FFF; background-color: #dc3545; padding: 0.25em 0.4em;">Melewati Deadline</span>
                                        @endif
                                    </td>
                                    <td>@if ($job->status === 1 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #009688; padding: 0.25em 0.6em;">Ongoing</span>
                                        @elseif($job->status === 2 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #6c757d; padding: 0.25em 0.6em;">Queue</span>
                                        @elseif($job->status === 3 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #212529; background-color: #ffc107; padding: 0.25em 0.6em;">Pending</span>
                                        @elseif($job->status === 4 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #28a745; padding: 0.25em 0.6em;">Completed</span>
                                        @elseif($projects->status === 5 )
                                            <span style="display: inline-block; font-size: 85%; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 10rem; color: #FFF; background-color: #343a40; padding: 0.25em 0.6em;">Canceled</span>
                                        @endif</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" value="{{$re = 1}}"/>
                    <input type="hidden" value="{{$rekrusif7 += $re}}"/>
                    @endif
                @endif
               
            @endforeach
        </div>
        <p style="margin-top: 0; margin-bottom: 1rem; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; line-height: 1.5em; color: #aeaeae; font-size: 12px;" align="center">© {{ date('Y') }} Mahasiswa Magang Universitas Gadjah Mada. Yogyakarta, Indonesia.</p>
    </body>
</html>

