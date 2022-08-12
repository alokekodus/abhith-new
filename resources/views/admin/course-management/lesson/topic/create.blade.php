@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Lesson')
@section('form-label','Topic')
@section('content')
<style>
    .dyn-height {
        width: 100px;
        max-height: 692px;
        overflow-y: auto;
    }
</style>
<link rel="stylesheet" href="{{ asset('asset_admin/css/lesson.css') }}">
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> Add Resources
    </h3>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form id="assignTopicForm" enctype="multipart/form-data" method="post"
                            action="{{route('admin.course.management.lesson.topic.store')}}">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{$lesson->id}}">
                            <input type="hidden" name="type" value="create-topic">
                            @include('admin.course-management.lesson.common.form')
                            <div style="float: right;">
                                <button type="button" class="btn btn-md btn-default"
                                    id="assignTopicCancelBtn">Cancel</button>
                                <button type="submit" class="btn btn-md btn-success" id="assignTopicSubmitBtn"
                                    name="type" value="create-topic">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@if($lesson->topics()->exists())
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">All Recources</h4>
            <table class="table table-striped" id="lessonTable">
                <thead>
                    <tr>
                        <th>#No</th>
                        <th> Lesson Name </th>
                        <th> Recources Topics </th>
                        <th> Type </th>
                        <th> Recources Path </th>
                        <th> Status </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lesson->topics as $key=>$topic)
                    <tr>
                        <td>{{++$key}}</td>
                        <td> {{$topic->parentLesson->name}}</td>
                        <td> {{$topic->name}}</td>
                        <td> @if($topic->type==1)pdf @elseif($topic->type==2) video @else article @endif </article>
                        </td>
                        <td> <a href="{{asset($topic->lessonAttachment->img_url)}}" target="_blank">
                                {{basename($topic->lessonAttachment->img_url)}}</a></td>
                        <td>@if($topic->status==1)Active @else InActive @endif</td>
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
    // $(document).ready(function () {
    //     // jQuery.validator.addMethod('name_rule', function (value, element) {
    //     //     if (/^[a-zA-Z]+(([',-][a-zA-Z ])?[a-zA-Z]*)*$/g.test(value)) {
    //     //         return true;
    //     //     } else {
    //     //         return false;
    //     //     };
    //     // });
    //     jQuery.validator.addMethod("img_extension", function (value, element, param) {
    //         param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
    //         return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
    //     });
    //     jQuery.validator.addMethod('maxfilesize', function (value, element, param) {
    //         var length = (element.files.length);

    //         var fileSize = 0;

    //         if (length > 0) {
    //             for (var i = 0; i < length; i++) {
    //                 fileSize = element.files[i].size;


    //                 fileSize = fileSize / 1024; //file size in Kb
    //                 fileSize = fileSize / 1024; //file size in Mb

    //                 return this.optional(element) || fileSize <= param;
    //             }

    //         }
    //         else {
    //             return this.optional(element) || fileSize <= param;

    //         }
    //     });
    //     $("#assignTopicForm").validate({
    //         rules: {
    //             board_id: {
    //                 required: true,
    //             },
    //             assign_class_id: {
    //                 required: true,
    //             },
    //             assign_subject_id: {
    //                 required: true,
    //             },
    //             name: {
    //                 required: true,
    //                 // name_rule: true,
    //                 minlength: 10,
    //             },
    //             image_url: {
    //                 required: true,
    //                 img_extension: true,
    //                 img_maxfilesize: 2,

    //             },
               
    //             content: {
    //                 required: true,
    //             },

    //         },
    //         messages: {
    //             board_id: {
    //                 required: "Board name is required",
    //             },
    //             assign_class_id: {
    //                 required: "Class name is required",
    //                 // maxlength: "Last name cannot be more than 20 characters"
    //             },
    //             assign_subject_id: {
    //                 required: "Subject is required",
    //             },
    //             name: {
    //                 required: "Lesson Name is required",
    //                 name_rule: "Please insert a valid name",
    //                 minlength: "The name should greater than or equal to 50 characters"
    //             },
    //             image_url: {
    //                 required: "Image is required",
    //                 img_extension: "The Image should be in jpg|jpeg|png|gif format",
    //                 maxfilesize: "File size must not be more than 1 MB."
    //             },
    //             content: {
    //                 required: "Content is required",
    //             },

    //         },
    //         errorPlacement: function (error, element) {
    //             console.log(element.attr("name"));
    //             if (element.attr("name") == "image_url") {
    //                 error.appendTo("#imageUrlError");
    //             } else if (element.attr("name") == "video_url") {
    //                 error.appendTo("#videoUrlError");
    //             } else {
    //                 error.insertAfter(element)
    //             }


    //         }
    //     });
    // });

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
    var myVideos = [];
    videoUpload.onchange = function (event) {
        videoPriview.style.display = "block";
        let file = event.target.files[0];
        let blobURL = URL.createObjectURL(file);
        document.querySelector("video").src = blobURL;
        var files = this.files;
        myVideos.push(files[0]);
        var video = document.createElement('video');
        video.preload = 'metadata';
        
        var input=evt.srcElement;
            $("#noFileVideo").html(input.files[0].name);
    }
    
    function showDiv(){
   var showDivId= document.getElementById("content_type").value;
  
   if(showDivId==1){
          $('#fileattachment').show();
            $('#video').hide();
            $('#article').hide();
            $('#practice-test').hide();
   }else if(showDivId==2){
            $('#fileattachment').hide();
            $('#video').show();
            $('#article').hide();
            $('#practice-test').hide();
   }else if(showDivId==3){
            $('#fileattachment').hide();
            $('#video').hide();
            $('#article').show();
            $('#practice-test').hide();
   }else if(showDivId==4){
            $('#practice-test').show();
            $('#fileattachment').hide();
            $('#video').hide();
            $('#article').hide();
   }else{
     $('#fileattachment').hide();
            $('#video').hide();
            $('#article').hide();
   }
   
 }
    //For hiding modal
    $('#assignTopicCancelBtn').on('click', function () {
        $('#assignLessonModal').modal('hide');
        $('#assignTopicForm')[0].reset();


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
    //count video duration

//     var myVideos = [];

// window.URL = window.URL || window.webkitURL;

// document.getElementById('videoUpload').onchange = setFileInfo;

// function setFileInfo() {
//   var files = this.files;
//   myVideos.push(files[0]);
//   var video = document.createElement('video');
//   video.preload = 'metadata';

//   video.onloadedmetadata = function() {
//     window.URL.revokeObjectURL(video.src);
//     var duration = video.duration;
//     myVideos[myVideos.length - 1].duration = duration;
//     $("#video-duration").value=duration/60;
   
//   }

//   video.src = URL.createObjectURL(files[0]);
// }


// function updateInfos() {
//   var infos = document.getElementById('infos');
//   infos.textContent = "";
//   for (var i = 0; i < myVideos.length; i++) {
//     infos.textContent += myVideos[i].name + " duration: " + myVideos[i].duration + '\n';
//   }
// }
</script>
@endsection