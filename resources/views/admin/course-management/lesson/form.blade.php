<div class="row">
    <div class="col-4">
        <div class="form-group">
            <label for="">Select Board<span class="text-danger">*</span></label>
            <select name="board_id" id="assignedBoard" class="form-control" onchange="changeBoard()">
                <option value="">-- Select -- </option>
                @forelse ($boards as $item)
                <option value="{{$item->id}}" @isset($lesson)@if($lesson->board_id==$item->id) selected @endif
                    @endisset>{{$item->exam_board}}</option>
                @empty
                <option>No boards to show</option>
                @endforelse
            </select>
           <span></span>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="">Select Class<span class="text-danger">*</span></label>
            <select name="assign_class_id" id="board-class-dd" class="form-control">
                <option value="">-- Select -- </option>

            </select>
           
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="">Select Subject<span class="text-danger">*</span></label>
            <select name="assign_subject_id" id="board-subject-dd" class="form-control">
                <option value="">-- Select -- </option>

            </select>
        </div>
    </div>
</div>

@include('admin.course-management.lesson.common.form')