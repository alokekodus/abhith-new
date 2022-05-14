@extends('layout.website.website')

@section('title','Courses')
@section('head')
<style>
.course-price-custom {
    position: absolute;
    font-size: 16px;
    left: 449px;
    font-weight: 600;
}
.course-price2 {
    position: absolute;
    right: 56px;
    top: 15%;
    font-weight: 600;
}
</style>
@endsection

@section('content')
<main>
<section class="subheader1">
 <div class="container-fluid">
     <div class="row">
         <div class="col-lg-6 p0">
             <div class="subheader1-desc">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="course.html">{{$board->exam_board}}</a></li>
                         <li class="breadcrumb-item active" aria-current="page">Class-{{$class->name}}&nbsp; <i class="fa fa-level-down" aria-hidden="true"></i></li>
                     </ol>
                 </nav>
                 <h2 class="heading-white"><span style="font-size:12px;"></span></h2>
                 <p></p>
             </div>
         </div>
         <div class="col-lg-6 p0">
             <div class="subheader1-img"><img src="https://abhith.dev-ekodus.com/files/course/08-12-2021-17-51-12_p185554_b_v10_az.jpg" class="w100" style="opacity: 0.6">                            
                     <a href="https://abhith.dev-ekodus.com/files/course/courseVideo/08-12-2021-17-51-12_file_example_MP4_480_1_5MG.mp4" data-fancybox="images"
                         data-fancybox-group='image-gallery'>
                         <i class="fa fa-play-circle"></i>
                     </a> 
            </div>
         </div>
     </div>
 </div>
</section>
<section class="course-describtion">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 p0">
                <ul class="list-inline course-desc-list">
                   <h4 data-brackets-id="12020" class="small-heading-black mb20">Description
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" data-toggle="modal"
                                data-target="#sharePostModal" style="display:inline;font-size:12px;">
                                <i class="fa fa-share" aria-hidden="true"></i> &nbsp; Share
                            </a>
                    </h4>   
                </ul>
            </div>
        </div>
    </div>
 </section>

<section class="course-describtion">
 <div class="container-fluid">
     <div class="row">
         <div class="col-lg-12 p0">
             <ul class="list-inline course-desc-list">
                 <form action="{{route('website.add-to-cart')}}" method="post">
                    @csrf
                 <li>
                     <p>
                        <div class="course-desc-list1 p4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input full-course" type="radio" name="course_type" id="full_course" value="1" onclick="changeCourse(this.value)">
                                <label class="form-check-label" for="full_course">Full Course</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input custom-package" type="radio" name="course_type" id="custom_package" value="2" onclick="changeCourse(this.value)">
                                <label class="form-check-label" for="custom_package">Custom Package</label>
                              </div>  
                        </div>
                     </p>
                 </li>
                 <li class="">
                       
                     <div class="course-desc-list1">
                         <form action="{{route('website.add-to-cart')}}" method="post">
                            @csrf
                         <input type="hidden" name="is_full_course_selected" value="1">
                         <input type="hidden" name="board_id" value="">
                         <input type="hidden" name="class_id" value="">
                         <label class="box1 ">Full Course</label>
                         <hr>
                         <ul class="list-inline centered">
                            @foreach($subjects as $key=>$subject)
                            <li>
                                <input class="styled-checkbox item_price chapter-value" id="styled-checkbox-full-course-{{$key}}" data-id="{{$subject->id}}" data-name="{{$subject->subject_name}}" data-price="{{number_format($subject->subject_amount,2,'.','')}}" type="checkbox" value="{{$subject->id}}" name="subjects[]">
                                    <label for="styled-checkbox-full-course-{{$key}}"> {{$subject->subject_name}}</label>
                                    <span class="course-price mr-2"><i class="fa fa-inr" aria-hidden="true"></i>{{number_format($subject->subject_amount,2,'.','')}}</span>
                            
                            </li>
                            @endforeach
                        </ul>

                         <div class="total">
                             <p class=""><b>Total</b></p>
                             <span class=" course-price1 mr-2" id="total_price"><i class="fa fa-inr"
                                     aria-hidden="true"></i> </span>
                         </div>
                         <div class="total-cart">
                             <ul class="list-inline total-car-list">
                                 <li class="mr-md-3"><button  type="submit" class="add-cart form-control" id="add_cart">Add
                                         to Cart</button></li>
                                 
                             </ul>
                         </div>
                         </form>
                     </div>
                 </li>
                 </form>
             </ul>
         </div>
     </div>
 </div>
