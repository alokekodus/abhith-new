@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Subjects')
@section('head')
    <style>
        /* .pagination {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            list-style: none;
            border-radius: 0.25rem;
        } */
    </style>
@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Subjects </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('admin.course.management.subject.create') }}" class="btn btn-gradient-primary btn-fw"
                        data-keyboard="false">Add Subject</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Subjects</h4>
                    <div style="overflow-x:auto;">
                        <table class="table table-striped" id="subjectTable">
                            <thead>
                                <tr>
                                    <th>#No</th>
                                    <th> Image </th>
                                    <th> Name </th>
                                    <th>Board/Class</th>
                                    <th> Amount </th>
                                    <th> Total Lesson </th>
                                    <th> Enrolled Student </th>
                                    <th>Publish</th>
                                    <th>Status</th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subjects as $key => $subject)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td class="py-1">
                                            <img src="{{ asset($subject->image) }}" alt="image" />
                                        </td>
                                        <td> {{ $subject->subject_name }} </td>
                                        <td> Board -- {{ $subject->boards->exam_board }} / Class
                                            -{{ $subject->assignClass->class }}
                                        </td>
                                        <td><i class="mdi mdi-currency-inr"></i>
                                            {{ number_format((float) $subject->subject_amount, 2, '.', '') }}
                                        </td>
                                        <td>
                                            @if ($subject->lesson->count() == 0)
                                                <a
                                                    href="{{ route('admin.course.management.lesson.create', Crypt::encrypt($subject->id)) }}">Add
                                                    Lesson</a>
                                            @else
                                                <span class="badge rounded-pill bg-danger">
                                                    {{ $subject->lesson->count() }}
                                                </span> <a
                                                    href="{{ route('admin.course.management.lesson.create', Crypt::encrypt($subject->id)) }}">
                                                    Add Lesson
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($subject->assignOrder->count() == 0)
                                                Not Yet Enrolled
                                            @else
                                                <a
                                                    href="{{ route('teacher.subject.student', Crypt::encrypt($subject->id)) }}">
                                                    {{ $subject->assignOrder->count() }} student Enrolled </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($subject->published == 1)
                                                <label class="switch">
                                                    <input type="checkbox" id="isPublish" data-id="{{ $subject->id }}"
                                                        checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            @else
                                                <label class="switch">
                                                    <input type="checkbox" id="isPublish" data-id="{{ $subject->id }}">
                                                    <span class="slider round"></span>
                                                </label>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($subject->is_activate == 1)
                                                <a href="{{ route('admin.active.subject', Crypt::encrypt($subject->id)) }}"
                                                    class="badge badge-success">Active</a>
                                            @else
                                                <a href="{{ route('admin.active.subject', Crypt::encrypt($subject->id)) }}"
                                                    class="badge badge-danger">Inactive</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.course.management.subject.edit', Crypt::encrypt($subject->id)) }}"
                                                title="Edit Lesson"><i class="mdi mdi-grease-pencil"></i></a>
                                            <a href="{{ route('admin.course.management.subject.view', Crypt::encrypt($subject->id)) }}"
                                                title="View Details"><i class="mdi mdi-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{$subjects->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('#subjectTable').DataTable({
                "processing": true,
                "searching": true,
                "ordering": true
            });
        });


        $('#assignSubjectCancelBtn').on('click', function() {
            $('#assignSubjectModal').modal('hide');
            $('#assignSubjectForm')[0].reset();
            $('.assignedClassdDiv').css('display', 'none');
            pond.removeFiles();
        });


        $('#subjectName').on('change', function() {
            if ($(this).val().length > 0) {
                $('.assignedClassdDiv').css('display', 'block');
            }
        });


        $('#assignSubjectForm').on('submit', function(e) {
            e.preventDefault();

            $('#assignSubjectSubmitBtn').attr('disabled', true);
            $('#assignSubjectSubmitBtn').text('Please wait...');
            $('#assignSubjectCancelBtn').attr('disabled', true);


            let formData = new FormData(this);
            pondFiles = pond.getFiles();
            for (var i = 0; i < pondFiles.length; i++) {
                // append the blob file
                formData.append('subjectCoverPic', pondFiles[i].file);
            }

            $.ajax({
                url: "{{ route('admin.course.management.subject.assign') }}",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                success: function(data) {
                    console.log(data);
                    if (data.error != null) {
                        $.each(data.error, function(key, val) {
                            toastr.error(val[0]);
                        });
                        $('#assignSubjectSubmitBtn').attr('disabled', false);
                        $('#assignSubjectSubmitBtn').text('Submit');
                        $('#assignSubjectCancelBtn').attr('disabled', false);
                    }
                    if (data.status == 1) {
                        toastr.success(data.message);
                        location.reload(true);
                    } else {
                        toastr.error(data.message);
                        $('#assignSubjectSubmitBtn').attr('disabled', false);
                        $('#assignSubjectSubmitBtn').text('Submit');
                        $('#assignSubjectCancelBtn').attr('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.status == 500 || xhr.status == 422) {
                        toastr.error('Whoops! Something went wrong failed to assign class');
                    }

                    $('#assignSubjectSubmitBtn').attr('disabled', false);
                    $('#assignSubjectSubmitBtn').text('Submit');
                    $('#assignSubjectCancelBtn').attr('disabled', false);
                }
            });
        });


        $(document.body).on('change', '#isPublish', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var subject_id = $(this).data('id');
            // console.log(status);
            var formDat = {
                subjectId: subject_id,
                published: status
            }
            // console.log(formDat);
            $.ajax({
                type: "post",

                url: "{{ route('admin.published.subject') }}",
                data: formDat,

                success: function(data) {
                    console.log(data);
                    if (data.status == 0) {
                        location.reload();
                        toastr.error(data.message);
                    } else {
                        location.reload();
                        toastr.success(data.message);
                    }
                }
            });
        });
    </script>
@endsection
