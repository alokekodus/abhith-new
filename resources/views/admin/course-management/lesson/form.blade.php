<div class="row">
    <div class="col-4">
        <div class="form-group">
            <label for="">Select Board</label>
            <select name="board_id" id="assignedBoard" class="form-control"
                onchange="changeBoard()">
                <option value="">-- Select -- </option>
                @forelse ($boards as $item)
                <option value="{{$item->id}}"@isset($lesson)@if($lesson->board_id==$item->id) selected @endif @endisset>{{$item->exam_board}}</option>
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
    <div class="col-4">
        <div class="form-group">
            <label for="">Lesson Name</label>
            <input type="text" name="name" class="form-control" placeholder="e.g Perimeter and Area" value="@isset($lesson){{$lesson->name}}@endisset"
                >
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="">Upload Lesson Picture</label>
            <input type="file" class="filepond" name="image_url" id="lessonImage"
                data-max-file-size="1MB" data-max-files="1" />
        </div>
    </div>

    <div class="col-4">
        <div class="form-group">
            <label for="">Upload Lesson Video</label>
            <input type="file" class="filepond" name="video_url" id="lessonVideo"
                data-max-file-size="50MB" data-max-files="50" />
        </div>
    </div>
</div>

<div class="col-12">
    <div class="form-group">
        <textarea class="ckeditor form-control" name="content" id="content">
            @isset($lesson){!!$lesson->content!!}@endisset
        </textarea>
    </div>

</div>