</section>
<!-- The Modal -->
<div class="modal" id="add-test-modal" data-backdrop="static" data-keyboard="false">
 <div class="modal-dialog">
     <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-heading">
             <h5>Testing video course Test</h5>
             
             <p class="modal-sub-head-left">Time Left : <b><span id="timer">15:00</span></b></p>
             
         </div>


         <!-- Modal body -->
         <div class="modal-body" id="multipleChoiceModel">
             <form id="mcqForm">
            <input type="hidden" name="_token" value="kyPrVm8xICWm9lvLojUKnXdewTaUzhc6z97FBvJH"><div class="text-center">
            <div id="mcqResult">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success" id="mcqSubmitBtn">Submit</button>
            </div>
            <script>
                document.getElementById('saveOptions').style.display = "none";
            </script>
        </div>
</form>

<div class="mcq-page-link"></div>                    
<div class="end-message"></div>
</div>
     </div>
 </div>
</div>




<div class="modal" id="startMcqModel">
 <div class="modal-dialog">
     <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-heading">
             <h4>Testing video course Test</h4>
             
             <p class="modal-sub-head-right mcqTimer">Time : <b>15:00 Minutes</b></p>
             <button type="button" class="close" data-dismiss="modal"><span
                     class="icon-cancel-20"></span></button>
         </div>


         <!-- Modal body -->
         <div class="modal-body">
             <div class="text-center">
                 <button class="knowledge-link startTest">Start Test</button>
             </div>
         </div>
     </div>
 </div>
</div>



<div class="modal" id="reviewMcqResultModal">
 <div class="modal-dialog">
     <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-heading">
             <h4>Mcq Result</h4>
             <button type="button" class="close" data-dismiss="modal" id="closeReviewMcqResultModal"><span class="icon-cancel-20"></span></button>
         </div>
         <!-- Modal body -->
         <div class="modal-body" style="height:300px;overflow-y:scroll;scroll-behaviour:smooth; padding-right:50px">
             <div id="reviewMcqResultQuestions"></div>
         </div>
     </div>
 </div>
</div>
<!-- The Modal -->


<div class="modal" id="add-question-modal">
<div class="modal-dialog modal-lg">
 <div class="modal-content">

     <!-- Modal Header -->
     <h4 class="modal-title">Add Question</h4>
     <button type="button" class="close" data-dismiss="modal"><span class="icon-cancel-20"></span></button>


     <!-- Modal body -->
     <div class="modal-body">
         <div class="tips">
             <h6 class="mb0">Tips on getting good answer quickly</h6>
             <ul class="pl15 mb0">
                 <li>Make sure you question has not been asked already</li>
                 <li>Keep you question short and to the point</li>
                 <li>Double check grammer and spelling</li>
             </ul>
         </div>
         <div>
                                     <span class="knowledge-profile"><img src="https://abhith.dev-ekodus.com/asset_website/img/knowladge-forum/image4.png"></span>
                                                 </div>
         <div class="question-modal">
             <form class="row" id="knowledgeQuestionForm">
                 <input type="hidden" name="_token" value="kyPrVm8xICWm9lvLojUKnXdewTaUzhc6z97FBvJH">                        <div class="form-group col-lg-12 mb-2">
                     <input type="text" class="form-control" name="question" id="questionAsk" placeholder="Type your question with “What”, “How”, “Why”, etc." required>
                 </div>
                 <div class="form-group col-lg-12 mb-2">
                     <textarea class="form-control" rows="1" id="editorQuestion" name="description" placeholder="Please describe here..." required></textarea>
                 </div>
                 <div class="form-group col-lg-12">
                     <input class="form-control link-input" type="url" id="questionLink" name="questionLink" placeholder="&#xf0c1; Include a link that gives context">
                 </div>
                 <div class="btn-box">
                     <ul class="list-inline modal-btn">
                         <li> <button type="button" data-dismiss="modal" class="btn btn-block cancel-question" id="cancelAddQuestionBtn">Cancel</button></li>
                         <li> <button type="submit" class="btn btn-block add-question" id="addQuestionBtn">Add Question</button> </li>
                     </ul>
                 </div>
             </form>
         </div>
     </div>
 </div>
