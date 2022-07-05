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
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Subject Name<span class="text-danger">*</span></label>
                        <input type="text" name="subjectName" class="form-control" id="subjectName"
                            placeholder="e.g Science, Math etc.">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Belongs to Class</label>
                        <select name="assignedClass" id="assignedClass" class="form-control">
                            <option value="">-- Select -- </option>
                            @forelse ($classes as $key => $item)

                            <option value="{{$item->id}}{{$item->boards->id}}"> Class - {{$item->class}} --
                                {{$item->boards->exam_board}} Board -- </option>
                            @empty
                            <option disabled>No Class to show</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Upload Subject Cover Picture</label>
                        <div class="file-upload">
                            <div class="file-select">
                                <div class="file-select-button" id="fileName">Choose File</div>
                                <div class="file-select-name" id="noCoverImage">No file chosen...</div>
                                <input type="file" id='imageUpload' name="image_url" accept=".jpg, .jpeg, .png" value="{{asset('files/subject/placeholder.jpg')}}">
                            </div>
                        </div>
                        <span id="imageUrlError"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <img id="blah" src="{{asset('files/subject/placeholder.jpg')}}" alt="your image" height="200"
                            width="350" controls style="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Upload Subject Promo Video Thumbnail Image</label>
                        <div class="file-upload">
                            <div class="file-select">
                                <div class="file-select-button" id="fileName">Choose File</div>
                                <div class="file-select-name" id="noImageFilePromoVideo">No file chosen...</div>
                                <input type="file" id='videoThumbnailImageUpload' onchange="changeVideoImage(this);"
                                    name="video_thumbnail_image_url" value="{{asset('files/subject/placeholder.jpg')}}">
                            </div>
                        </div>
                        <span id="imageUrlError"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <img id="videothumbnailimagepreview" src="{{asset('files/subject/placeholder.jpg')}}"
                            alt="your image" height="200" width="350" controls style="" />
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Upload Subject Promo Video</label>
                        <div class="file-upload">
                            <div class="file-select">
                                <div class="file-select-button" id="fileName">Choose File</div>
                                <div class="file-select-name" id="noFileVideo">No file chosen...</div>
                                <input type="file" id='videoUpload' name="video_url"
                                    accept="video/mp4,video/x-m4v,video/*">
                            </div>
                        </div>
                        <span id="videoUrlError"></span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <video width="600" height="250" id='videoPriview' controls style="display: none;">

                        </video>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Subject Description<span class="text-danger">*</span></label>
                        <textarea class="ckeditor form-control" name="description" id="description">

                         </textarea>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Subject Amount<span class="text-danger">*</span></label>
                        <input type="text" name="subject_amount" class="form-control" id="subject_amount"
                            placeholder="7000">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Why will students learn this subject?<span class="text-danger">*</span></label>
                        <textarea class="ckeditor form-control" name="why_learn" id="why_learn">

                </textarea>
                    </div>
                </div>

            </div>
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
// $('#addSubject').on('submit', function (e) {
//         e.preventDefault();

//         $('#assignLessonSubmitBtn').attr('disabled', true);
//         $('#assignLessonSubmitBtn').text('Please wait...');
//         $('#assignLessonCancelBtn').attr('disabled', true);


//         let formData = new FormData(this);

//         var Content = CKEDITOR.instances['subjectdescription'].getData();

//         formData.append('subjectdescription', Content);
//         var WhyLearn = CKEDITOR.instances['whylearncontent'].getData();

//         formData.append('whylearncontent', WhyLearn);
       
//         $.ajax({
//                 url:"{{route('admin.course.management.subject.store')}}",
//                 type:"POST",
//                 processData:false,
//                 contentType:false,
//                 data:formData,
//                 success:function(data, textStatus, jqXHR) {
//                     console.log(data);
//                     if(data.error != null){
//                         $.each(data.error, function(key, val){
//                             toastr.error(val[0]);
//                         });
//                         $('#assignClassSubmitBtn').attr('disabled', false);
//                         $('#assignClassSubmitBtn').text('Submit');
//                         $('#assignClassCancelBtn').attr('disabled', false);
//                     }
//                     if(data.status == 1){
//                         toastr.success(data.message);
//                         location.reload(true);
//                     }else{
//                         toastr.error(data.message);
//                         $('#assignClassSubmitBtn').attr('disabled', false);
//                         $('#assignClassSubmitBtn').text('Submit');
//                         $('#assignClassCancelBtn').attr('disabled', false);
//                     }
//                 },
//                 error: function(jqXHR, textStatus, errorThrown) {
//                     if(xhr.status == 500 || xhr.status == 422){
//                         toastr.error('Whoops! Something went wrong failed to assign class');
//                     }

//                     $('#assignClassSubmitBtn').attr('disabled', false);
//                     $('#assignClassSubmitBtn').text('Submit');
//                     $('#assignClassCancelBtn').attr('disabled', false);
//                 }
//             });
//     });

// </script>
// <script>
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
        var input=evt.srcElement;
        document.querySelector("video").src = blobURL;
            $("#noFileVideo").html(input.files[0].name);
   }
    
       
</script>
@endsection