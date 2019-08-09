<!DOCTYPE html>
<html lang="en" style="font-family: sans-serif; line-height: 1.15; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -ms-overflow-style: scrollbar; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Project</title>
</head>
<body style='font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 0.875rem; font-weight: 400; line-height: 1.5; color: #212529; text-align: left; margin: 0;' bgcolor="#FFF">
<input type="hidden" value=" {{$rekrusif = 0}}"/>
<input type="hidden" value=" {{$rekrusif1 = 0}}"/>
<input type="hidden" value=" {{$rekrusif2 = 0}}"/>
<input type="hidden" value=" {{$rekrusif3 = 0}}"/>
<input type="hidden" value=" {{$rekrusif7 = 0}}"/>
<div style="position: relative; background-color: #ffffff; border-radius: 3px; -webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); margin-bottom: 30px; -webkit-transition: all 0.3s ease-in-out; -o-transition: all 0.3s ease-in-out; transition: all 0.3s ease-in-out; padding: 20px;">
    <div>
        <h2 style="margin-top: 0; margin-bottom: 0.5rem; font-family: inherit; border-radius: 3px; background-color: #009688; color: #FFF !important; padding: 10px;" align="center">New Project</h2>
    </div>
    <div style="margin-bottom: 2rem; background-color: #e9ecef; border-radius: 0.3rem; padding: 2rem 1rem;">
        @if($dead == 0)
            <h1 style="margin-top: 0; margin-bottom: 0.5rem; font-family: inherit; font-size: 4.5rem; font-weight: 300; line-height: 1.2;">Project Baru !</h1>
            <p>Halo, {{ $nama }} ! Anda baru saja dimasukan ke dalam project {{$project}}</p>
        @endif
    </div>

</div>
<p style="margin-top: 0; margin-bottom: 1rem; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; line-height: 1.5em; color: #aeaeae; font-size: 12px;" align="center">© {{ date('Y') }} Mahasiswa Magang Universitas Gadjah Mada. Yogyakarta, Indonesia.</p>
</body>
</html>

