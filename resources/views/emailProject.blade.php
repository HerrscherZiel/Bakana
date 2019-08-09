<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reminder</title>
</head>
<body>
<style type="text/css">
    html {
        font-family: sans-serif;
        line-height: 1.15;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        -ms-overflow-style: scrollbar;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    @-ms-viewport {
        width: device-width;
    }
    body {
        margin: 0;
        font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: left;
        background-color: #FFF;
    }
    h1, h2, h3, h4, h5, h6 {
        margin-top: 0;
        margin-bottom: 0.5rem;
        font-family: inherit;
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem;
    }
    table {
        border-collapse: collapse;
    }
    th {
        text-align: inherit;
    }
    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody + tbody {
        border-top: 2px solid #dee2e6;
    }

    .table .table {
        background-color: #FFF;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }
    .table-dark.table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(255, 255, 255, 0.05);
    }
    .jumbotron {
        padding: 2rem 1rem;
        margin-bottom: 2rem;
        background-color: #e9ecef;
        border-radius: 0.3rem;
    }
    @media (min-width: 576px) {
        .jumbotron {
            padding: 4rem 2rem;
        }
    }
    .display-3 {
        font-size: 4.5rem;
        font-weight: 300;
        line-height: 1.2;
    }
    .tile {
        position: relative;
        background: #ffffff;
        border-radius: 3px;
        padding: 20px;
        -webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .line-head {
        padding: 10px;
        border-radius: 3px;
        /*border-bottom: 1px solid #ddd;*/
        background-color: #009688;
        text-align: center;
        color: #FFF !important;
    }
    .line-head2 {
        padding: 10px;
        background-color: #e9ecef;
        text-align: center;
        margin: 0;
        color: ##555 !important;
    }
    .badge {
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 85%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }

    .badge:empty {
        display: none;
    }

    .btn .badge {
        position: relative;
        top: -1px;
    }

    .badge-pill {
        padding-right: 0.6em;
        padding-left: 0.6em;
        border-radius: 10rem;
    }

    .badge-primary {
        color: #FFF;
        background-color: #009688;
    }

    .badge-primary[href]:hover, .badge-primary[href]:focus {
        color: #FFF;
        text-decoration: none;
        background-color: #00635a;
    }

    .badge-secondary {
        color: #FFF;
        background-color: #6c757d;
    }

    .badge-secondary[href]:hover, .badge-secondary[href]:focus {
        color: #FFF;
        text-decoration: none;
        background-color: #545b62;
    }

    .badge-success {
        color: #FFF;
        background-color: #28a745;
    }

    .badge-success[href]:hover, .badge-success[href]:focus {
        color: #FFF;
        text-decoration: none;
        background-color: #1e7e34;
    }

    .badge-info {
        color: #FFF;
        background-color: #17a2b8;
    }

    .badge-info[href]:hover, .badge-info[href]:focus {
        color: #FFF;
        text-decoration: none;
        background-color: #117a8b;
    }

    .badge-warning {
        color: #212529;
        background-color: #ffc107;
    }

    .badge-warning[href]:hover, .badge-warning[href]:focus {
        color: #212529;
        text-decoration: none;
        background-color: #d39e00;
    }

    .badge-danger {
        color: #FFF;
        background-color: #dc3545;
    }

    .badge-danger[href]:hover, .badge-danger[href]:focus {
        color: #FFF;
        text-decoration: none;
        background-color: #bd2130;
    }

    .badge-light {
        color: #212529;
        background-color: #f8f9fa;
    }

    .badge-light[href]:hover, .badge-light[href]:focus {
        color: #212529;
        text-decoration: none;
        background-color: #dae0e5;
    }

    .badge-dark {
        color: #FFF;
        background-color: #343a40;
    }

    .badge-dark[href]:hover, .badge-dark[href]:focus {
        color: #FFF;
        text-decoration: none;
        background-color: #1d2124;
    }
    .footer {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
        box-sizing: border-box;
        line-height: 1.5em;
        margin-top: 0;
        color: #aeaeae;
        font-size: 12px;
        text-align: center;
    }
</style>
<input type="hidden" value=" {{$rekrusif = 0}}"/>
<input type="hidden" value=" {{$rekrusif1 = 0}}"/>
<input type="hidden" value=" {{$rekrusif2 = 0}}"/>
<input type="hidden" value=" {{$rekrusif3 = 0}}"/>
<input type="hidden" value=" {{$rekrusif7 = 0}}"/>
<div class="tile">
    <div class="page-header">
        <h2 class="line-head">Timeline Reminder</h2>
    </div>
    <div class="jumbotron">
        @if($dead == 0)
            <h1 class="display-3">Project Baru !</h1>
            <p>Halo, {{ $nama }} ! Anda baru saja dimasukan ke dalam project {{$project}}</p>
        @endif
    </div>

</div>
<p class="footer">© {{ date('Y') }} Mahasiswa Magang Universitas Gadjah Mada. Yogyakarta, Indonesia.</p>
</body>
</html>
