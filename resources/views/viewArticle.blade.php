@extends('layouts.detail')

@section('title', $data->title)

@section('content')
   <div class="mx-auto  px-6 w-full mt-24">
       <div class="py-4">
           <h2 class="text-3xl sm:text-4xl leading-tight font-display mb-1 sm:mb-3 text-left">{{ $data->title }}</h2>
           <p class="font-content text-left leading-normal text-gray-700 lg:text-lg sm:text-sm px-2 sm:px-4 md:px-10">{!! $data->content !!}</p>
           <div class="flex space-x-2 items-center mt-5 w-full text-right">
                <div class="text-right ml-auto">
                    <small class="text-gray-700 text-md">{{ date("F j, Y, g:i a",strtotime($data->created_at))  }} &nbsp;• {{ $data->author_name }} </small>
                    @if(Auth::check())
                        <a class="text-red-400 text-sm font-medium hover:text-primary font-bold " href="{{ route('article-edit', $data->id) }}">Edit</a>
                     @endif
                </div>
                
           </div>
       </div>
   </div>
@endsection