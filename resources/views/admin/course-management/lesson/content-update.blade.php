<div class="modal fade" id="displayMore" tabindex="-1" role="dialog" aria-labelledby="displayMoreTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="displayMoreTitle"><span id="modal-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @csrf
            <form id="updateLessonContent">
                <input type="hidden" name="type" value="content-update">
                <input type="hidden" name="lesson_id" value="lesson-id">
                <div class="modal-body">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class="ckeditor form-control" name="content" id="Content"></textarea>
                        </div>

                    </div>
                    <div style="float: right;">
                        <button type="button" class="btn btn-md btn-default"
                            id="updateLessonContentCancelBtn">Cancel</button>
                        <button type="submit" class="btn btn-md btn-success" id="updateLessonContentSubmitBtn"
                            value="lesson-create">Save Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>