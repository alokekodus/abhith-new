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
            <h4 class="card-title">Subject Details</h4>
            <div style="overflow-x:auto;">
                <table class="table table-bordered">

                    <tbody>
                        <tr>
                            <td> Subject Name: </td>
                            <td><b>{{$subject->subject_name}} </b></td>
                            
                            
                        </tr>
                        <tr>
                            <td>Board:</td>
                            <td><b>{{$subject->boards->exam_board}} </b></td>
                        </tr>
                        <tr>
                            <td>Class:</td>
                            <td> <b>{{$subject->assignClass->class}} </b> </td>
                        </tr>
                        <tr>
                            <td>Image: </td>
                            <td colspan="2"><b><a href="{{asset($subject->image)}}">{{basename($subject->image)}}</a></b></td>
                        </tr>
                        <tr>
                            <td>Thumbnail Image: </td>
                            <td colspan="2"><b>@if($subject->subjectAttachment)<a
                                        href="{{asset($subject->subjectAttachment)}}">{{basename($subject->subjectAttachment->video_thumbnail_image)}}</a>
                                    @else NA @endif</b></td>
                        </tr>
                        <tr>
                            <td>Promo Video: </td>
                            <td colspan="2"><b>@if($subject->subjectAttachment)<a
                                        href="{{asset($subject->subjectAttachment)}}">{{basename($subject->subjectAttachment->attachment_origin_url)}}</a>
                                    @else NA @endif</b></td>

                        </tr>
                        <tr>
                            <td>Description: </td>
                            <td colspan="2">{!!$subject->description!!}</td>

                        </tr>
                        <tr>
                            <td>Why Learn: </td>
                            <td colspan="2">{!!$subject->why_learn!!}</td>

                        </tr>
                        <tr>
                            <td>Requirements: </td>
                            <td colspan="2">{{$subject->requirements??'NA'}}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.course-management.lesson.all')

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
                        <td><a href="{{route('admin.teacher.details',Crypt::encrypt($teacher[0]->assignTeacher->id))}}">
                                {{$teacher[0]->assignTeacher->name}}</a>
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
        $('#teacherTable').DataTable({
            "processing": true,
            "searching": true,
            "ordering": false
        });
        
    });
</script>
@endsection