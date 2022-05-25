@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Lesson')
@section('content')
<style>
    .lesson-image {
        height: 200px;
        width: 150px;
    }

    div.scrollmenu {
        overflow: auto;
        white-space: nowrap;
    }

    div.scrollmenu a {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px;
        text-decoration: none;
    }

    div.scrollmenu a:hover {
        background-color: #777;
    }

    .file-upload {
        display: block;
        text-align: center;
        font-family: Helvetica, Arial, sans-serif;
        font-size: 12px;
    }

    .file-upload .file-select {
        display: block;
        border: 2px solid #dce4ec;
        color: #34495e;
        cursor: pointer;
        height: 40px;
        line-height: 40px;
        text-align: left;
        background: #FFFFFF;
        overflow: hidden;
        position: relative;
    }

    .file-upload .file-select .file-select-button {
        background: #dce4ec;
        padding: 0 10px;
        display: inline-block;
        height: 40px;
        line-height: 40px;
    }

    .file-upload .file-select .file-select-name {
        line-height: 40px;
        display: inline-block;
        padding: 0 10px;
    }

    .file-upload .file-select:hover {
        border-color: #34495e;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
    }

    .file-upload .file-select:hover .file-select-button {
        background: #34495e;
        color: #FFFFFF;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
    }

    .file-upload.active .file-select {
        border-color: #3fa46a;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
    }

    .file-upload.active .file-select .file-select-button {
        background: #3fa46a;
        color: #FFFFFF;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
    }

    .file-upload .file-select input[type=file] {
        z-index: 100;
        cursor: pointer;
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        filter: alpha(opacity=0);
    }

    .file-upload .file-select.file-select-disabled {
        opacity: 0.65;
    }

    .file-upload .file-select.file-select-disabled:hover {
        cursor: default;
        display: block;
        border: 2px solid #dce4ec;
        color: #34495e;
        cursor: pointer;
        height: 40px;
        line-height: 40px;
        margin-top: 5px;
        text-align: left;
        background: #FFFFFF;
        overflow: hidden;
        position: relative;
    }

    .file-upload .file-select.file-select-disabled:hover .file-select-button {
        background: #dce4ec;
        color: #666666;
        padding: 0 10px;
        display: inline-block;
        height: 40px;
        line-height: 40px;
    }

    .file-upload .file-select.file-select-disabled:hover .file-select-name {
        line-height: 40px;
        display: inline-block;
        padding: 0 10px;
    }
</style>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> Create Lesson
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a type="button" class="btn btn-primary" href="{{route('admin.course.management.lesson.all')}}">All
                    Lesson</a>
            </li>
        </ul>
    </nav>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <form id="assignLessonForm" enctype="multipart/form-data" method="post">
                        @csrf
                        @include('admin.course-management.lesson.form')
                        <div class="form-group">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </div>
                        <div style="float: right;">
                            <button type="button" class="btn btn-md btn-default"
                                id="assignLessonCancelBtn">Cancel</button>
                            <button type="submit" class="btn btn-md btn-success" id="assignLessonSubmitBtn" name="type"
                                value="lesson-create">Submit</button>
                        </div>
                    </form>
                </div>
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

        imageUpload.onchange = evt => {
            const [file] = imageUpload.files
            if (file) {
                blah.style.display = "block";
                blah.src = URL.createObjectURL(file)
              
            }
            }   
            videoUpload.onchange = function(event) {
                videoPriview.style.display="block";
                    let file = event.target.files[0];
                    let blobURL = URL.createObjectURL(file);
                    document.querySelector("video").src = blobURL;
        }
        $("#addLesson").on('click',function(){
            $('#assignLessonModal').modal({backdrop: 'static', keyboard: false}) ;
        })
        //For hiding modal
        $('#assignLessonCancelBtn').on('click', function(){
            $('#assignLessonModal').modal('hide');
            $('#assignLessonForm')[0].reset();
         

        });
        $('#assignLessonForm').on('submit', function(e){
            e.preventDefault();

            $('#assignLessonSubmitBtn').attr('disabled', true);
            $('#assignLessonSubmitBtn').text('Please wait...');
            $('#assignLessonCancelBtn').attr('disabled', true);


            let formData = new FormData(this);
          
            var Content = CKEDITOR.instances['content'].getData();
            
            formData.append('content', Content);
            
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
                        console.log(data);
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
        console.log(board_id);
          $.ajax({
                url:"{{route('board.class')}}",
                type:"POST",
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
    $('#videoUpload').bind('change', function () {
            var filename = $("#videoUpload").val();
            if (/^\s*$/.test(filename)) {
                $(".file-upload").removeClass('active');
                $("#noFile").text("No file chosen..."); 
            }
            else {
                $(".file-upload").addClass('active');
                $("#noFile").text(filename.replace("C:\\fakepath\\", "")); 
            }
       });
        $('#imageUpload').bind('change', function () {
                    var filename = $("#imageUpload").val();
                    if (/^\s*$/.test(filename)) {
                        $(".file-upload").removeClass('active');
                        $("#noImageFile").text("No file chosen..."); 
                    }
                    else {
                        $(".file-upload").addClass('active');
                        $("#noImageFile").text(filename.replace("C:\\fakepath\\", "")); 
                    }
        });
</script>
@endsection