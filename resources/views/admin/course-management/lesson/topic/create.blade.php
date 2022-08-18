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
           
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-pdf" role="tab"
                        aria-controls="nav-home" aria-selected="true">Document</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-video" role="tab"
                        aria-controls="nav-profile" aria-selected="false">Video</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                        aria-controls="nav-contact" aria-selected="false">Article</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-practice-test" role="tab"
                        aria-controls="nav-contact" aria-selected="false">MCQ Practice Test</a>
                </div>
            </nav>
            <br><br>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-pdf" role="tabpanel" aria-labelledby="nav-pdf-tab">


                    <div style="overflow-x:auto;">
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
                                @foreach($lesson->topics->where('type',1) as $key=>$topic)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td> {{$topic->parentLesson->name}}</td>
                                    <td> {{$topic->name}}</td>
                                    <td> @if($topic->type==1)pdf @elseif($topic->type==2) video @else
                                        article @endif </article>
                                    </td>
                                    <td> @if($topic->type==1)<a href="{{asset($topic->lessonAttachment->img_url)}}"
                                            target="_blank">
                                            {{basename($topic->lessonAttachment->img_url)}}</a>
                                        @elseif($topic->type==2) <a
                                            href="{{asset($topic->lessonAttachment->video_origin_url)}}"
                                            target="_blank">
                                            {{ substr($topic->lessonAttachment->video_origin_url, 0,40)
                                            }}</a> @else NA @endif</td>

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
                <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">

                    <div style="overflow-x:auto;">
                        <table class="table table-striped" id="lessonTableVideo">
                            <thead>
                                <tr>
                                    <th>#No</th>
                                    <th> Lesson Name </th>
                                    <th> Recources Topics </th>
                                    <th> Type </th>
                                    <th> Recources Path </th>
                                    <th> Thumbnail image </th>
                                    <th> Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lesson->topics->where('type',2) as $keytopic=>$topic)
                                <tr>
                                    <td>{{$keytopic}}</td>
                                    <td> {{$topic->parentLesson->name}}</td>
                                    <td> {{$topic->name}}</td>
                                    <td> @if($topic->type==1)pdf @elseif($topic->type==2) video @else
                                        article @endif </article>
                                    </td>
                                    <td> @if($topic->type==1)<a href="{{asset($topic->lessonAttachment->img_url)}}"
                                            target="_blank">
                                            {{basename($topic->lessonAttachment->img_url)}}</a>
                                        @elseif($topic->type==2) <a
                                            href="{{asset($topic->lessonAttachment->video_origin_url)}}"
                                            target="_blank">
                                            {{ substr($topic->lessonAttachment->video_origin_url, 0,40)
                                            }}</a> @else NA @endif</td>
                                    <td> @if($topic->type==2)<a
                                            href="{{asset($topic->lessonAttachment->video_thumbnail_image)}}"
                                            target="_blank">
                                            {{substr($topic->lessonAttachment->video_thumbnail_image,0,10)}}</a>
                                        @else NA @endif
                                    </td>
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
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped" id="lessonTableArticle">
                            <thead>
                                <tr>
                                    <th>#No</th>
                                    <th> Lesson Name </th>
                                    <th> Recources Topics </th>
                                    <th> Type </th>
                                    <th> Article </th>
                                    <th> Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lesson->topics->where('type',3) as $keytopic=>$topic)
                                <tr>
                                    <td>{{$keytopic}}</td>
                                    <td> {{$topic->parentLesson->name}}</td>
                                    <td> {{$topic->name}}</td>
                                    <td> @if($topic->type==1)pdf @elseif($topic->type==2) video @else
                                        article @endif </article>
                                    </td>
                                    <td>  {{ substr($topic->content, 0,40)}} <a href="" title="View Details"><i class="mdi mdi-eye"></i></a></td>
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
                <div class="tab-pane fade" id="nav-practice-test" role="tabpanel" aria-labelledby="nav-practice-test">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped" id="lessonTableMcq">
                            <thead>
                                <tr>
                                    <th>#No</th>
                                    <th> Set Name </th>
                                    <th> Total Question </th>
                                    <th> Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lesson->Sets as $keyset=>$set)
                                <tr>
                                    <td>{{$keyset+1}}</td>
                                    <td> {{$set->set_name}}</td>
                                    <td> {{$set->question->count()}}</td>
                                    <td> @if($set->is_activate==1)Active @else InActive @endif</td>
                                    {{-- <td>@if($topic->status==1)Active @else InActive @endif</td> --}}
                                    <td><a href="" title="Edit Lesson"><i class="mdi mdi-grease-pencil"></i></a>
                                        <a href="{{route('admin.view.mcq.question',Crypt::encrypt($set->id))}}" title="View Details"><i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endif

<!-- Large modal -->

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#lessonTable').DataTable({
            "processing": true,
            "searching": true,
            "ordering": false
        });
        $('#lessonTableVideo').DataTable({
            "processing": true,
            "searching": true,
            "ordering": false
        });
        $('#lessonTableArticle').DataTable({
            "processing": true,
            "searching": true,
            "ordering": false
        });
        $('#lessonTableMcq').DataTable({
            "processing": true,
            "searching": true,
            "ordering": false
        })
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