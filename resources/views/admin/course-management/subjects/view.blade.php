@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Subjects')
@section('head')
<link rel="stylesheet" href="{{ asset('asset_admin/css/lesson.css') }}">
@endsection
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> Subject Details
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{route('admin.course.management.subject.all')}}" class="btn btn-gradient-primary btn-fw"
                    data-backdrop="static" data-keyboard="false">All
                    Subject</a>
            </li>
        </ul>
    </nav>
</div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Subject Table</h4>
            <table class="table table-bordered">

                <tbody>
                    <tr>
                        <td> Subject Name: <b>{{$subject->subject_name}} </b> </td>
                        <td>
                            Board: <b>{{$subject->boards->exam_board}} </b>
                        </td>
                        <td> Class: <b>{{$subject->assignClass->class}} </b> </td>
                    </tr>
                    <tr>
                        <td>Image: </td>
                        <td colspan="2"><b><a href="{{asset($subject->image)}}">{{$subject->image}}</a></b></td>
                    </tr>
                    <tr>
                        <td>Thumbnail Image: </td>
                        <td colspan="2"><b>@if($subject->subjectAttachment)<a
                                    href="{{asset($subject->subjectAttachment)}}">{{$subject->subjectAttachment->video_thumbnail_image??'NA'}}</a>
                                @else NA @endif</b></td>
                    </tr>
                    <tr>
                        <td>Promo Video: </td>
                        <td colspan="2"><b>@if($subject->subjectAttachment)<a
                                    href="{{asset($subject->subjectAttachment)}}">{{$subject->subjectAttachment->attachment_origin_url??'NA'}}</a>
                                @else NA @endif</b></td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@if($subject->lesson()->exists())
@include('admin.course-management.lesson.all')
@else
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        </div>
    </div>
</div>
@endif
@if($lesson_groupby_teachers)
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">All Assigned Teacher</h4>
            <table class="table table-striped" id="teacherTable">
                <thead>
                    <tr>
                        <th>#No</th>
                        <th> Name </th>
                        <th> Total Topic Assign </th>
                       
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach($lesson_groupby_teachers as $key=>$teacher)
                    <tr>
                        <td>{{$no++}}</td>
                        <td><a href="{{route('admin.teacher.details',Crypt::encrypt($teacher[0]->assignTeacher->id))}}"> {{$teacher[0]->assignTeacher->name}}</a>
                        <td>{{totalTopicFindById($teacher[0]->assignTeacher->id)}} topics</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif




@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#lessonTable').DataTable({
            "processing": true,
            "searching": true,
            "ordering": false
        });
    });
</script>
@endsection