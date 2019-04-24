<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Motorist Inc</title>
 
    {{-- <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css'> --}}
    {{-- <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto'> --}}
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/orgchart-webcomponents.min.css">
    <link rel="stylesheet" href="/css/style.css">

       
	<script>
		window.Laravel = {!! json_encode([
			'csrfToken' => csrf_token(),
		]) !!};
    </script>


</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
	<div id="app"></div>
      <script src="{{ mix('js/app.js') }}"></script>
      <script src="/js/html2canvas.min.js"></script>
      <script src="/js/orgchart.js"></script>
   
 
</body>
</html>
