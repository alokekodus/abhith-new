<div class="container-fluid">
    <p class="cross-line">
        <h2 class="heading-black">{{$subject->subject_name}}</h2>
    </p>
    <div class="row">

        <div class="col-lg-8 col-md-12 courseLeftBox order-2 order-lg-1 order-md-2 order-sm-1">
            
            <p class="cross-line">
                <span>Description</span>
            </p>
            <p class="cross-line">
                {!!$subject->description!!}
            </p>
            <p class="cross-line">
                <span>{{$subject->subject_name}} All Content</span>
            </p>
            @include('common.lesson.content')
        </div>

        <div class="col-lg-4 col-md-12 courseRightBlock order-1 order-lg-2 order-md-1 order-sm-2">
            <div style="box-shadow: 0px 6px 10px #d1d1d1;">
                <video id="player" class="video-js" controls preload="auto" autoplay loop muted
                    poster="{{asset($subject->subjectAttachment->video_thumbnail_image)}}" loading="lazy">
                </video>
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
                    <span>Created by : Demo Teacher</span><br>
                    <span></i>Total Lesson: {{$subject->lesson->count()}}</span>
                    {{-- <a href="{{route('website.user.lesson',[Crypt::encrypt($order->id),Crypt::encrypt($subject->id)])}}"
                        class="enroll">View Details</a> --}}

                        @if(auth()->check())
                        <a href="{{route('website.course.package.subject.detatils',Crypt::encrypt($subject->id))}}"
                            class="btn btn-primary btn-lg btn-block mt-2 course-details-start-course-btn">Start Your Course</a>
                        @else
                            <div class="d-flex card-button mb-2">
                                <a href="#" class="btn btn-success btn-lg btn-block mt-2 course-details-add-to-cart-btn"><i class="fa fa-shopping-cart"></i> &nbsp; Add to cart</a>
                                <!-- <a class="btn btn-primary btn-lg btn-block mt-2">Go to Package</a> -->
                            </div>
                        @endif
                </div>
                
            </div>
            
        </div>
    </div>
</div>


<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-7 col-md-12">
            
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h5 class="panel-title">
                            <a  href="{{route('website.subject.mcq',Crypt::encrypt($subject->id))}}" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseLesson"
                                aria-expanded="true" aria-controls="collapseLesson">
                                <i class="more-less glyphicon glyphicon-plus"></i>
                                ALL MCQ'S QUESTION SET
                            </a>
                        </h5>
                    </div>
                </div>
            </div><!-- panel-group -->
        </div>
    </div>
</div>


<div class="container-fluid mt-4">
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
                <div class="tab-pane container fade" id="whylearn">
                    <h6> {!!$subject->why_learn!!} </h6>
                </div>
            </div>
        </div>
    </div>
</div>
