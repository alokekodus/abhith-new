@extends('layout.admin.layoout.admin')
@section('title', 'Course Management - Subjects')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-bulletin-board"></i>
            </span> All Subjects
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#" class="btn btn-gradient-primary btn-fw" data-toggle="modal" data-target="#assignSubjectModal" data-backdrop="static" data-keyboard="false">Assign Subjects</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                   <table id="boardsTable" class="table table-bordered"> 
                        <thead class="thead-light">
                            <tr>
                                <td>#</td>
                                <td>Subject</td>
                                <td>Assigned Class</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $key => $item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->subject_name}}</td>
                                    <td>Class - {{$item->assignClass->class}} -- {{$item->boards->exam_board}} Board --</td>
                                </tr>
                            @endforeach
                        </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
    {{-- @php
        dd($classes);
    @endphp --}}
    <div class="modal" id="assignSubjectModal">
        <div class="modal-dialog">
          <div class="modal-content" style="padding:1.5rem;background-color:#fff;">
            <div class="modal-body">
                <form id="assignSubjectForm">
                    @csrf
                    <div class="form-group">
                        <label for="">Add Subject Name</label>
                        <input type="text" name="subjectName" class="form-control" id="subjectName" placeholder="e.g Science, Math etc.">
                    </div>
                    <div class="form-group assignedClassdDiv" style="display:none;">
                        <label for="">Assigned to Class</label>
                        <select name="assignedClass" id="assignedClass" class="form-control">
                            <option value="">-- Select -- </option>
                            @forelse ($classes as $key => $item)
                           
                                <option value="{{$item->id}}{{$item->boards->id}}"> Class - {{$item->class}} -- {{$item->boards->exam_board}} Board -- </option>
                            @empty
                                <option  disabled>No Class to show</option>
                            @endforelse
                        </select>
                    </div>
                    <div style="float: right;">
                        <button type="button" class="btn btn-md btn-default" id="assignSubjectCancelBtn">Cancel</button>
                        <button type="submit" class="btn btn-md btn-success" id="assignSubjectSubmitBtn">Submit</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // For datatable
        $(document).ready( function () {
            $('#boardsTable').DataTable({
                "processing": true,
                "searching" : true,
                "ordering" : false
            });
        });

        //For hiding modal 
        $('#assignSubjectCancelBtn').on('click', function(){
            $('#assignSubjectModal').modal('hide');
            $('#assignSubjectForm')[0].reset();
            $('.assignedClassdDiv').css('display', 'none');
        });


        
        $('#subjectName').on('change', function(){
            if($(this).val().length > 0){
                $('.assignedClassdDiv').css('display', 'block');
            }
        });



        $('#assignSubjectForm').on('submit', function(e){
            e.preventDefault();

            $('#assignSubjectSubmitBtn').attr('disabled', true);
            $('#assignSubjectSubmitBtn').text('Please wait...');
            $('#assignSubjectCancelBtn').attr('disabled', true);


            let formData = new FormData(this);


            $.ajax({
                url:"{{route('admin.course.management.subject.assign')}}",
                type:"POST",
                processData:false,
                contentType:false,
                data:formData,
                success:function(data){
                    if(data.error != null){
                        $.each(data.error, function(key, val){
                            toastr.error(val[0]);
                        });
                        $('#assignSubjectSubmitBtn').attr('disabled', false);
                        $('#assignSubjectSubmitBtn').text('Submit');
                        $('#assignSubjectCancelBtn').attr('disabled', false);
                    }
                    if(data.status == 1){
                        toastr.success(data.message);
                        location.reload(true);
                    }else{
                        toastr.error(data.message);
                        $('#assignSubjectSubmitBtn').attr('disabled', false);
                        $('#assignSubjectSubmitBtn').text('Submit');
                        $('#assignSubjectCancelBtn').attr('disabled', false);
                    }
                },
                error:function(xhr, status, error){
                    if(xhr.status == 500 || xhr.status == 422){
                        toastr.error('Whoops! Something went wrong failed to assign class');
                    }

                    $('#assignSubjectSubmitBtn').attr('disabled', false);
                    $('#assignSubjectSubmitBtn').text('Submit');
                    $('#assignSubjectCancelBtn').attr('disabled', false);
                }
            });
        });
        
    </script>
@endsection