@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Lesson')
@section('content')
@section('lesson-type') Lesson @endsection
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> Create Lesson
    </h3>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Subject</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$subject->subject_name}}</li>
        </ol>
    </nav>

</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div>
                <form id="assignLessonForm" enctype="multipart/form-data" method="post" action="{{route('admin.course.management.lesson.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="subject_id" value="{{Crypt::encrypt($subject['id'])}}">
                            <div class="form-group">
                                <label for="">Lesson Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="e.g Perimeter and Area"
                                    value="">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                        </div>


                    </div>

                    <div style="float: right;">
                        <button type="button" class="btn btn-md btn-default" id="assignLessonCancelBtn">Cancel</button>
                        <button type="submit" class="btn btn-md btn-success" id="assignLessonSubmitBtn" name="type"
                            value="lesson-create">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if($subject->lesson()->exists())
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">All Lesson</h4>
            <table class="table table-striped" id="lessonTable">
                <thead>
                    <tr>
                        <th>#No</th>
                        <th> Lesson Name </th>
                        <th> Total Topics </th>
                        <th> Total Videos </th>
                        <th> Total Documents </th>
                        <th> Total Articles </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subject->lesson as $key=>$lesson)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$lesson->name}} </td>
                        <td>{{$lesson->topics->count()}}<a
                                href="{{route('admin.course.management.lesson.topic.create',Crypt::encrypt($lesson->id))}}">
                                Add Topics
                            </a>
                        </td>
                        <td> {{$lesson->topics->where('type',2)->count()}} </td>
                        <td>{{$lesson->topics->where('type',1)->count()}} </td>
                        <td>{{$lesson->topics->where('type',3)->count()}}</td>
                        <td><a href="" title="Edit Lesson"><i class="mdi mdi-grease-pencil"></i></a>
                            <a href="" title="View Details"><i class="mdi mdi-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endif
<!-- Large modal -->

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

    $("#assignLessonForm").validate({
            rules: {
                name: {
                    required: true,
                  
                }
            },
            messages: {  
                name: {
                    required: "Lesson Name is required",
                }

            },
        });

   

</script>

@endsection