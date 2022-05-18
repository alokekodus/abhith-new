@extends('layout.website.website')

@section('title','Courses')

@section('content')

<section class="subheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline cart-course-list1">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 p0">
                <div class="subheader-image"><img src="{{asset('asset_website/img/course/banner.png')}}" class="w100">
                </div>
                <div class="subheader-image-desc">
                    <h2 class="heading-black">Our Courses<br>
                        <span class="heading-blue">Study Beyond The Classroom</span>
                    </h2>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-courses">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">
                <h2 class="heading-black">All Courses</h2>
            </div>

            <div class="col-lg-12 p-4">
                <form id="websiteFilterCourseForm" class="row justify-content-center" method="post">
                    @csrf
                    <div class="col-4">
                        <label>Select Board</label>
                        <select name="assignedBoard" id="assignedBoard" class="form-control" onchange="changeBoard()">
                            <option value="">-- Select -- </option>
                            @forelse ($boards as $item)
                            <option value="{{$item->id}}">{{$item->exam_board}}</option>
                            @empty
                            <option>No boards to show</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-4">
                        <label>Select Class</label>
                        <select id="board-class-dd" class="form-control" name="class_id">
                        </select>
                    </div>
                    <div class="col-3 p-4">
                        <button type="submit" id="submitWebsiteFilterCourseForm"
                            class="btn btn-block knowledge-link enquiry-form-btn">Submit</button>
                    </div>

                </form>
            </div>


        </div>
    </div>
</section>

@endsection

@section('scripts')

<script>
    function changeBoard()
{
    let board_id=$("#assignedBoard").val();
    $.ajax({
                url:"{{route('board.class')}}",
                type:"post",
                data:{
                    '_token' : "{{csrf_token()}}",
                    'board_id' : board_id
                },
                success:function(data){
                    $('#board-class-dd').html('<option value="">Select State</option>');
                    data.forEach((boardClass) => {
                        $("#board-class-dd").append('<option value="' + boardClass
                                .id + '">'+'Class-' + boardClass.class + '</option>');  
                    });
                   
                      
                },
                error:function(xhr, status, error){
                    if(xhr.status == 500 || xhr.status == 422){
                        toastr.error('Whoops! Something went wrong. Failed to fetch course');
                    }
                }
            });
};
$('#websiteFilterCourseForm').on('submit', function(e){
    e.preventDefault();
    $('#submitWebsiteFilterCourseForm').attr('disabled', true);
    $('#submitWebsiteFilterCourseForm').text('Please wait...');
    let formData = new FormData(this);
    $.ajax({
                url:"{{route('website.course.package.filter')}}",
                type:"POST",
                processData:false,
                contentType:false,
                data:formData,
                success:function(data){
                    var data=data.data;
                    if(data.code==200){
                        var assignedBoard=$("#assignedBoard").val();
                        var boardclassid=$("#board-class-dd").val();
                        
                        let url = "{{ route('website.course.package.filter.all',[':board_id',':class_id']) }}";
                            url = url.replace(':board_id',assignedBoard).replace(':class_id',boardclassid);
                           
                            window.location.href = url;
                    }else{
                         
                        toastr.error('Whoops! Something went wrong failed to find packages');
                    }
                   
                    
                },
                error:function(xhr, status, error){
                    if(xhr.status == 500 || xhr.status == 422){
                        toastr.error('Whoops! Something went wrong failed to find packages');
                    }

                    $('#submitWebsiteFilterCourseForm').attr('disabled', false);
                    $('#submitWebsiteFilterCourseForm').text('Submit');
                   
                }
            });
});
</script>

@endsection