</div>
</div>

<!-- Login Modal -->
<div class="modal" id="login-modal">
<div class="modal-dialog">
 <div class="modal-content border-0">
     <div class="modal-body p-0">
         <section class="login-section" style="height:auto;">
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="login-div" style="width:auto;">
                             <div class="login-cover">
                                 <ul class="nav nav-tabs login-tabs" id="myTab" role="tablist">
                                     <li class="nav-item">
                                         <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                             aria-controls="home" aria-selected="true">Log In</a>
                                     </li>
                                     <li class="nav-item">
                                         <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                             aria-controls="profile" aria-selected="false">Sign Up</a>
                                     </li>

                                 </ul>
                                 <div class="tab-content" id="myTabContent">
                                     <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                         <form class="row" action="https://abhith.dev-ekodus.com/auth/login" method="POST" id="loginForm">
                                             <input type="hidden" name="current_route" value="course/details/eyJpdiI6IlJ0eFNJbnN5TWdsMzFrY0YzbTNibnc9PSIsInZhbHVlIjoiZFJQdjExdjkzWjUrWUpVRU9uek5tZz09IiwibWFjIjoiYjMyN2Q5ZjVlM2NlNTRjYjk0OWZlYzM5YjVkMTk5M2E3N2MwN2IxNjM1ZTdkOTgwMTA2NzA5OGZiZjcyZDQ2MSIsInRhZyI6IiJ9">
                                             <input type="hidden" name="_token" value="kyPrVm8xICWm9lvLojUKnXdewTaUzhc6z97FBvJH">                                                    <div class="form-group col-lg-12">
                                                 <input type="email"name="email"  class="form-control" placeholder="Email" id="email" required>
                                                 <span class="text-danger"></span>
                                             </div>
                                             <div class="form-group col-lg-12">
                                                 <input type="password" name="password" class="form-control" placeholder="password"
                                                     id="password" required>
                                                 <span class="text-danger"></span>
                                             </div>
                                             <span class="text-danger ml-2">
                                                                                                     </span>
                                             <div class="form-group mb0 col-lg-12">
                                                 <button type="submit" class="btn btn-block login-btn" id="loginBtn">Login</button>
                                             </div>
                                             <div class="col-lg-12 forgot-div"><a href="https://abhith.dev-ekodus.com/website/forgot-password"
                                                     class="text-center">Forgot Password</a></div>
                                         </form>

                                         <div class="google-div"><a href="#" class="google-btn"><span
                                                     class="icon-google-30 google-icon"><span class="path1"></span><span
                                                         class="path2"></span><span class="path3"></span><span
                                                         class="path4"></span><span class="path5"></span><span
                                                         class="path6"></span></span>Continue with Google</a></div>
                                         <div class="facebook-div"><a href="#" class="facebook-btn"><span
                                                     class="icon-facebook-07 facebook-icon"></span>Continue with Facebook</a>
                                         </div>
                                     </div>

                                     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                         <form class="row" id="signupForm">
                                             <input type="hidden" name="_token" value="kyPrVm8xICWm9lvLojUKnXdewTaUzhc6z97FBvJH">                                                    <div class="form-group col-lg-12">
                                                 <input type="text" class="form-control" name="fname" placeholder="First Name" id="fname" required>
                                                 <span class="text-danger"></span>
                                             </div>
                                             <div class="form-group col-lg-12">
                                                 <input type="text" class="form-control" name="lname" placeholder="Last Name" id="lname" required>
                                                 <span class="text-danger"></span>
                                             </div>
                                             <div class="form-group col-lg-12">
                                                 <input type="text" name="email" class="form-control" placeholder="Email" id="p_number1" required>
                                                 <span class="text-danger"></span>
                                             </div>
                                             <div class="form-group col-lg-12">
                                                 <input type="password" name="password" class="form-control" placeholder="Password" id="pwd" required>
                                                 <span class="text-danger"></span>
                                             </div>
                                             <div class="form-group col-lg-12">
                                                 <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"
                                                     id="confPwd" required>
                                             </div>
                                             <div class="form-group mb0 col-lg-12">
                                                 <button type="submit" class="btn btn-block sign-btn" id="signupBtn">Sign up</button>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </section>
     </div>
 </div>
