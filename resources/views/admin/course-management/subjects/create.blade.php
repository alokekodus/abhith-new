@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Subjects')
@section('head')
<link rel="stylesheet" href="{{ asset('asset_admin/css/lesson.css') }}">
@endsection
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> Create Subjects
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="" class="btn btn-gradient-primary btn-fw" data-backdrop="static" data-keyboard="false">Add
                    Subject</a>
            </li>
        </ul>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <form enctype="multipart/form-data" id="addSubject" action="{{route('admin.course.management.subject.store')}}" method="POST">
            @csrf
             @include('admin.course-management.subjects.form')
            <div style="float: right;">
                <button type="button" class="btn btn-md btn-default" id="assignSubjectCancelBtn">Cancel</button>
                <button type="submit" class="btn btn-md btn-success" id="assignSubjectSubmitBtn">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')

<script>

    CKEDITOR.replace( 'description', {
	toolbar: [
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
	]
}); 
	
</script>
<script>
    CKEDITOR.replace( 'why_learn', {
	toolbar: [
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
	]
    });
</script>
<script>
    $(document).ready(function () {

    $('#addSubject').validate({
        rules: {
            subjectName: {
                required: true
            },
            assignedClass:{
                required:true
            },
            description:{
                required:true
            },
            why_learn:{
                required:true
            }
        },
        messages: {
            subjectName: {
                required: "Please Enter Subjet Name ."
            },    
            assignedClass:{
                required:"Please Select Class."
            },
            description:{
                required:"Subject Description Filed is required.",
            },
            why_learn:{
                required:"This Filed is required.",
            }
        },
      });
});

    imageUpload.onchange = evt => {
        const [file] = imageUpload.files
        if (file) {
            blah.style.display = "block";
            blah.src = URL.createObjectURL(file);
            var input=evt.srcElement;
            $("#noCoverImage").html(input.files[0].name);
        }
    }
    videoThumbnailImageUpload.onchange = evt =>{
        const [file] = videoThumbnailImageUpload.files
        if (file) {
            videothumbnailimagepreview.style.display = "block";
            videothumbnailimagepreview.src = URL.createObjectURL(file)
            var input=evt.srcElement;
            $("#noImageFilePromoVideo").html(input.files[0].name);
        }
    }
    videoUpload.onchange = evt =>{
    videoPriview.style.display = "block";
        let file = evt.target.files[0];
        let blobURL = URL.createObjectURL(file);
        document.querySelector("video").src = blobURL;
        var input=evt.srcElement;
            $("#noFileVideo").html(input.files[0].name);
   }
    
       
</script>
@endsection