<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">

    <!-- Title -->
    <title>@yield('title') :: {{env('APP_NAME')}} : Admin</title>

    <!-- Meta -->
    <meta name="keywords" content="">
    <meta name="author" content="Wusob Technologies">
    <meta name="apple-mobile-web-app-title" content="{{env('APP_NAME')}}">
    <meta name="application-name" content="{{env('APP_NAME')}}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $web_source }}/img/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $web_source }}/img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $web_source }}/img/icons/favicon-16x16.png">
    <link rel="manifest" href="{{ $web_source }}/img/icons/site.html">
    <link rel="mask-icon" href="{{ $web_source }}/img/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="{{ $web_source }}/img/icons/favicon.ico">
    
    <!-- CSS File -->
    @include('admin.includes.styles')

     <!-- Jquery Toast css -->
     <link href="{{asset('toast')}}/jquery.toast.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <main class="ps-main">
        <!-- header -->
        @include('admin.includes.side_bar')
        <!-- main content -->
        @yield('content')
    </main>
    <!-- scripts -->
    @include('admin.includes.scripts')
</body>
</html>
