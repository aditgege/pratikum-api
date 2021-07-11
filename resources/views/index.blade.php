@extends('layouts.main')
@section('content')    
    @foreach($data as $record)
        @if(Auth::check())        
            <a href="{{ route('article-show', $record->id) }}" class="border-b note p-8 bg-white my-10 shadow-md w-full h-auto flex flex-col note">
                <span class="text-2xl leading-tight font-display mb-3 sm:mb-4 text-center ">"{{ $record->title}}"</span>
                <p class="font-content leading-normal text-gray-700 lg:text-lg sm:text-sm px-2 sm:px-4 md:px-10 line-clamp-3 ">{{ strip_tags($record->content) }}</p>
                <small class="text-right text-gray-700 text-md px-2 pt-3 sm:px-4 md:px-10">{{ date("F j, Y, g:i a",strtotime($record->created_at))  }}</small>
            </a>
            @else
            @if ($record->published_at)
            <a href="{{ route('article-show', $record->id) }}" class="border-b note p-8 bg-white my-10 shadow-md w-full h-auto flex flex-col note">
                <span class="text-2xl leading-tight font-display mb-3 sm:mb-4 text-center ">"{{ $record->title}}"</span>
                <p class="font-content leading-normal text-gray-700 lg:text-lg sm:text-sm px-2 sm:px-4 md:px-10 line-clamp-3 ">{{ strip_tags($record->content) }}</p>
                <small class="text-right text-gray-700 text-md px-2 pt-3 sm:px-4 md:px-10">{{ date("F j, Y, g:i a",strtotime($record->created_at))  }}</small>
            </a>
            @endif
        @endif
    @endforeach
@endsection