</div>
</div>


<!-- The Modal -->
<div class="modal" id="add-post-modal">
<div class="modal-dialog">
 <div class="modal-content">

     <!-- Modal Header -->
     <h4 class="modal-title">Add Post</h4>
     <button type="button" class="close" data-dismiss="modal"><span class="icon-cancel-20"></span></button>


     <!-- Modal body -->
     <div class="modal-body">
         <div>
             <span class="knowledge-profile"><img src="https://abhith.dev-ekodus.com/asset_website/img/knowladge-forum/image4.png"></span>
             <h6 class="knowledge-text">Himadri Shekhar Das</h6>
         </div>
         <div class="question-modal">
             <form class="row">
                 <input type="hidden" name="_token" value="kyPrVm8xICWm9lvLojUKnXdewTaUzhc6z97FBvJH">                        <div class="form-group col-lg-12 mb0">
                     <textarea class="form-control" rows="1" placeholder="Type your question with “What”, “How”, “Why”, etc." id="Message3"></textarea>
                 </div>
                 <div class="form-group col-lg-12">
                     <input class="form-control link-input" type="url" id="example-url-input" placeholder="&#xf0c1; Include a link that gives context">
                 </div>
                 <!--                            <button type="submit" class="btn btn-block knowledge-link">Send</button>                      -->
             </form>
         </div>
     </div>
     <div class="btn-box">
         <ul class="list-inline modal-btn">
             <li> <button type="button" data-dismiss="modal" class="btn btn-block cancel-question">Cancel</button></li>
             <li> <button type="submit" class="btn btn-block add-question">Add Post</button> </li>
         </ul>
     </div>


 </div>
</div>
</div>


<!-- Share Post/Blog Modal-->
<div class="modal" id="sharePostModal">
<div class="modal-dialog">
 <div class="modal-content">
     <div class="modal-body">
         <p>share</p>
         <a href="#" class="close" data-dismiss="modal">&times;</a>
         <div class="text-center">
             <i class="fa fa-link" aria-hidden="true" style="font-size:15px;"></i> &nbsp;<span class="btn btn-default copy-link-share-btn" style="font-weight:500;">Copy Link</span>
             &nbsp;<p id="linkCopiedConfirmation" style="color: green;font-weight: 500;"></p>
         </div>
     </div>
 </div>
</div>
</div>

<!-- Report  Post Modal-->
<div class="modal" id="ReportPostModal">
<div class="modal-dialog">
 <div class="modal-content">
     <!-- Modal body -->
     <div class="modal-body">
         <div class="form-group text-center">
             <h5>Report This Post.</h5>
         </div>
         <div class="form-group">
             <label for="">Enter reason of reporting.</label>
             <select name="reason_of_report" class="form-control" id="reason_of_report_post">
                 <option selected disabled>-- select --</option>
                 <option value="Inappropriate">Inappropriate</option>
                 <option value="Abusive">Abusive</option>
                 <option value="Provoking">Provoking</option>
                 <option value="Violence">Violence</option>
                 <option value="Harassment">Harassment</option>
                 <option value="Hate speech">Hate speech</option>
             </select>
         </div>
         <div style="float:right;" class="form-group">
             <button type="button" class="btn btn-default close-post-modal" data-dismiss="modal">Close</button>
             <button type="button" class="btn btn-danger reportPostButton">Yes, Report</button>
         </div>
         
     </div>
 </div>
</div>
</div>

