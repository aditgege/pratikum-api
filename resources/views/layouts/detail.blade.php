<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weblog - @yield('title', 'Detail')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/tinymce.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Neuton:wght@200&display=swap" rel="stylesheet">
</head>
<body class="bg-graybg w-full min-h-screen md:w-7/12 mx-auto p-10 ">
    <div class="w-full flex items-center justify-end">
        @if(Auth::check())
        <ul class="flex space-x-8 font-bold">
            <li>
                
            </li>
            <li class="flex items-center text-primary">
                <a href="{{ url('/')}}" aria-current="page">Home</a>
            </li>
            <li class="flex items-center"><a href="{{ route('logout')}}" class="bg-red-400 bg-opacity-70 text-primary group flex items-center rounded-md hover:bg-red-400 hover:text-primary text-light-blue-600 text-sm font-medium px-4 py-2">Logout</a></li>
        </ul>
        @else
        <ul class="flex space-x-8 font-bold">
            <li class="flex items-center text-primary">
                <a href="{{ url('/')}}" aria-current="page">Home</a>
            </li>
            <li class="flex items-center text-primary">
                <a href="{{ route('login')}}">Login</a>
            </li>
        </ul>
        @endif
    </div>
    <div class="container">
        @yield('content')
    </div>

    @section('page-script')
        <script type="text/javascript" src="{{ asset('js/app.js')}}"></script>
    @show
    
</body>
</html>