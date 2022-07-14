@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Lesson')
@section('content')
<link rel="stylesheet" href="{{ asset('asset_admin/css/lesson.css') }}">
@section('lesson-type') {{$form_type}} @endsection
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
<div class="card">
    <div class="card-body">
        <div>
            <form id="assignLessonForm" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" name="type" value="lesson-create">
                @include('admin.course-management.lesson.form')

                <div style="float: right;">
                    <button type="button" class="btn btn-md btn-default" id="assignLessonCancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-md btn-success" id="assignLessonSubmitBtn" name="type"
                        value="lesson-create">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Large modal -->

@endsection

@section('scripts')
<script>
   
    var myVideos = [];

    window.URL = window.URL || window.webkitURL;
    document.getElementById("videoUpload").onchange = setFileInfo;

        function setFileInfo() {
            console.log("click here");
        var files = this.files;
        myVideos.push(files[0]);
        var video = document.createElement('video');
        video.preload = 'metadata';

        video.onloadedmetadata = function() {
            window.URL.revokeObjectURL(video.src);
            var duration = video.duration;
            myVideos[myVideos.length - 1].duration = duration;
            updateInfos();
        }

        video.src = URL.createObjectURL(files[0]);;
        }
        function updateInfos() {
        
      
        for (var i = 0; i < myVideos.length; i++) {
            var duration= myVideos[i].duration/60;
            document.getElementById('duration').value= duration;
            console.log(duration);
        }
      }
