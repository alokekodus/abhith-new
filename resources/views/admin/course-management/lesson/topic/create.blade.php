@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Lesson')
@section('form-label','Topic')
@section('content')
<style>
    .dyn-height {
        width: 100px;
        max-height: 692px;
        overflow-y: auto;
    }
</style>
<link rel="stylesheet" href="{{ asset('asset_admin/css/lesson.css') }}">
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> Add Topic
    </h3>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0"><a href="{{route('admin.course.management.lesson.view',$lesson->slug)}}"
                    class="btn btn-gradient-primary p-2" title="View Lesson Details"> Lesson
                    Name:{{$lesson->name}}</a>


                <div class="float-right"> All Lesson [Total lesson:
                    {{$lesson->topics->count()}}]</div>

            </h5>
        </div>
        <div class="row">
            <div class="col-8 p-4">
                <div class="card">
                    <form id="assignTopicForm" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{$lesson->id}}">
                        <input type="hidden" name="type" value="create-topic">
                        @include('admin.course-management.lesson.common.form')
                        <div style="float: right;">
                            <button type="button" class="btn btn-md btn-default"
                                id="assignTopicCancelBtn">Cancel</button>
                            <button type="submit" class="btn btn-md btn-success" id="assignTopicSubmitBtn" name="type"
                                value="create-topic">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-4 p-4 dyn-height">
                <br>
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


<!-- Large modal -->

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('asset_admin/js/lesson-topic.js') }}">
</script>
@endsection