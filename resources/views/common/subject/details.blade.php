<div class="container-fluid">
    <p class="cross-line">
    <h2 class="heading-black mx-2">{{$subject->subject_name}}</h2>
    </p>
    <div class="row">

        <div class="col-lg-8 col-md-12 courseLeftBox order-2 order-lg-1 order-md-2 order-sm-1">

            {{-- <p class="cross-line">
                <span>Description</span>
            </p>
            <p class="cross-line">
                {!!$subject->description!!}
            </p>
            <p class="cross-line">
                <span>{{$subject->subject_name}} All Content</span>
            </p>
            @include('common.lesson.content') --}}

            <div class="col-lg-6 mt-3">
                <div class="board-class-div d-flex justify-content-between">
                    <div>
                        <h5>SEBA</h5>
                        <p>Board</p>
                    </div>
                    <div>
                        <h5>6</h5>
                        <p>Class</p>
                    </div>
                    <div>
                        <h5>Rating</h5>
                        <p>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> &nbsp;
                            <span>9.45 (9.8k+ reviews)</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="description">
                <nav class="mt-4">
                    <div class="nav" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active mr-4" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                            <h4>Overview</h4>
                        </a>
                        <a class="nav-item nav-link mr-4" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
                            <h4>Curriculum</h4>
                        </a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">
                            <h4>Reviews</h4>
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="container">
                            <div class="row">
                                <div class="mt-5">
                                    <h4>Course Description</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat architecto expedita ratione itaque vero reiciendis odit perspiciatis possimus beatae? Consectetur cupiditate nesciunt nulla quod vero dolorem explicabo, eos sapiente quibusdam.</p>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius sapiente voluptas perferendis nemo repellat necessitatibus id, eum, in explicabo ipsa velit. Ratione, quos! Veniam cumque perspiciatis harum placeat, nemo ab.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="container">
                            <div class="row">
                                <div class="mt-5">
                                    <h4>Curriculum</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat architecto expedita ratione itaque vero reiciendis odit perspiciatis possimus beatae? Consectetur cupiditate nesciunt nulla quod vero dolorem explicabo, eos sapiente quibusdam.</p>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius sapiente voluptas perferendis nemo repellat necessitatibus id, eum, in explicabo ipsa velit. Ratione, quos! Veniam cumque perspiciatis harum placeat, nemo ab.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="container">
                            <div class="row">
                                <div class="mt-5">
                                    <h4>Reviews</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat architecto expedita ratione itaque vero reiciendis odit perspiciatis possimus beatae? Consectetur cupiditate nesciunt nulla quod vero dolorem explicabo, eos sapiente quibusdam.</p>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius sapiente voluptas perferendis nemo repellat necessitatibus id, eum, in explicabo ipsa velit. Ratione, quos! Veniam cumque perspiciatis harum placeat, nemo ab.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Responsive view -->
            <div class="container mt-5" id="description-accordion">
                <div class="accordion">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none;">
                                <div class="d-flex justify-content-between">
                                    <p>Overview</p>
                                    <p><i class="fa fa-plus"></i></p>
                                </div>
                        </button>
                        </h5>
                      </div>
                  
                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#description-accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 order-2 order-lg-1 order-md-1 order-sm-1 mt-3">
                                    <h4>Course Description</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat architecto expedita ratione itaque vero reiciendis odit perspiciatis possimus beatae? Consectetur cupiditate nesciunt nulla quod vero dolorem explicabo, eos sapiente quibusdam.</p>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius sapiente voluptas perferendis nemo repellat necessitatibus id, eum, in explicabo ipsa velit. Ratione, quos! Veniam cumque perspiciatis harum placeat, nemo ab.</p>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo" style="text-decoration: none;">
                                <div class="d-flex justify-content-between">
                                    <p>Curriculum</p>
                                    <p><i class="fa fa-plus"></i></p>
                                </div>
                            </button>
                        </h5>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#description-accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 order-2 order-lg-1 order-md-1 order-sm-1 mt-3">
                                    <h4>Course Description</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat architecto expedita ratione itaque vero reiciendis odit perspiciatis possimus beatae? Consectetur cupiditate nesciunt nulla quod vero dolorem explicabo, eos sapiente quibusdam.</p>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius sapiente voluptas perferendis nemo repellat necessitatibus id, eum, in explicabo ipsa velit. Ratione, quos! Veniam cumque perspiciatis harum placeat, nemo ab.</p>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree" style="text-decoration: none;">    
                                <div class="d-flex justify-content-between">
                                    <p>Reviews</p>
                                    <p><i class="fa fa-plus"></i></p>
                                </div>
                            </button>
                        </h5>
                      </div>
                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#description-accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 order-2 order-lg-1 order-md-1 order-sm-1 mt-3">
                                    <h4>Course Description</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat architecto expedita ratione itaque vero reiciendis odit perspiciatis possimus beatae? Consectetur cupiditate nesciunt nulla quod vero dolorem explicabo, eos sapiente quibusdam.</p>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius sapiente voluptas perferendis nemo repellat necessitatibus id, eum, in explicabo ipsa velit. Ratione, quos! Veniam cumque perspiciatis harum placeat, nemo ab.</p>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <!-- End Responsive view -->

            <!-- What u'll learn -->
            <div class="mt-5" id="learning">
                <h4>What you'll learn</h4>
                <div class="d-flex justify-content-between mt-4">
                    <div class="learningBox1 mx-4">
                        <p><i class="fa fa-check-circle"></i> &nbsp; Lorem ipsum dolor sit amet.</p>
                        <p><i class="fa fa-check-circle"></i> &nbsp; Lorem ipsum dolor sit amet.</p>
                        <p><i class="fa fa-check-circle"></i> &nbsp; Lorem ipsum dolor sit amet.</p>
                        <p><i class="fa fa-check-circle"></i> &nbsp; Lorem ipsum dolor sit amet.</p>
                        <p><i class="fa fa-check-circle"></i> &nbsp; Lorem ipsum dolor sit amet.</p>
                        <p><i class="fa fa-check-circle"></i> &nbsp; Lorem ipsum dolor sit amet.</p>
                    </div>
                    <div class="learningBox2 mx-4">
                        <p><i class="fa fa-check-circle"></i> &nbsp; Lorem ipsum dolor sit amet.</p>
                        <p><i class="fa fa-check-circle"></i> &nbsp; Lorem ipsum dolor sit amet.</p>
                        <p><i class="fa fa-check-circle"></i> &nbsp; Lorem ipsum dolor sit amet.</p>
                        <p><i class="fa fa-check-circle"></i> &nbsp; Lorem ipsum dolor sit amet.</p>
                        <p><i class="fa fa-check-circle"></i> &nbsp; Lorem ipsum dolor sit amet.</p>
                        <p><i class="fa fa-check-circle"></i> &nbsp; Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
            </div>
            <!-- End What u'll learb -->

            <!-- Requirements -->
            <div class="mt-5">
                <h4>Requirements</h4>
                <div class="mt-3">
                    <ul class="">
                        <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias inventore adipisci id, iure excepturi nostrum ex voluptatum totam omnis vitae amet neque at reiciendis dolore minus ab reprehenderit tempora quae tempore harum saepe distinctio. Sapiente.</li>
                        <li>A computer, cellphone with a good internet connection</li>
                        <li>Notebook, pen</li>
                    </ul>
                </div>
            </div>
            <!-- End Requirements -->
        </div>
        
        <div class="col-lg-4 col-md-12 courseRightBlock order-1 order-lg-2 order-md-1 order-sm-2">
            <div style="box-shadow: 0px 6px 10px #d1d1d1;">
                @if($subject->subjectAttachment->attachment_origin_url!=null)
                <video id="player" class="video-js vjs-big-play-centered" controls preload="auto"
                    poster="{{asset($subject->subjectAttachment->video_thumbnail_image)}}" data-setup="{}">
                    <source src="{{asset($subject->subjectAttachment->attachment_origin_url)}}" type="video/mp4" class="w100"/>
                </video>
                {{-- <video id="player" data-setup="{}" controls="">
                    <source src="{{asset($subject->subjectAttachment->attachment_origin_ur)}}" type="video/mp4">
                </video> --}}
                @else
                <img src="{{asset($subject->image)}}" class="w100">
                @endif
                <div class="course-desc1">
                    <h4 class="small-heading-black">
                        <span class="d-flex  course-header-and-back-to-pckg-btn">
                            {{$subject->subject_name}}
                            @guest
                            <a href="#">
                                <i class="fa fa-reply"></i> &nbsp;Package
                            </a>
                            @endguest
                        </span>
                    </h4>
                    {{-- <span>Created by : Demo Teacher</span><br> --}}
                    {{-- <span></i>Total Lesson: {{$subject->lesson->count()}}</span> --}}
                    <div class="d-flex justify-content-between align-items-center mx-4" style="margin-bottom: -15px; margin-top:15px" >
                        <p>
                            <span style="font-weight:700; font-size: 18px"><i class="fa fa-inr mr-1"></i>449</span> &nbsp; 
                            <s style="color: grey"><i class="fa fa-inr mr-1" aria-hidden="true"></i>3,499</s>
                        </p>
                        <p class="discount-percentage">91% Off</p>
                    </div>
                    <span style="font-size: 16px; color: red; padding-bottom:10px"><i class="fa fa-clock-o mr-1"></i> 2 days left at this price!</span>
                    {{-- <a
                        href="{{route('website.user.lesson',[Crypt::encrypt($order->id),Crypt::encrypt($subject->id)])}}"
                        class="enroll">View Details</a> --}}

                    @if(auth()->check())
                    <a href="{{route('website.course.package.subject.detatils',Crypt::encrypt($subject->id))}}"
                        class="btn btn-primary btn-lg btn-block mt-2 course-details-start-course-btn">Start Your
                        Course</a>
                    @else
                    <div class="d-flex card-button mb-2 mx-4">
                        <a href="#" class="btn btn-success btn-lg btn-block mt-2 course-details-add-to-cart-btn">
                            <i class="fa fa-shopping-cart"></i> &nbsp; Add to cart</a>
                        <a class="btn btn-primary btn-lg btn-block mt-3 mb-3">Buy it Now</a>
                    </div>
                    <div class="details-bottom d-flex justify-content-between mx-4">
                        <p class="details-bottom-text">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp; Duration</p>
                        <p>60 Minutes</p>
                    </div>
                    <div class="details-bottom d-flex justify-content-between mx-4">
                        <p class="details-bottom-text">
                            <i class="fa fa-book" aria-hidden="true"></i> &nbsp; Lesson</p>
                        <p>32</p>
                    </div>
                    <div class="details-bottom d-flex justify-content-between mx-4">
                        <p class="details-bottom-text">
                            <i class="fa fa-user" aria-hidden="true"></i> &nbsp; Enrolled by</p>
                        <p>1982 students</p>
                    </div>
                    <div class="details-bottom d-flex justify-content-between mx-4">
                        <p class="details-bottom-text">
                            <i class="fa fa-language" aria-hidden="true"></i> &nbsp; Language</p>
                        <p>English</p>
                    </div>
                    <div class="details-bottom d-flex justify-content-between mx-4">
                        <p class="details-bottom-text">
                            <i class="fa fa-certificate" aria-hidden="true"></i> &nbsp; Certificate</p>
                        <p>Yes</p>
                    </div>
                    <div class="text-center pb-3">
                        <a href="#" target="_blank">
                            <i class="fa fa-share-alt" aria-hidden="true"></i> &nbsp; Share this Course</a>  
                    </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</div>