</script>
<script>
    $(document).ready(function () {
        // jQuery.validator.addMethod('name_rule', function (value, element) {
        //     if (/^[a-zA-Z]+(([',-][a-zA-Z ])?[a-zA-Z]*)*$/g.test(value)) {
        //         return true;
        //     } else {
        //         return false;
        //     };
        // });
        jQuery.validator.addMethod("img_extension", function (value, element, param) {
            param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
            return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
        });
        jQuery.validator.addMethod('maxfilesize', function (value, element, param) {
            var length = (element.files.length);

            var fileSize = 0;

            if (length > 0) {
                for (var i = 0; i < length; i++) {
                    fileSize = element.files[i].size;


                    fileSize = fileSize / 1024; //file size in Kb
                    fileSize = fileSize / 1024; //file size in Mb

                    return this.optional(element) || fileSize <= param;
                }

            }
            else {
                return this.optional(element) || fileSize <= param;

            }
        });
        $("#assignLessonForm").validate({
            rules: {
                board_id: {
                    required: true,
                },
                assign_class_id: {
                    required: true,
                },
                assign_subject_id: {
                    required: true,
                },
                name: {
                    required: true,
                  
                },
                content_type: {
                    required: true,
                   

                },
               

            },
            messages: {
                board_id: {
                    required: "Board name is required",
                },
                assign_class_id: {
                    required: "Class name is required",
                    // maxlength: "Last name cannot be more than 20 characters"
                },
                assign_subject_id: {
                    required: "Subject is required",
                },
                name: {
                    required: "Lesson Name is required",
                },
                content_type: {
                    required: "Image is required",
                    
                }

            },
        });
    });

    // For datatable
    $(document).ready(function () {
        $('#boardsTable').DataTable({
            "processing": true,
            "searching": true,
            "ordering": false
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
            var input=evt.srcElement;
            $("#noCoverImage").html(input.files[0].name);
        }
    }
    videoThumbnailImageUpload.onchange = evt => {
        const [file] = videoThumbnailImageUpload.files
        if (file) {
            videothumbnailimagepreview.style.display = "block";
            videothumbnailimagepreview.src = URL.createObjectURL(file)
            var input=evt.srcElement;
            $("#noImageFilePromoVideo").html(input.files[0].name);
        }
    }
    videoUpload.onchange = evt => {
        videoPriview.style.display = "block";
        let file = evt.target.files[0];
        let blobURL = URL.createObjectURL(file);
        document.querySelector("video").src = blobURL;
        var input=evt.srcElement;
            $("#noFileVideo").html(input.files[0].name);
    }
    $("#addLesson").on('click', function () {
        $('#assignLessonModal').modal({ backdrop: 'static', keyboard: false });
    })
    //For hiding modal
    $('#assignLessonCancelBtn').on('click', function () {
        $('#assignLessonModal').modal('hide');
        $('#assignLessonForm')[0].reset();


    });
    $('#assignLessonForm').on('submit', function (e) {
        e.preventDefault();

        $('#assignLessonSubmitBtn').attr('disabled', true);
        $('#assignLessonSubmitBtn').text('Please wait...');
        $('#assignLessonCancelBtn').attr('disabled', true);


        let formData = new FormData(this);

        var Content = CKEDITOR.instances['content'].getData();

        formData.append('content', Content);
       
        $.ajax({
            url: '{{route('admin.course.management.lesson.store')}}',
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,

            success: function (data) {
                console.log(data);
                if (data.error != null) {
                    $.each(data.error, function (key, val) {
                        toastr.error(val[0]);
                    });
                    $('#assignLessonSubmitBtn').attr('disabled', false);
                    $('#assignLessonSubmitBtn').text('Submit');
                    $('#assignLessonCancelBtn').attr('disabled', false);
                }
                if (data.status == 1) {
                    console.log(data);
                    toastr.success(data.message);
                    location.reload(true);
                } else {

                    toastr.error(data.message);
                    $('#assignLessonSubmitBtn').attr('disabled', false);
                    $('#assignLessonSubmitBtn').text('Submit');
                    $('#assignLessonCancelBtn').attr('disabled', false);
                }
            },
            error: function (xhr, status, error) {

                if (xhr.status == 500 || xhr.status == 422) {
                    toastr.error('Whoops! Something went wrong failed to assign lesson');
                }

                $('#assignLessonSubmitBtn').attr('disabled', false);
                $('#assignLessonSubmitBtn').text('Submit');
                $('#assignLessonCancelBtn').attr('disabled', false);
            }
        });
    });

    $('#assignedBoard').on('change', function () {
        let board_id = $("#assignedBoard").val();
        const url="{{route('board.class')}}";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                '_token': "{{csrf_token()}}",
                'board_id': board_id
            },
            success: function (data) {

                $('#board-class-dd').html('<option value="">Select Class</option>');
                data.forEach((boardClass) => {
                    $("#board-class-dd").append('<option value="' + boardClass
                        .id + '">' + 'Class-' + boardClass.class + '</option>');
                });
                $('#board-subject-dd').html('<option value="">Select Subject</option>');


            },
            error: function (xhr, status, error) {
                if (xhr.status == 500 || xhr.status == 422) {
                    toastr.error('Whoops! Something went wrong. Failed to fetch course');
                }
            }
        });
    });
    $('#board-class-dd').on('change', function () {
        var classId = this.value;
        var boardId = $("#assignedBoard").val();
        const url="{{route('board.class.subject')}}";
        $("#board-subject-dd").html('');
        $.ajax({
            url: url,
            type: "POST",
            data: {
                class_id: classId,
                board_id: boardId,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (data) {
                $('#board-subject-dd').html('<option value="">Select Subject</option>');
                data.forEach((subject) => {
                    $("#board-subject-dd").append('<option value="' + subject
                        .id + '">' + 'Subject-' + subject.subject_name + '</option>');
                });

            }
        });
    });


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
 function showDiv(){
   var showDivId= document.getElementById("content_type").value;
  
   if(showDivId==1){
          $('#fileattachment').show();
            $('#video').hide();
            $('#article').hide();
   }else if(showDivId==2){
            $('#fileattachment').hide();
            $('#video').show();
            $('#article').hide();
   }else if(showDivId==3){
            $('#fileattachment').hide();
            $('#video').hide();
            $('#article').show();
   }else{
     $('#fileattachment').hide();
            $('#video').hide();
            $('#article').hide();
   }
   
 }
</script>

@endsection