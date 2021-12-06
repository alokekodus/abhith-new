@extends('layout.admin.layoout.admin')

@section('title','Time Table')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-calendar-clock"></i>
            </span>Add Time Table
        </h3>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form id="addTimeTableForm">
                    @csrf
                    <div class="form-group">
                        <label for="exampleSelectGender">Courses</label>
                        <select class="form-control" name="course" id="selectCourse" required>
                            <option value="" disabled selected>-- Select Course --</option>
                            @foreach ($course as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('course')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group chapter-div"  style="display:none;">
                        <label for="exampleSelectGender">Chapters</label>
                        <select class="form-control" name="chapter" id="selectChapter" required></select>
                        <span class="text-danger">
                            @error('chapter')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCity1">Add Date</label>
                        <input type="text" class="form-control" name="add_date" id="add_date" autocomplete="off" placeholder="Add Date" required>
                        <span class="text-danger">
                            @error('add_date')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCity1">Add Time</label>
                        <input type="text" class="form-control" name="add_time" id="add_time" autocomplete="off" placeholder="Add Time" required>
                        <span class="text-danger">
                            @error('add_time')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCity1">Add Zoom Link</label>
                        <input type="url" class="form-control" name="zoom_link" id="add_zoom_link" placeholder="e.g https://zoom.com/erjdknc22334455kdsl" required>
                        <span class="text-danger">
                            @error('zoom_link')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <button class="btn btn-primary" id="addTimeTable">Submit</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="https://weareoutman.github.io/clockpicker/dist/jquery-clockpicker.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#selectCourse').on('change',function(){
                $('.chapter-div').css('display', 'block');
                $('#selectChapter').find('option').remove().end();
                let chapters = [];
                $.ajax({
                    url:"{{route('admin.create.time.table')}}",
                    type:'GET',
                    data:{
                        'course_id' : $('#selectCourse, option').val(),
                    },
                    success:function(result){
                        // console.log(result.chapter)
                        chapters  = result.chapter;
                        let chapter = document.getElementById('selectChapter');
                        let df = document.createDocumentFragment();
                        for (let chapter in chapters) {
                            let option = document.createElement('option');
                            option.value = chapters[chapter]['id'];
                            option.appendChild(document.createTextNode(chapters[chapter]['name']));
                            df.appendChild(option);
                        }
                        chapter.appendChild(df);
                        
                    },
                    error:function(xhr, status, error){
                        if(xhr.status == 500 || xhr.status == 422){
                            toastr.error('Oops! Something went wrong');
                        }
                    }
                });
            });


            $('#addTimeTableForm').on('submit',function(e){
                e.preventDefault();
                let formdata = new FormData(this);
                $.ajax({
                    url:"{{route('admin.save.time.table')}}",
                    type:"POST",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success:function(result){
                       toastr.success(result.message);
                       $('#addTimeTableForm')[0].reset();
                       location.reload(true);
                    },
                    error:function(xhr, status, error){
                        if(xhr.status == 500 || xhr.status == 422){
                            toastr.error('Oops! Something went wrong');
                        }
                    }
                });
            });

        });

        $("#add_date").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1990:+20',
            minDate: 0,
            // showButtonPanel: true,
            dateFormat: 'yy-mm-dd',
        });

        $('#add_time').timepicker({});
        

    </script>


@endsection
