
<meta charset="UTF-8">
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<title> @yield('htmlheader_title', 'Page not found') | Admin panel - {{$option->name}}</title>

<meta name="description" content="{{ $option->description }}">
<meta name="keywords" content="{{ $option->keywords }}">
<meta name="author" content="Sinthusan">

@if($option->favicon)
    <link rel="shortcut icon" href="{{ asset('storage/options/'.$option->favicon) }}">
@else
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
@endif

<!-- BOOTSTRAP 3.3.4 -->
<link href="{{ asset('admin/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />

<!-- FONT AWESOME ICONS -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<!-- IONICONS -->
<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />

<!-- THEME CSS -->
<link href="{{ asset('admin/css/admin.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/css/skins/skin.css') }}" rel="stylesheet" type="text/css" />

<!-- DATATABLE -->
<link href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet">

<!-- PACE LOADER -->
<link href="{{ asset('plugins/pace/pace.css') }}" rel="stylesheet" type="text/css"/>
