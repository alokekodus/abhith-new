@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Subjects-create')
@section('subjectdetails')
<li class="nav-item btn btn-block btn-lg btn-gradient-info mt-4">
    <a class="nav-link" href=""> <span class="menu-title">Subject: {{$lesson->assignSubject->subject_name}}/{{$lesson->name}}</span></a>
    <a class="nav-link collapsed" data-toggle="collapse" href="#subject-management" aria-expanded="false">
        <span class="menu-title">{{$lesson->name}}</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-book menu-icon"></i>
    </a>
    <div class="collapse" id="subject-management">
        <ul class="nav flex-column sub-menu">
            @foreach($lesson->topics as $key=>$topic)
            <li class="nav-item"> <a class="nav-link" href="{{route('teacher.topic.view',Crypt::encrypt($topic->id))}}">{{$topic->name}}</a></li>
            @endforeach
        </ul>
    </div>
</li>
@endsection
@section('content')
@section('head')
<style>
    .sidebar {
        width: 361px!important;
    }
</style>
@endsection
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> View Course
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{route('teacher.course.preview',Crypt::encrypt($lesson->id))}}"
                    class="btn btn-gradient-primary btn-fw" data-backdrop="static" data-keyboard="false">Preview</a>
            </li>
        </ul>
    </nav>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <img src="{{asset($lesson->lessonAttachment->image)}}" class="img-fluid" alt="Responsive image"
                        style="height: 280px;width:100%;">
                </div>
            </div>
        </div>
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-info">SUBJECT NAME:{{$lesson->name}}</h4>
                    <h4 class="card-title">Content</h4>
                    <blockquote class="blockquote">
                        {!!$lesson->content
                        !!}
                    </blockquote>
                   
                   
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item"
                            src="{{asset('/storage/'.$lesson->lessonAttachment->video_resize_480)}}"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection