@extends('layouts.detail')

@section('title', $data->title)

@section('content')
   <div class="mx-auto  px-6 w-full mt-24">
       <div class="py-4">
            @if(Auth::check())
                <div class="w-full flex justify-end my-2 space-x-1">
                    <a class="bg-yellow-400 text-sm px-3 py-2 rounded-md hover:bg-primary font-bold " href="{{ route('article-edit', $data->id) }}">Edit</a>
                    <a class="bg-red-400 text-sm px-3 py-2 rounded-md hover:bg-primary font-bold " href="{{ route('article-delete', $data->id) }}">Delete</a>
                </div>
            @endif
           <h2 class="text-3xl sm:text-4xl leading-tight font-display mb-1 sm:mb-3 text-left">{{ $data->title }}</h2>
           <p class="font-content text-left leading-normal text-gray-700 lg:text-lg sm:text-sm px-2 sm:px-4 md:px-10">{!! $data->content !!}</p>
           <div class="flex space-x-2 items-center mt-5 w-full text-right">
                <div class="text-right ml-auto">
                    <small class="text-gray-700 text-md">{{ date("F j, Y, g:i a",strtotime($data->created_at))  }} &nbsp;• {{ $data->author_name }} </small>
                </div>
           </div>
       </div>
   </div>
   <div>
    <h1 class="text-3xl sm:text-4xl leading-tight font-display mb-1 sm:mb-3 text-center ">Comment</h1>
    @foreach($comments as $comment)
        <div class="mt-10">
            <div class="px-4 py-3 bg-white shadow-md mx-30">
                <p class="font-content text-left leading-normal text-gray-700 lg:text-lg sm:text-sm px-2 sm:px-4 md:px-10">{!! $comment->content !!}</p>
            <div class="flex space-x-2 items-center w-full text-right">
                    <div class="text-right ml-auto">
                        <small class="text-gray-700 text-md">{{ date("F j, Y, g:i a",strtotime($comment->created_at))  }} &nbsp;• {{ $comment->name }} </small>
                    </div>
            </div>
            </div>
        </div>
        @endforeach
   </div>
   <div class="px-2 py-4 bg-white shadow-md mt-10">
    <form class="" method="post" action="{{ route('article-comment') }}">
            @csrf
            <div class="mb-3">
                <input type="text" class="" id="form-name" name="form-name" placeholder="Name">
                <input type="hidden" class="" id="form-article-id" name="form-article-id" value="{{ $data->id }}">
            </div>
            <div class="mb-3">
                <label for="form-content" class="form-label">Comment</label>
                <textarea id="form-content" name="form-content" rows="3"></textarea>
            </div>
            <div>
                <button type="submit" class="px-3 py-2 bg-primary text-white mt-3">Submit</button>
            </div>
        </form>
   </div>
@endsection
@section('page-script')
@parent
    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', (event) => {
            tinymce.init({
                selector: 'textarea'
            });
        });
    </script>
@endsection