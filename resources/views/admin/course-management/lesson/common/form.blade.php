<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="">@yield('lesson-type') Name<span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="e.g Perimeter and Area" value="">
            <span class="text-danger">{{ $errors->first('board_id') }}</span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">@yield('lesson-type') Content Type(Image/pdf/video/article)<span
                    class="text-danger">*</span></label>

            <select name="content_type" id="content_type" class="form-control" onchange="showDiv()">
                <option value="">-- Select -- </option>
                <option value="1">File Attachement(Image/pdf)</option>
                <option value="2">Video</option>
                <option value="3">Article</option>
            </select>

        </div>
    </div>
</div>
<div class="fileattachment" id="fileattachment" style="display:none;">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Upload File Attachement(Image/pdf)</label>
                <div class="file-upload">
                    <div class="file-select">
                        <div class="file-select-button" id="fileName">Choose File</div>
                        <div class="file-select-name" id="noCoverImage">No file chosen...</div>
                        <input type="file" id='imageUpload' name="image_url" accept=".jpg, .jpeg, .png"
                            value="{{asset('files/subject/placeholder.jpg')}}">
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
</div>
<div class="video" id="video" style="display:none;">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Upload Video Thumbnail Image</label>
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
                <img id="videothumbnailimagepreview" src="{{asset('files/subject/placeholder.jpg')}}" alt="your image"
                    height="200" width="350" controls style="" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Upload Video</label>
                <div class="file-upload">
                    <div class="file-select">
                        <div class="file-select-button" id="fileName">Choose File</div>
                        <div class="file-select-name" id="noFileVideo">No file chosen...</div>
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
</div>

<div class="article" id="article" style="display:none;">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Write Article<span class="text-danger">*</span></label>
                <textarea class="ckeditor form-control" name="content" id="content">

            </textarea>
            </div>

        </div>
    </div>
</div>