<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="">@yield('lesson-type') Name<span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="e.g Perimeter and Area"
                value="">
            <span class="text-danger">{{ $errors->first('board_id') }}</span>
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
            <label for="">Upload @yield('lesson-type') Video Thumbnail Image<span class="text-danger">*</span></label>
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
        <img id="blah" src="#" alt="your image" height="150" width="250" controls style="display: none;" />
    </div>
    <div class="col-6">
        <img id="videothumbnailimagepreview" src="#" alt="your image" height="150" width="250" controls style="display: none;" />
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
</div>
<br>
<div class="row">
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
            <label for="">@yield('lesson-type') Content<span class="text-danger">*</span></label>
            <textarea class="ckeditor form-control" name="content" id="content">

        </textarea>
        </div>

    </div>
</div>             