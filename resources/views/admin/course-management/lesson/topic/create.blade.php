@extends('layout.admin.layoout.admin')
@section('title', 'Course Management - Lesson')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-bulletin-board"></i>
            </span> Add Topic
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Lesson</button>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <form  action="{{route('admin.course.management.lesson.store')}}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" name="parent_id" value="{{$lesson->id}}">
                <div class="row">
                   <div class="col-6">
                    <div class="form-group">
                        <label for="">Topic Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g Perimeter and Area" required>
                    </div>
                   </div>

                <div class="col-12">
                <label for="">Topic content</label>
                        <div class="form-group">
                            <textarea class="ckeditor form-control" name="content"></textarea>
                        </div>

                    </div>
                </div>
                <div style="float: right;">
                    <button type="button" class="btn btn-md btn-default" id="assignClassCancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-md btn-success">Submit</button>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Large modal -->

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

                document.getElementById('lessonVideo'), {
                    allowMultiple: true,
                    maxFiles: 50,
                    imagePreviewHeight: 135,
                    acceptedFileTypes: ['video/mp4'],
                    labelFileTypeNotAllowed:'File of invalid type. Acepted types video/mp4.',
                    labelIdle: '<div style="width:100%;height:100%;"><p> Drag &amp; Drop your files or <span class="filepond--label-action" tabindex="0">Browse</span><br> Maximum number of video is 1 :</p> </div>',
                },
            );

          pond = FilePond.create(

                document.getElementById('lessonImage'), {
                    allowMultiple: true,
                    maxFiles: 50,
                    imagePreviewHeight: 135,
                    acceptedFileTypes: ['image/png', 'image/jpeg'],
                    labelFileTypeNotAllowed:'File of invalid type. Acepted types are png and jpeg/jpg.',
                    labelIdle: '<div style="width:100%;height:100%;"><p> Drag &amp; Drop your files or <span class="filepond--label-action" tabindex="0">Browse</span><br> Maximum number of image is 1 :</p> </div>',
                },
            );
            FilePond.setOptions({
                server:{
                   url:'{{route("admin.course.management.lesson.storefile")}}',
                   headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }

                },
                success:function(data){
                  console.log(data);

                },

            });
        //For hiding modal
        $('#assignSubjectCancelBtn').on('click', function(){
            $('#assignSubjectModal').modal('hide');
            $('#assignSubjectForm')[0].reset();
            $('.assignedClassdDiv').css('display', 'none');
            pond.removeFiles();
        });
    </script>
    <script>
    function changeBoard()
      {
        let board_id=$("#assignedBoard").val();
          $.ajax({
                url:"{{route('board.class')}}",
                type:"get",
                data:{
                    '_token' : "{{csrf_token()}}",
                    'board_id' : board_id
                },
                success:function(data){
                    $('#board-class-dd').html('<option value="">Select Class</option>');
                    data.forEach((boardClass) => {
                        $("#board-class-dd").append('<option value="' + boardClass
                                .id + '">'+'Class-' + boardClass.class + '</option>');
                    });
                    $('#board-subject-dd').html('<option value="">Select Subject</option>');


                },
                error:function(xhr, status, error){
                    if(xhr.status == 500 || xhr.status == 422){
                        toastr.error('Whoops! Something went wrong. Failed to fetch course');
                    }
                }
            });
      }
      $('#board-class-dd').on('change', function () {
                var classId = this.value;
                var boardId=$("#assignedBoard").val();
                $("#board-subject-dd").html('');
                $.ajax({
                    url: "{{route('board.class.subject')}}",
                    type: "POST",
                    data: {
                         class_id: classId,
                         board_id:boardId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('#board-subject-dd').html('<option value="">Select Subject</option>');
                        data.forEach((subject) => {
                        $("#board-subject-dd").append('<option value="' + subject
                                .id + '">'+'Subject-' + subject.subject_name + '</option>');
                        });

                    }
                });
            });
    </script>
    <script>
        $('.ckeditor').ckeditor();
    </script>
@endsection
