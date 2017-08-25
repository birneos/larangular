<html>
<head>
    <title> @yield('title') </title>
   <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js"></script>

    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}" >
    <link rel="stylesheet" href="{!! asset('css/bootstrap-theme.min.css') !!}">
    <script src="{!! asset('js/bootstrap.min.js') !!}"></script>

    <script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"> -->

    
   <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
   
</head>
<body>

@include('shared.navbar')

@yield('content')

</body>
</html>