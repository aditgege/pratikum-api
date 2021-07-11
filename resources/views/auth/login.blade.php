@extends('layouts.main')
@section('content')
   <div class="flex h-full flex-col items-center my-auto">
        <div class="flex bg-white shadow-md mx-0 md:mx-12 h-full mt-24 p-8 ">
            <div class="card">
                <div class="mb-6">
                    <h3 class="text-center text-2xl font-display">Login</h3>
                </div>
                <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="card-body">
                    @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Something it's wrong:
                            <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <input class="w-full  mb-3" type="text" name="email" class="form-control" placeholder="Email">
                    <input class="w-full " type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="flex w-full items-end justify-end mt-5">
                    <button type="submit" class=" font-bold font-content bg-primary text-bold shadow-sm text-white px-12 py-2 mt-3">Log In</button>
                </div>
                </form>
            </div>
        </div>
        <p class="text-center font-content mt-4">Belum punya akun? <a class="font-content text-primary hover:text-secondary" href="{{ route('register') }}">Register</a> sekarang!</p>
   </div>
@endsection