<!-- Report  Blog Modal-->
<div class="modal" id="ReportBlogModal">
<div class="modal-dialog">
 <div class="modal-content">
     <!-- Modal body -->
     <div class="modal-body">
         <div class="form-group text-center">
             <h5>Report This Blog.</h5>
         </div>
         <div class="form-group">
             <label for="">Enter reason of reporting.</label>
             <select name="reason_of_report" class="form-control" id="reason_of_report">
                 <option selected disabled>-- select --</option>
                 <option value="Inappropriate">Inappropriate</option>
                 <option value="Abusive">Abusive</option>
                 <option value="Provoking">Provoking</option>
                 <option value="Violence">Violence</option>
                 <option value="Harassment">Harassment</option>
                 <option value="Hate speech">Hate speech</option>
             </select>
         </div>
         <div style="float:right;" class="form-group">
             <button type="button" class="btn btn-default close-blog-modal" data-dismiss="modal">Close</button>
             <button type="button" class="btn btn-danger reportBlogButton">Yes, Report</button>
         </div>
         
     </div>
 </div>
</div>
</div>


<!-- Add Blog Modal -->
<div class="modal" id="websiteAddBlogModal" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog mw-100 w-75 h-100 d-md-flex flex-column mt-5 my-0">
 <div class="modal-content">
     <div class="modal-body p-0">
         <div class="card border-0">
             <div class="card-body">
                 <h4 class="card-title">Create Blog</h4>
                 <form class="forms-sample"  method="POST" enctype="multipart/form-data"  id="websiteBlogForm">
                     <input type="hidden" name="_token" value="kyPrVm8xICWm9lvLojUKnXdewTaUzhc6z97FBvJH">                            <div class="form-group">
                         <label for="exampleInputName1">Name</label>
                         <input type="text" class="form-control" id="blogName" name="blogName" maxlength="100" placeholder="Enter Blog Name" required>
                         <span class="text-muted" style="font-size:12px;margin-top:5px;">Allowed characters 100.</span>
                         <span class="text-danger" id="name_error"></span>
                     </div>

                     <div class="form-group">
                         <label for="">Select Category</label>
                         <select name="blog_category" id="blog_category" class="form-control" required>
                             <option value="" selected disabled> -- Select -- </option>
                             <option value="Fashion">Fashion</option>
                             <option value="Food ">Food </option>
                             <option value="Travel">Travel</option>
                             <option value="Music">Music</option>
                             <option value="Lifestyle">Lifestyle</option>
                             <option value="Fitness">Fitness</option>
                             <option value="DIY">DIY</option>
                             <option value="Sports">Sports</option>
                             <option value="Movie">Movie</option>
                             <option value="Education">Education</option>
                             <option value="Technology">Technology</option>
                         </select>
                         <span class="text-danger" id="blog_category_error"></span>
                     </div>
 
                     <div class="form-group">
                         <label>File upload</label>
                         <input type="file" class="filepond" name="pic" id="banner_pic" data-max-file-size="1MB" data-max-files="1" required>
                         <span class="text-danger" id="pic_error"></span>
                     </div>
 
                     <div class="form-group">
                         <label for="exampleTextarea1">Description</label>
                         <textarea class="form-control" id="websiteAddBlogEditor" name="blogDescription" required></textarea>
                         <span class="text-danger" id="data_error"></span>
                     </div>
                     <button type="submit" class="btn add-post float-right mr-3 websiteAddBlogBtn">Create</button>
                     <button type="submit" class="btn btn-default float-right mr-3 websiteCancelBlogBtn">Cancel</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
</div>
</div>

<!-- Add Blog Confirmation Modal -->
<div class="modal" id="websiteAddBlogConfirmationModal">
<div class="modal-dialog " >
 <div class="modal-content">
     <div class="modal-body">
         <div class="text-center">
             <h4 style="color:green;">Blog created successfully</h4>
             <p>
                 Blog will display after it is approved by the admin.
             </p>
         </div>
         <button type="button" data-dismiss="modal" class="close">&times;</button>
     </div>
 </div>
</div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
       
        changeCourse(1);
     });
   function changeCourse(value){
       console.log(value);
        if(value==1){
            $("#full_course").prop("checked", true);
            $(".chapter-value").prop("checked", true);
            $(".chapter-value").prop("disabled", true);
            totalAmount();
        }else{
            $(".chapter-value").prop("checked", false);
            $(".chapter-value").prop("disabled", false);
            totalAmount();
        }
   }
  
</script>


    
@endsection
