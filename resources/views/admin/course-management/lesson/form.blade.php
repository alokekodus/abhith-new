<div class="row">
    <div class="col-4">
        <div class="form-group">
            <label for="">Select Board</label>
            <select name="board_id" id="assignedBoard" class="form-control" onchange="changeBoard()">
                <option value="">-- Select -- </option>
                @forelse ($boards as $item)
                <option value="{{$item->id}}" @isset($lesson)@if($lesson->board_id==$item->id) selected @endif
                    @endisset>{{$item->exam_board}}</option>
                @empty
                <option>No boards to show</option>
                @endforelse
            </select>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="">Select Class</label>
            <select name="assign_class_id" id="board-class-dd" class="form-control">
                <option value="">-- Select -- </option>

            </select>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="">Select Subject</label>
            <select name="assign_subject_id" id="board-subject-dd" class="form-control">
                <option value="">-- Select -- </option>

            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="">Lesson Name</label>
            <input type="text" name="name" class="form-control" placeholder="e.g Perimeter and Area"
                value="@isset($lesson){{$lesson->name}}@endisset">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="">Upload Lesson Picture</label>
            <div class="file-upload">
                <div class="file-select">
                    <div class="file-select-button" id="fileName">Choose File</div>
                    <div class="file-select-name" id="noImageFile">No file chosen...</div>
                    <input type="file" id='imageUpload' name="image_url">
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <img id="blah" src="#" alt="your image" height="200" controls style="display: none;"/>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="">Upload Lesson Video</label>
            <div class="file-upload">
                <div class="file-select">
                    <div class="file-select-button" id="fileName">Choose File</div>
                    <div class="file-select-name" id="noFile">No file chosen...</div>
                    <input type="file" id='videoUpload' name="video_url" accept="video/mp4,video/x-m4v,video/*">
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <video width="937" height="250" id='videoPriview' controls style="display: none;">
               
            </video>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="">Lesson Content</label>
            <textarea class="ckeditor form-control" name="content" id="content">
            @isset($lesson){!!$lesson->content!!}@endisset
        </textarea>
        </div>

    </div>
</div>