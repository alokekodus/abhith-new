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
        <form action="{{route('admin.course.management.subject.store')}}" enctype="multipart/form-data" method="post">
            @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Subject Name</label>
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
                    <label for="">Assign Teacher</label>
                    <select name="assignedClass" id="assignedClass" class="form-control">
                        <option value="">-- Select -- </option>
                        @forelse ($teachers as $key => $teacher)

                        <option value="{{$teacher->id}}"> Email - {{$teacher->email}} --</option>
                        @empty
                        <option disabled>No Class to show</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="text" name="subjectAmount" class="form-control" id="subjectAmount"
                        placeholder="e.g 3000.">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Upload @yield('lesson-type') Picture<span class="text-danger">*</span></label>
                    <div class="file-upload">
                        <div class="file-select">
                            <div class="file-select-button" id="fileName">Choose File</div>
                            <div class="file-select-name" id="noImageFile">No file chosen...</div>
                            <input type="file" id='imageUpload' name="image_url">
                        </div>
                    </div>
                    <span id="imageUrlError"></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Upload @yield('lesson-type') Video Thumbnail Image<span
                            class="text-danger">*</span></label>
                    <div class="file-upload">
                        <div class="file-select">
                            <div class="file-select-button" id="fileName">Choose File</div>
                            <div class="file-select-name" id="noImageFile">No file chosen...</div>
                            <input type="file" id='videoThumbnailImageUpload' name="video_thumbnail_image_url">
                        </div>
                    </div>
                    <span id="imageUrlError"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <img id="blah" src="#" alt="your image" height="200" width="350" controls style="display: none;" />
            </div>
            <div class="col-6">
                <img id="videothumbnailimagepreview" src="#" alt="your image" height="200" width="350" controls
                    style="display: none;" />
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Upload Lesson Video<span class="text-danger">*</span></label>
                    <div class="file-upload">
                        <div class="file-select">
                            <div class="file-select-button" id="fileName">Choose File</div>
                            <div class="file-select-name" id="noFile">No file chosen...</div>
                            <input type="file" id='videoUpload' name="video_url" accept="video/mp4,video/x-m4v,video/*">
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
                    <textarea class="ckeditor form-control" name="description" id="content">

                </textarea>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Why will students learn this subject?<span class="text-danger">*</span></label>
                    <textarea class="ckeditor form-control" name="why_learn" id="content">

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
    

        
       

        
      



      
</script>
@endsection