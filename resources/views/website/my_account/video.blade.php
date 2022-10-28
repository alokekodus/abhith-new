@extends('layout.website.website')

@section('title', 'My Course')

@section('head')
@endsection

@section('content')

    @include('layout.website.include.forum_header')
    <div class="container">
        <h3 class="text-center">Video title</h3>
        <video poster="{{ asset($video->video_thumbnail_image) }}" controls style="width: 100%;">
            <source src="{{ asset($video->video_origin_url) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
@section('scripts')
@endsection

@endsection
