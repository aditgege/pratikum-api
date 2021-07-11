@extends('layouts.main')
@section('content')
    <div class="flex">
        <div class="card mx-auto p-8 bg-white shadow-md mt-12">
            <h3 class="text-center my-4 text-2xl font-display">Register</h3>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="flex flex-col space-y-3">
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
                    <input class="w-full" type="text" name="name" class="form-control" placeholder="Nama Lengkap">
                    <input class="w-full" type="text" name="email" class="form-control" placeholder="Email">
                    <input class="w-full" type="password" name="password" class="form-control" placeholder="Password">
                    <input class="w-full" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                </div>
                <div class="card-footer">
                    <button type="submit" class=" font-bold bg-primary font-content text-bold shadow-sm text-white px-12 py-2 mt-3">Register</button>
                    <p class="text-center mt-3 font-content">Sudah punya akun? <a class=" font-content text-primary hover:text-secondary" href="{{ route('login') }}">Login</a> sekarang!</p>
                </div>
            </form>
        </div>
    </div>
@endsection