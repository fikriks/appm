<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>@yield('title') &mdash; APPM</title>
<meta name="description" content="APPM">
<link rel="shortcut icon" href="favicon.ico">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/components.min.css') }}">
@stack('styles')
