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
                <a href="{{route('teacher.course.preview',Crypt::encrypt($subject->id))}}"
                    class="btn btn-gradient-primary btn-fw" data-backdrop="static" data-keyboard="false">Preview</a>
            </li>
        </ul>
    </nav>
</div>
<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  {{$subject->subject_name}} Details
                </button>
            </h2>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
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
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                   All Lessons and Topics
                </button>
            </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                <div class="card">
                    <button type="button" class="btn btn-gradient-primary btn-lg btn-block">
                        TOTAL LESSON: {{$subject->lesson->count()}} </button>
                   
                    @foreach($subject->lesson as $key=>$lesson)
                    @include('common.lesson.index')
                    @endforeach
                
                </div>
            </div>
        </div>
    </div>
 
</div>


@endsection

@section('scripts')

@endsection