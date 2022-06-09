@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Subjects-create')

@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> View Course
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{route('teacher.course.create')}}" class="btn btn-gradient-primary btn-fw"
                    data-backdrop="static" data-keyboard="false">Preview</a>
            </li>
        </ul>
    </nav>
</div>


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <img src="{{asset($subject->image)}}" class="img-fluid" alt="Responsive image"
                    style="height: 280px;width:100%;">
            </div>
        </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-info">SUBJECT NAME:{{$subject->subject_name}}</h4>
                <h4 class="card-title">Description</h4>
                <blockquote class="blockquote">
                    {!!$subject->description
                    !!}
                </blockquote>
                <h4 class="card-title">Why will Studen Learn This</h4>
                <blockquote class="blockquote">
                    {!!$subject->why_learn
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
                        src="{{asset('/storage/'.$subject->subjectAttachment->video_resize_480)}}"></iframe>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')

    @endsection