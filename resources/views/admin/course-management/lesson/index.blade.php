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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Lesson</button>
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
                                <td>Lesson</td>
                                <td>Lesson Content</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                               @foreach($lessons as $key=>$lesson)
                               <tr>
                                   <td>{{$key + 1}}</td>
                                    <td>{{$lesson->name}}</td>
                                    <td>{{ substr(strip_tags($lesson->content), 0, 80) }}...</td>
                                    <td><a href="{{route('admin.course.management.lesson.topic.create',$lesson->slug)}}">Add Topic</a></td>
                              </tr>
                                    @endforeach
                        </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Large modal -->


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="assignLessonModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="padding:1.5rem;background-color:#fff;">
        <div class="modal-body">
            <form  id="assignLessonForm">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Select Board</label>
                            <select name="assignedBoard" id="assignedBoard" class="form-control" onchange="changeBoard()">
                                <option value="">-- Select -- </option>
                                @forelse ($boards as $item)
                                <option value="{{$item->id}}">{{$item->exam_board}}</option>
                                @empty
                                <option>No boards to show</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Select Class</label>
                            <select name="assign_class_id" id="board-class-dd" class="form-control">
                                <option value="">-- Select -- </option>

                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Select Subject</label>
                            <select name="assign_subject_id" id="board-subject-dd" class="form-control">
                                <option value="">-- Select -- </option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <div class="col-4">
                    <div class="form-group">
                        <label for="">Lesson Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g Perimeter and Area" required>
                    </div>
                   </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Upload Lesson Picture</label>
                            <input type="file" class="filepond" name="lessonImage" id="lessonImage" data-max-file-size="1MB" data-max-files="1" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Upload Lesson Video</label>
                            <input type="file" class="filepond" name="lessonVideo" id="lessonVideo" data-max-file-size="50MB" data-max-files="50" />
                        </div>
                    </div>
                </div>
               
                <div class="col-12">
                        <div class="form-group">
                            <textarea class="ckeditor form-control" name="Content" id="Content"></textarea>
                        </div>

                    </div>
                <div style="float: right;">
                    <button type="button" class="btn btn-md btn-default" id="assignLessonCancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-md btn-success" id="assignLessonSubmitBtn">Submit</button>
                </div>
            </form>
        </div>
      </div>
  </div>
</div>
{{-- lesson  content display --}}
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
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
            

            pondImage = FilePond.create(

                document.getElementById('lessonImage'), {
                    allowMultiple: true,
                    maxFiles: 50,
                    imagePreviewHeight: 135,
                    acceptedFileTypes: ['image/png', 'image/jpeg'],
                    labelFileTypeNotAllowed:'File of invalid type. Acepted types are png and jpeg/jpg.',
                    labelIdle: '<div style="width:100%;height:100%;"><p> Drag &amp; Drop your files or <span class="filepond--label-action" tabindex="0">Browse</span><br> Maximum number of image is 1 :</p> </div>',
                },
            );
            pondVideo = FilePond.create(

                document.getElementById('lessonVideo'), {
                    allowMultiple: true,
                    maxFiles: 50,
                    imagePreviewHeight: 135,
                    acceptedFileTypes: ['mp4', 'video'],
                    labelFileTypeNotAllowed:'File of invalid type. Acepted types are mp4.',
                    labelIdle: '<div style="width:100%;height:100%;"><p> Drag &amp; Drop your files or <span class="filepond--label-action" tabindex="0">Browse</span><br> Maximum number of video is 1 :</p> </div>',
                },
       );
        //For hiding modal
        $('#assignLessonCancelBtn').on('click', function(){
            $('#assignLessonModal').modal('hide');
            $('#assignLessonForm')[0].reset();
            pondImage.removeFiles();
            pondVideo.removeFiles();
        });
        $('#assignLessonForm').on('submit', function(e){
            e.preventDefault();

            $('#assignLessonSubmitBtn').attr('disabled', true);
            $('#assignLessonSubmitBtn').text('Please wait...');
            $('#assignLessonCancelBtn').attr('disabled', true);


            let formData = new FormData(this);
            pondImageFiles = pondImage.getFiles();
            pondVideoFiles = pondVideo.getFiles();
            for (var i = 0; i < pondImageFiles.length; i++) {
                // append the blob file
                formData.append('lessonImage', pondImageFiles[i].file);
            }
            for (var i = 0; i < pondVideoFiles.length; i++) {
                // append the blob file
                formData.append('lessonVideo', pondImageFiles[i].file);
            }
            var Content = CKEDITOR.instances['Content'].getData();
            formData.append('Content', Content);
            
            $.ajax({
                url:"{{route('admin.course.management.lesson.store')}}",
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
                        $('#assignLessonSubmitBtn').attr('disabled', false);
                        $('#assignLessonSubmitBtn').text('Submit');
                        $('#assignLessonCancelBtn').attr('disabled', false);
                    }
                    if(data.status == 1){
                        toastr.success(data.message);
                        location.reload(true);
                    }else{
                        toastr.error(data.message);
                        $('#assignLessonSubmitBtn').attr('disabled', false);
                        $('#assignLessonSubmitBtn').text('Submit');
                        $('#assignLessonCancelBtn').attr('disabled', false);
                    }
                },
                error:function(xhr, status, error){
                    if(xhr.status == 500 || xhr.status == 422){
                        toastr.error('Whoops! Something went wrong failed to assign lesson');
                    }

                    $('#assignSubjectSubmitBtn').attr('disabled', false);
                    $('#assignSubjectSubmitBtn').text('Submit');
                    $('#assignSubjectCancelBtn').attr('disabled', false);
                }
            });
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
