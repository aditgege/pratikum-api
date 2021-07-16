<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weblog - @yield('title', 'Main')</title>
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
            <li class="flex items-center"><a href="{{ route('logout')}}" class=" bg-opacity-70 text-secondary group flex items-center rounded-md hover:bg-red-400 hover:text-primary text-light-blue-600 text-sm font-medium px-4 py-2">Logout</a></li>
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
        <!-- <div class="w-10 ml-3 h-10 rounded-full bg-secondary">
        </div> -->
    </div>
    @if(Auth::check())
        <div class="max-w-xl md:max-w-3xl xl:max-w-4xl mx-auto text-center px-6 py-10 md:py-32 border-b border-gray-300">
            <a class="text-3xl sm:text-4xl md:text-5xl font-display mb-1 text-primary">Hi {{ Auth::user()->name }} !!</a>
        </div>
    @endif
    <div class="container">
        @if(Auth::check())
        <a href="{{ route('article-new')}}"  class="bg-primary bg-opacity-50 flex mt-3 ml-auto shadow-md text-secondary  items-center rounded-md  text-light-blue-600 text-sm font-medium px-4 py-2 w-3/12">
            <svg class="group-hover:text-light-blue-600 text-light-blue-500 mr-2" width="12" height="20" fill="currentColor">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z"/>
            </svg>
            New Article
        </a>
        @endif
        @yield('content')
    </div>
    <script type="text/javascript" src="{{ asset('js/app.js')}}"></script>
    <script type="text/javascript">
        console.log("test")
        console.log({{ session('status')}})
        @if(Session::has('success'))
        Swal.fire(
            'Yeay',
            "{{ Session::get('success') }}",
            'success'
        )
        console.log("ahay")
        @endif

        @if(Session::has('failed'))
            Swal.fire(
                'Oops',
                "{{ Session::get('failed') }}",
                'error'
            )
        console.log("ahay")

        @endif
    </script>
    @yield('page-script')
    
</body>
</html>