<!-- Lessons -->
<div class="container-fluid mt-4" id="lesson">
    <div class="row">
        <div class="col-lg-8 col-md-12">

            {{-- <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h5 class="panel-title">
                            <a href="{{route('website.subject.mcq',Crypt::encrypt($subject->id))}}" role="button"
                                data-toggle="collapse" data-parent="#accordion" href="#collapseLesson"
                                aria-expanded="true" aria-controls="collapseLesson">
                                <i class="more-less glyphicon glyphicon-plus"></i>
                                ALL MCQ'S QUESTION SET
                            </a>
                        </h5>
                    </div>
                </div>
            </div><!-- panel-group -->  --}}

            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none">
                                <div class="ml-3 pt-3">
                                    <p><i class="fa fa-plus"></i> &nbsp; Lesson 1</p>
                                </div>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="lesson-content d-flex mx-3">
                                <p><i class="fa fa-book"></i> &nbsp; Introduction to the course</p>
                                <div class="d-flex course-duration-div">
                                    <p>3 Questions</p>
                                    <p>30 mins</p>
                                    <i class="fa fa-play mt-2"></i>
                                </div>
                            </div>
                            <div class="lesson-content d-flex mx-3">
                                <p><i class="fa fa-book"></i> &nbsp; Introduction</p>
                                <div class="d-flex course-duration-div">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="lesson-content d-flex mx-3">
                                <p><i class="fa fa-clock-o"></i> &nbsp; Structure of the course</p>
                                <div class="d-flex course-duration-div">
                                    <p>30 mins</p>
                                    <i class="fa fa-play mt-2"></i>
                                </div>
                            </div>
                            <div class="lesson-content d-flex mx-3">
                                <p><i class="fa fa-clock-o"></i> &nbsp; Required Tools</p>
                                <div class="d-flex course-duration-div">
                                    <p>12 lectures</p>
                                    <p>30 mins</p>
                                    <i class="fa fa-lock mt-2"></i>
                                </div>
                            </div>
                            <div class="lesson-content d-flex mx-3">
                                <p><i class="fa fa-book"></i> &nbsp; Get your free e-book</p>
                                <div class="d-flex course-duration-div">
                                    <i class="fa fa-download"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Lessons -->


{{-- <div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-7">
            <ul class="nav nav-tabs">
                <!-- <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#teacher">
                        <h4 class="small-heading-black">Teacher</h4>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#whylearn">
                        <h4 class="small-heading-black">What you'll learn</h4>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content mt-3">
                <div class="tab-pane container fade show active" id="whylearn">
                    <h6> {!!$subject->why_learn!!} </h6>
                </div>
            </div>
        </div>
    </div>
</div> --}}