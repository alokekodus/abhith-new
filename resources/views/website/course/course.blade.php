@extends('layout.website.website')
@section('head')
<style>
    .course-breadcrumbs {
        width: 100%;

    }

    .subject-heading-black {
        font-size: 14px;
        font-weight: 700;
        color: #000;
    }

    .search-form-wrapper {
        position: relative;
        border: 1px solid #eee;
        padding: 20px 10px;
        box-shadow: 1px 3px 5px #dad7d7;
    }

    .search-form-wrapper label {
        font-weight: bold;
    }

    .reset-form-btn {
        padding: 10px 3px !important;
        width: 55px !important;
        position: absolute;
        top: 0;
        right: 0;
        border-radius: 0;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />
@endsection
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
                <div class="subheader-image"><img src="{{asset('asset_website/img/course/banner.png')}}"
                        class="course-breadcrumbs">
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
                <h5 class="heading-black">All Courses</h5>
            </div>

            <div class="col-lg-12 p-4">
                <form class="row justify-content-center" method="get">
                    @csrf
                    <div class="col-lg-4 col-md-6">
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
                    <div class="col-lg-4 col-md-6">
                        <label>Select Class</label>
                        <select id="board-class-dd" class="form-control" name="class_id">
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-12 p-4">
                        <button type="submit" id="submitWebsiteFilterCourseForm"
                            class="btn btn-block knowledge-link enquiry-form-btn">Submit</button>
                    </div>


                        <a href="{{request()->url()}}" class="btn btn-block  reset-form-btn"><i class="fa fa-refresh"
                                aria-hidden="true"></i> </a>


                    </form>
                </div>
            </div>


        </div>


        <div class="row">
            @foreach($subjects as $key=>$subject)

            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="course-pic"><img src="{{asset($subject->image)}}" class="w100"></div>
                <div class="course-desc">
                    {{-- <span class="icon-clock-09 clock-icon"></span><span>{{ $item['duration'] }}</span> --}}
                    <h4 class="subject-heading-black">
                        {{$subject->subject_name}}
                        (Class-{{$subject->assignClass->class}},{{$subject->boards->exam_board}})
                    </h4>
                    <span>
                        <h6><i class="fa fa-inr" aria-hidden="true"></i> {{number_format($subject->subject_amount,
                            2,'.','')}}</h6>
                    </span>
                    <a href="{{route('website.course.package.enroll.all',Crypt::encrypt($subject->id))}}"
                        class="enroll">Enroll Now</a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
<script>
    $(document).ready(function() {
    //  var requestData=@json(request()->all());
    //  var classId=requestData['class_id'];
    //     if(classId !=="undefined"){
    //         changeBoard(classId);
    //     }
    $("#board-class-dd").prop("disabled",true);
     $("#owl-demo").owlCarousel({
    
         autoPlay: 8000, //Set AutoPlay to 3 seconds
    
         items : 4,
         itemsDesktop : [1199,3],
         itemsDesktopSmall : [979,3]
    
     });
    
   }); 
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
                    $("#board-class-dd").prop("disabled",false);
                   
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
}
</script>


@endsection