@extends('layouts.detail')

@section('title', 'Edit Article')

@section('content')
    <h2 class="m-5 text-center text-2xl font-display">Edit Article</h2>
    <form method="post">
        @method('put')
        @csrf
        <div class="mb-3">
            <input type="text" class="form-control w-full" id="frm-title" name="frm-title" placeholder="Article Title" value="{{ $data->title }}">
        </div>
        <div class="mb-3">
            <select name="frm-status" class="form-control">
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>
        <div class="mb-3">
            <textarea class="w-full" id="frm-content" name="frm-content" rows="3">{!! $data->content !!}</textarea>
        </div>
        <div class="text-right">
            <button type="submit" class="px-6 py-2 bg-primary text-white font-content font-bold">Submit</button>
        </div>
    </form>
@endsection
@section('page-script')
@parent
    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', (event) => {
            tinymce.init({
                selector: 'textarea#frm-content',   
                content_css: false,
                skin: false
            });
        })
    </script>
@endsection