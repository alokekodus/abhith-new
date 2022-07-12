<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="">Subject Name<span class="text-danger">*</span></label>
            <input type="text" name="subjectName" class="form-control" id="subjectName" value="@isset($subject) {{$subject->subject_name}} @endisset"
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
            <label for="">Subject Amount<span class="text-danger">*</span></label>
            <input type="text" name="subject_amount" class="form-control" id="subject_amount"
                placeholder="7000">
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
    <div class="col-12">
        <div class="form-group">
            <label for="">Why will students learn this subject?<span class="text-danger">*</span></label>
            <textarea class="ckeditor form-control" name="why_learn" id="why_learn">

    </textarea>
        </div>
    </div>

</div>