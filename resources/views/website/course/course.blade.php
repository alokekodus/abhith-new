@extends('layout.website.website')
@section('head')
<style>
    .course-breadcrumbs {
        width: 100%;
        height: 150px;
    }

    .home-courses {
        margin: 10px 80px;
    }

    .heading-black {
        color: #000;
        font-size: 17px;
        font-weight: 700;
        /* margin-bottom: 40px; */
    }

    #owl-demo .item {
        margin: 3px;
    }

    #owl-demo .item img {
        display: block;
        width: 100%;
        height: auto;
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
                <form action="{{route('website.course.package.filter.all')}}" class="row justify-content-center"
                    method="post">
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
        {{-- @foreach($all_subjects as $key=>$subject)
       
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                       {{$subject}}
                    </div>
                    <div class="card-body">
                        <div id="owl-demo">

                            <div class="item">


                                <div class="course-pic"><img
                                        src="http://localhost/abhith-new/public/files/course/subject/lesson/09-06-2022-00-50-32_science-word-theme_23-2148540555.webp"
                                        class="w100"></div>
                                <div class="course-desc">
                                    <h4 class="small-heading-black">SCIENCE</h4>
                                    Board:SEBA Class:9<br>
                                    <span>Created by : Demo Teacher</span><br>
                                    <span>Total Lesson:
                                        1</span>
                                    <a href="http://localhost/abhith-new/public/account/my-lesson/eyJpdiI6IkR5YnpkbVd5Q1QrNzJiT3ludXZ0aFE9PSIsInZhbHVlIjoicUVrWGNNZlhoQmF0eUJBVkdMdEpwUT09IiwibWFjIjoiZWFmNGQzODgyNGZkODRjZDUwZTZlODk2OTA0NTY4MjA5OTQ0ZWFiZjQ0ZGE4MzRjMGUxNDdiMTc1M2FjZDcxNSIsInRhZyI6IiJ9/eyJpdiI6IjNCUk5EVWFMRDRwUVVaUzFqRTlJaEE9PSIsInZhbHVlIjoiZXlBdm1OOVZHMHNkamU4Y0JBVzJUQT09IiwibWFjIjoiM2YyNmQ0OWIxMWYxY2IzZDE0YTkwZTVkOWMxNTE2ODY1NjQ4YzNjMTQzNTg1NTAwNDJhZWY4ZTBhZGFlZWQ3NyIsInRhZyI6IiJ9"
                                        class="enroll">View Details</a>
                                </div>

                            </div>
                            <div class="item">


                                <div class="course-pic"><img
                                        src="http://localhost/abhith-new/public/files/course/subject/lesson/09-06-2022-00-50-32_science-word-theme_23-2148540555.webp"
                                        class="w100"></div>
                                <div class="course-desc">
                                    <h4 class="small-heading-black">SCIENCE</h4>
                                    Board:SEBA Class:9<br>
                                    <span>Created by : Demo Teacher</span><br>
                                    <span>Total Lesson:
                                        1</span>
                                    <a href="http://localhost/abhith-new/public/account/my-lesson/eyJpdiI6IkR5YnpkbVd5Q1QrNzJiT3ludXZ0aFE9PSIsInZhbHVlIjoicUVrWGNNZlhoQmF0eUJBVkdMdEpwUT09IiwibWFjIjoiZWFmNGQzODgyNGZkODRjZDUwZTZlODk2OTA0NTY4MjA5OTQ0ZWFiZjQ0ZGE4MzRjMGUxNDdiMTc1M2FjZDcxNSIsInRhZyI6IiJ9/eyJpdiI6IjNCUk5EVWFMRDRwUVVaUzFqRTlJaEE9PSIsInZhbHVlIjoiZXlBdm1OOVZHMHNkamU4Y0JBVzJUQT09IiwibWFjIjoiM2YyNmQ0OWIxMWYxY2IzZDE0YTkwZTVkOWMxNTE2ODY1NjQ4YzNjMTQzNTg1NTAwNDJhZWY4ZTBhZGFlZWQ3NyIsInRhZyI6IiJ9"
                                        class="enroll">View Details</a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>
        
        @endforeach --}}

    </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
<script>
    $(document).ready(function() {
     
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
}
</script>


@endsection