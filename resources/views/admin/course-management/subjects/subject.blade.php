@extends('layout.admin.layout.admin')
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
                    <a href="#" class="btn btn-gradient-primary btn-fw" data-toggle="modal" data-target="#assignSubjectModal" data-backdrop="static" data-keyboard="false">Add Subject</a>
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
                                <td>Amount</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $key => $item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->subject_name}}</td>
                                    <td>Class - {{$item->assignClass->class}} -- {{$item->boards->exam_board}} Board --</td>
                                    <td>{{number_format($item->subject_amount,2,'.','')}}</td>
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
                        <label for="">Subject Name</label>
                        <input type="text" name="subjectName" class="form-control" id="subjectName" placeholder="e.g Science, Math etc.">
                    </div>
                    <div class="form-group assignedClassdDiv" style="display:none;">

                        <div class="form-group">
                            <label for="">Upload Subject Cover Picture</label>
                            <input type="file" class="filepond" name="subjectCoverPic" id="subjectCoverPic" data-max-file-size="1MB" data-max-files="1" />
                        </div>
                        <label for="">Belongs to Class</label>
                        <select name="assignedClass" id="assignedClass" class="form-control">
                            <option value="">-- Select -- </option>
                            @forelse ($classes as $key => $item)
                           
                                <option value="{{$item->id}}{{$item->boards->id}}"> Class - {{$item->class}} -- {{$item->boards->exam_board}} Board -- </option>
                            @empty
                                <option  disabled>No Class to show</option>
                            @endforelse
                        </select>
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="text" name="subjectAmount" class="form-control" id="subjectAmount" placeholder="e.g 3000.">
                        </div>
                        
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

         //Upload subject cover pic

         FilePond.registerPlugin(
                // encodes the file as base64 data
                FilePondPluginFileEncode,

                // validates the size of the file
                FilePondPluginFileValidateSize,

                // corrects mobile image orientation
                FilePondPluginImageExifOrientation,

                // previews dropped images
                FilePondPluginImagePreview,
                FilePondPluginFileValidateType
            );

            // Select the file input and use create() to turn it into a pond
            pond = FilePond.create(
                document.getElementById('subjectCoverPic'), {
                    allowMultiple: true,
                    maxFiles: 1,
                    instantUpload: false,
                    imagePreviewHeight: 135,
                    acceptedFileTypes: ['image/png', 'image/jpeg'],
                    labelFileTypeNotAllowed:'File of invalid type. Acepted types are png and jpeg/jpg.',
                    labelIdle: '<div style="width:100%;height:100%;"><p> Drag &amp; Drop your files or <span class="filepond--label-action" tabindex="0">Browse</span><br> Maximum number of image is 1 :</p> </div>',
                }
            );

        //For hiding modal 
        $('#assignSubjectCancelBtn').on('click', function(){
            $('#assignSubjectModal').modal('hide');
            $('#assignSubjectForm')[0].reset();
            $('.assignedClassdDiv').css('display', 'none');
            pond.removeFiles();
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
            pondFiles = pond.getFiles();
            for (var i = 0; i < pondFiles.length; i++) {
                // append the blob file
                formData.append('subjectCoverPic', pondFiles[i].file);
            }

            $.ajax({
                url:"{{route('admin.course.management.subject.assign')}}",
                type:"POST",
                processData:false,
                contentType:false,
                data:formData,
                success:function(data){
                    console.log(data);
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