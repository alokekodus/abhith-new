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
        </span> Add Topic
    </h3>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0"><a href="{{route('admin.course.management.lesson.view',$lesson->slug)}}"
                    class="btn btn-gradient-primary p-2" title="View Lesson Details"> Lesson
                    Name:{{$lesson->name}}</a>


                <div class="float-right"> All Lesson [Total lesson:
                    {{$lesson->topics->count()}}]</div>

            </h5>
        </div>
        <div class="row">
            <div class="col-8 p-4">
                <div class="card">
                    <form id="assignTopicForm" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{$lesson->id}}">
                        <input type="hidden" name="type" value="create-topic">
                        @include('admin.course-management.lesson.common.form')
                        <div style="float: right;">
                            <button type="button" class="btn btn-md btn-default"
                                id="assignTopicCancelBtn">Cancel</button>
                            <button type="submit" class="btn btn-md btn-success" id="assignTopicSubmitBtn" name="type"
                                value="create-topic">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-4 p-4 dyn-height">
                <br>
                @if($lesson->topics()->exists())
                @include('admin.course-management.lesson.topic.all')
                @else
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">

                            Topic Not Added yet

                        </h5>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


<!-- Large modal -->

@endsection

@section('scripts')
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
        $("#assignTopicForm").validate({
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
                    // name_rule: true,
                    minlength: 10,
                },
                image_url: {
                    required: true,
                    img_extension: true,
                    img_maxfilesize: 2,

                },
               
                content: {
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
                    name_rule: "Please insert a valid name",
                    minlength: "The name should greater than or equal to 50 characters"
                },
                image_url: {
                    required: "Image is required",
                    img_extension: "The Image should be in jpg|jpeg|png|gif format",
                    maxfilesize: "File size must not be more than 1 MB."
                },
                content: {
                    required: "Content is required",
                },

            },
            errorPlacement: function (error, element) {
                console.log(element.attr("name"));
                if (element.attr("name") == "image_url") {
                    error.appendTo("#imageUrlError");
                } else if (element.attr("name") == "video_url") {
                    error.appendTo("#videoUrlError");
                } else {
                    error.insertAfter(element)
                }


            }
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
            blah.style.display = "block";
            blah.src = URL.createObjectURL(file)

        }
    }
    videoThumbnailImageUpload.onchange = evt => {
        const [file] = videoThumbnailImageUpload.files
        if (file) {
            videothumbnailimagepreview.style.display = "block";
            videothumbnailimagepreview.src = URL.createObjectURL(file)

        }
    }
    videoUpload.onchange = function (event) {
        videoPriview.style.display = "block";
        let file = event.target.files[0];
        let blobURL = URL.createObjectURL(file);
        document.querySelector("video").src = blobURL;
    }
    
    //For hiding modal
    $('#assignTopicCancelBtn').on('click', function () {
        $('#assignLessonModal').modal('hide');
        $('#assignTopicForm')[0].reset();


    });
    $('#assignTopicForm').on('submit', function (e) {
        e.preventDefault();

        $('#assignTopicSubmitBtn').attr('disabled', true);
        $('#assignTopicSubmitBtn').text('Please wait...');
        $('#assignTopicCancelBtn').attr('disabled', true);


        let formData = new FormData(this);

        var Content = CKEDITOR.instances['content'].getData();

        formData.append('content', Content);

        $.ajax({
            url: "{{route('admin.course.management.lesson.store')}}",
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
                    $('#assignTopicSubmitBtn').attr('disabled', false);
                    $('#assignTopicSubmitBtn').text('Submit');
                    $('#assignTopicCancelBtn').attr('disabled', false);
                }
                if (data.status == 1) {
                    console.log(data);
                    toastr.success(data.message);
                    location.reload(true);
                } else {

                    toastr.error(data.message);
                    $('#assignTopicSubmitBtn').attr('disabled', false);
                    $('#assignTopicSubmitBtn').text('Submit');
                    $('#assignTopicCancelBtn').attr('disabled', false);
                }
            },
            error: function (xhr, status, error) {

                if (xhr.status == 500 || xhr.status == 422) {
                    toastr.error('Whoops! Something went wrong failed to assign lesson');
                }

                $('#assignTopicSubmitBtn').attr('disabled', false);
                $('#assignTopicSubmitBtn').text('Submit');
                $('#assignTopicCancelBtn').attr('disabled', false);
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
</script>
@endsection