@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Lesson Details')
@section('content')
<style>
    .lesson-image {
        height: 200px;
        width: 150px;
    }

    .dyn-height {
        max-height: 400px;
        overflow-y: auto;
    }
</style>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> Lesson Details
    </h3>
</div>
<div class="row p-2">
    <div class="col-12 dyn-height">
        <div class="card">
            <div class="card-header">
                <h4 style="text-align: center;">Lesson Name: {{$lesson->name}}</h4>
            </div>
            <div class="card-body">
                <h4><u>Content:</u></h4>
                {{$lesson->content}}
                <br>
                @if($lesson->image_url!=null)
                <i id="displayImage" class="mdi mdi-file-image" data-toggle="modal" data-id="{{$lesson->id}}"
                    data-value="{{$lesson->image_url}}" data-target="#displayImageModal"></i>
                @endif
                @if($lesson->video_url!=null)
                <i id="displayVideo" class="mdi mdi-video" data-toggle="modal" data-id="{{$lesson->id}}"
                    data-value="{{$lesson->video_url}}" data-target="#displayVideoModal"></i>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row p-2">
    <div class="col-12 dyn-height">
        <div class="card">
            <div class="card-header">
                <h4 style="text-align: center;">Lesson Topics</h4>
            </div>
            <div class="card-body">
                @if($lesson->topics()->exists())
                @include('admin.course-management.lesson.topic.all')
                @else
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">

                            Topic Not Added yet

                        </h5>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection