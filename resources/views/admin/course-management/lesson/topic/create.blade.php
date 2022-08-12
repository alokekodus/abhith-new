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
    
    // videoUpload.onchange = function (event) { 
    //     videoPriview.style.display = "block";
    //     let file = event.target.files[0];
    //     let blobURL = URL.createObjectURL(file);
    //     document.querySelector("video").src = blobURL;
    //     var input=event.srcElement;
    //     $("#noFileVideo").html(input.files[0].name);
       
    // }
    
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
    //count video duration
    var myVideos = [];

window.URL = window.URL || window.webkitURL;

document.getElementById('videoUpload').onchange = setFileInfo;

function setFileInfo() {
  var files = this.files;
  videoPriview.style.display = "block";
  let file = files[0];
  let blobURL = URL.createObjectURL(file);
  document.querySelector("video").src = blobURL;
  $("#noFileVideo").html(file.name);
  myVideos.push(files[0]);
  var video = document.createElement('video');
  video.preload = 'metadata';

  video.onloadedmetadata = function() {
    window.URL.revokeObjectURL(video.src);
    var duration = video.duration;
    myVideos[myVideos.length - 1].duration = duration;
    document.getElementById("duration").value=duration/60;
    
  }

  video.src = URL.createObjectURL(files[0]);
}




</script>
@endsection