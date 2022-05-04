@extends('layout.admin.layoout.admin')
@section('title', 'Course Management - Lesson')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-bulletin-board"></i>
            </span> All Lesson
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#" class="btn btn-gradient-primary btn-fw" data-toggle="modal" data-target="#assignClassModal" data-backdrop="static" data-keyboard="false">Add Lesson</a>
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
                                <td>Class</td>
                                <td>Assigned Exam Board</td>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal" id="assignClassModal">
        <div class="modal-dialog">
          <div class="modal-content" style="padding:1.5rem;background-color:#fff;">
            <div class="modal-body">
                <form id="assignClassForm">
                    @csrf
                    <div class="form-group">
                        <label for="">Select Class</label>
                        <select name="assignedClass" id="assignedClass" class="form-control">
                            <option value="">-- Select -- </option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Upload Subject Cover Picture</label>
                        <input type="file" class="filepond" name="subjectCoverPic" id="subjectCoverPic" data-max-file-size="50MB" data-max-files="1" />
                    </div>
                    <div class="form-group assignedBoardDiv" style="display:none;">
                        <label for="">Belongs to Board</label>
                        <select name="board" id="board" class="form-control">
                            
                        </select>
                    </div>
                    <div style="float: right;">
                        <button type="button" class="btn btn-md btn-default" id="assignClassCancelBtn">Cancel</button>
                        <button type="submit" class="btn btn-md btn-success" id="assignClassSubmitBtn">Submit</button>
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
         $('#assignClassCancelBtn').on('click', function(){
            $('#assignClassModal').modal('hide');
            $('#assignClassForm')[0].reset();
            $('.assignedBoardDiv').css('display', 'none');
        });
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
                    maxFiles: 50,
                    instantUpload: false,
                    imagePreviewHeight: 135,
                    acceptedFileTypes: ['video/mp4'],
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
    </script>
@endsection