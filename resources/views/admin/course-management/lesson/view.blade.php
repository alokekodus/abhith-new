@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Lesson Details')
@section('content')
<style>
    .lesson-image {
        height: 200px;
        width: 150px;
    }

    .scroll {
        overflow-y: scroll;
        max-height: 600px;
        background-color: #fff;

    }

    .scroll::-webkit-scrollbar {
        width: 5px;
    }

    .scroll::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 5px;
    }

    .scroll::-webkit-scrollbar-thumb {
        border-radius: 5px;
        -webkit-box-shadow: inset 0 0 6px red;
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
    <div class="col-12 p-2 scroll">
        <br>
        <div class="card">
            <div class="card-header">
                <h4 style="text-align: center;">Lesson Name: {{$lesson->name}}</h4>
            </div>
            <div class="card-body">
                {!!$lesson->content!!}
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
    <div class="col-12  scroll">
        <br>
        <div class="card">
            <div class="card-header">
                <h4 style="text-align: center;">All Topics</h4>
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