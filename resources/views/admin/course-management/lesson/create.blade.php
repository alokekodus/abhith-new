@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Lesson')
@section('content')
<link rel="stylesheet" href="{{ asset('asset_admin/css/lesson.css') }}">
@section('lesson-type') {{$form_type}} @endsection
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> Create Lesson
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a type="button" class="btn btn-primary" href="{{route('admin.course.management.lesson.all')}}">All
                    Lesson</a>
            </li>
        </ul>
    </nav>
</div>
<div class="card">
    <div class="card-body">
        <div>
            <form id="assignLessonForm" enctype="multipart/form-data" method="post">
                @csrf
                @include('admin.course-management.lesson.form')

                <div style="float: right;">
                    <button type="button" class="btn btn-md btn-default" id="assignLessonCancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-md btn-success" id="assignLessonSubmitBtn" name="type"
                        value="lesson-create">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Large modal -->

@endsection

@section('scripts')

<script type="text/javascript" src="{{ asset('asset_admin/js/lesson.js') }}">
</script>
@endsection